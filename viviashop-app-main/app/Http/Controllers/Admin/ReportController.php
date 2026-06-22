<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaporanExport;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\ReportPayment;
use App\Exports\ReportProduct;
use App\Exports\ReportRevenue;
use App\Exports\ReportInventory;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use PDF;

class ReportController extends Controller
{

    private $exports;
    public function __construct()
	{
        parent::__construct();

		$this->exports = [
			'xlsx' => 'Excel File',
			'pdf' => 'PDF File',
		];
	}

    public function revenue(Request $request)
    {
        $exports = $this->exports;

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if ($startDate && !$endDate) {
            // \Session::flash('error', 'The end date is required if the start date is present');
            return redirect('admin/reports/revenue');
        }

        if (!$startDate && $endDate) {
            // \Session::flash('error', 'The start date is required if the end date is present');
            return redirect('admin/reports/revenue');
        }

        if ($startDate && $endDate) {
            if (strtotime($endDate) < strtotime($startDate)) {
                // \Session::flash('error', 'The end date should be greater or equal than start date');
                return redirect('admin/reports/revenue');
            }

            $earlier = new \DateTime($startDate);
            $later = new \DateTime($endDate);
            $diff = $later->diff($earlier)->format("%a");

            if ($diff >= 31) {
                // \Session::flash('error', 'The number of days in the date ranges should be lower or equal to 31 days');
                return redirect('admin/reports/revenue');
            }
        } else {
            $currentDate = date('Y-m-d');
            $startDate = date('Y-m-01', strtotime($currentDate));
            $endDate = date('Y-m-t', strtotime($currentDate));
        }

        $completed = Order::COMPLETED;
        $payment_status = Order::PAID;

        $t = "with recursive dates as (
            select :start_date_series date
            union all
            select dates.date + interval 1 day from dates where dates.date < :end_date_series
        ),
        filtered_orders AS (
            SELECT *
            FROM orders
            WHERE DATE(order_date) >= :start_date
                AND DATE(order_date) <= :end_date
                AND status = :status
                AND payment_status = :payment_status
        )
        SELECT
        DISTINCT DR.date,
        COUNT(FO.id) num_of_orders,
        COALESCE(SUM(FO.grand_total),0) gross_revenue,
        COALESCE(SUM(FO.tax_amount),0) taxes_amount,
        COALESCE(SUM(FO.shipping_cost),0) shipping_amount,
        COALESCE(SUM(FO.grand_total - FO.tax_amount - FO.shipping_cost - FO.discount_amount),0) net_revenue
    FROM dates DR
    LEFT JOIN filtered_orders FO ON DATE(order_date) = DR.date
    GROUP BY DR.date
    ORDER BY DR.date ASC";

        $revenues = \DB::select($t,[
            'start_date_series' => $startDate,
            'end_date_series' => $endDate,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => Order::COMPLETED,
            'payment_status' => Order::PAID,
        ]);

        $revenues = ($startDate && $endDate) ? $revenues : [];

        if ($exportAs = $request->input('export')) {
            if (!in_array($exportAs, ['xlsx', 'pdf'])) {
                // \Session::flash('error', 'Invalid export request');
                return redirect('admin/reports/revenue');
            }

            if ($exportAs == 'xlsx') {
                $fileName = 'report-revenue-'. $startDate .'-'. $endDate .'.xlsx';

                return Excel::download(new ReportRevenue($revenues), $fileName);
            }

            if ($exportAs == 'pdf') {
                $fileName = 'report-revenue-'. $startDate .'-'. $endDate .'.pdf';
                $pdf = PDF::loadView('admin.reports.exports.pdf_revenue', compact('revenues','startDate','endDate'));

                return $pdf->download($fileName);
            }
        }

        return view('admin.reports.revenue', compact('revenues','exports'));
    }

    /**
     * Generate PDF report for revenue with query params
     */
    public function revenuePdf(Request $request)
    {
        $awal = $request->input('awal') ?? now()->startOfMonth()->format('Y-m-d');
        $akhir = $request->input('akhir') ?? now()->endOfMonth()->format('Y-m-d');
        
        return $this->generateRevenuePdf($awal, $akhir);
    }

    /**
     * Generate PDF report for revenue with URL params
     */
    public function revenuePdfWithDates($awal, $akhir)
    {
        return $this->generateRevenuePdf($awal, $akhir);
    }

    /**
     * Private helper to generate revenue PDF
     */
    private function generateRevenuePdf($awal, $akhir)
    {
        // Query orders within date range
        $orders = Order::whereBetween('created_at', [$awal . ' 00:00:00', $akhir . ' 23:59:59'])
            ->where('status', Order::COMPLETED)
            ->where('payment_status', Order::PAID)
            ->with(['items', 'user', 'shipment'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Calculate totals
        $totalRevenue = $orders->sum('grand_total');
        $totalOrders = $orders->count();
        $totalTax = $orders->sum('tax_amount');
        $totalShipping = $orders->sum('shipping_cost');
        $totalDiscount = $orders->sum('discount_amount');
        $netRevenue = $totalRevenue - $totalTax - $totalShipping;
        
        // Group by date
        $revenueByDate = $orders->groupBy(function($order) {
            return $order->created_at->format('Y-m-d');
        })->map(function($dayOrders) {
            return [
                'date' => $dayOrders->first()->created_at->format('d M Y'),
                'orders_count' => $dayOrders->count(),
                'gross_revenue' => $dayOrders->sum('grand_total'),
                'net_revenue' => $dayOrders->sum('grand_total') - $dayOrders->sum('tax_amount') - $dayOrders->sum('shipping_cost'),
                'tax' => $dayOrders->sum('tax_amount'),
                'shipping' => $dayOrders->sum('shipping_cost'),
            ];
        });
        
        // Prepare data for view
        $data = [
            'title' => 'Laporan Revenue',
            'period_start' => \Carbon\Carbon::parse($awal)->format('d M Y'),
            'period_end' => \Carbon\Carbon::parse($akhir)->format('d M Y'),
            'total_revenue' => $totalRevenue,
            'total_orders' => $totalOrders,
            'total_tax' => $totalTax,
            'total_shipping' => $totalShipping,
            'total_discount' => $totalDiscount,
            'net_revenue' => $netRevenue,
            'revenue_by_date' => $revenueByDate,
            'generated_at' => now()->format('d M Y H:i:s')
        ];
        
        // Generate PDF
        $pdf = \PDF::loadView('admin.reports.revenue-pdf', $data);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        
        // Generate filename
        $filename = 'revenue-report-' . $awal . '-to-' . $akhir . '.pdf';
        
        // Download PDF
        return $pdf->download($filename);
    }

    public function exportExcel()
    {
        return Excel::download(new LaporanExport, 'laporan.xlsx');
    }

    public function product(Request $request)
	{
        $exports = $this->exports;

		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			// \Session::flash('error', 'The end date is required if the start date is present');
			return redirect('admin/reports/product');
		}

		if (!$startDate && $endDate) {
			// \Session::flash('error', 'The start date is required if the end date is present');
			return redirect('admin/reports/product');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				// \Session::flash('error', 'The end date should be greater or equal than start date');
				return redirect('admin/reports/product');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");

			if ($diff >= 31) {
				// \Session::flash('error', 'The number of days in the date ranges should be lower or equal to 31 days');
				return redirect('admin/reports/product');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}

		$sql = "
		SELECT
			OI.product_id,
			OI.name,
			OI.sku,
			SUM(OI.qty) as items_sold,
			COALESCE(SUM(OI.sub_total - OI.tax_amount - OI.discount_amount),0) net_revenue,
			COUNT(OI.order_id) num_of_orders,
			PI.qty as stock
		FROM order_items OI
		LEFT JOIN orders O ON O.id = OI.order_id
		LEFT JOIN product_inventories PI ON PI.product_id = OI.product_id
		WHERE DATE(O.order_date) >= :start_date
			AND DATE(O.order_date) <= :end_date
			AND O.status = :status
			AND O.payment_status = :payment_status
		GROUP BY OI.product_id, OI.name, OI.sku, PI.qty
		";

		$products = \DB::select(
			$sql,
			[
				'start_date' => $startDate,
				'end_date' => $endDate,
				'status' => Order::COMPLETED,
				'payment_status' => Order::PAID,
			]
		);

		$products = ($startDate && $endDate) ? $products : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				// \Session::flash('error', 'Invalid export request');
				return redirect('admin/reports/product');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-product-'. $startDate .'-'. $endDate .'.xlsx';

				return Excel::download(new ReportProduct($products), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-product-'. $startDate .'-'. $endDate .'.pdf';
				$pdf = PDF::loadView('admin.reports.exports.pdf_product', compact('products','startDate','endDate'));

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.product', compact('products', 'exports'));
    }

    public function productPdf(Request $request)
    {
        $startDate = $request->input('start') ?? date('Y-m-01');
        $endDate = $request->input('end') ?? date('Y-m-t');

        $sql = "
        SELECT
            OI.product_id,
            OI.name,
            OI.sku,
            SUM(OI.qty) as items_sold,
            COALESCE(SUM(OI.sub_total - OI.tax_amount - OI.discount_amount),0) net_revenue,
            COUNT(OI.order_id) num_of_orders,
            PI.qty as stock
        FROM order_items OI
        LEFT JOIN orders O ON O.id = OI.order_id
        LEFT JOIN product_inventories PI ON PI.product_id = OI.product_id
        WHERE DATE(O.order_date) >= :start_date
            AND DATE(O.order_date) <= :end_date
            AND O.status = :status
            AND O.payment_status = :payment_status
        GROUP BY OI.product_id, OI.name, OI.sku, PI.qty
        ";

        $products = \DB::select($sql, [
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => Order::COMPLETED,
            'payment_status' => Order::PAID,
        ]);

        $fileName = 'report-product-' . $startDate . '-' . $endDate . '.pdf';
        $pdf = PDF::loadView('admin.reports.exports.pdf_product', compact('products', 'startDate', 'endDate'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download($fileName);
    }

    public function testPdfUI()
    {
        return view('admin.reports.test-pdf');
    }

    public function runPdfTest(Request $request)
    {
        $start = microtime(true);

        try {
            $startDate = $request->input('start') ?? date('Y-m-01');
            $endDate = $request->input('end') ?? date('Y-m-t');

            $sql = "
            SELECT
                OI.product_id,
                OI.name,
                OI.sku,
                SUM(OI.qty) as items_sold,
                COALESCE(SUM(OI.sub_total - OI.tax_amount - OI.discount_amount),0) net_revenue,
                COUNT(OI.order_id) num_of_orders,
                PI.qty as stock
            FROM order_items OI
            LEFT JOIN orders O ON O.id = OI.order_id
            LEFT JOIN product_inventories PI ON PI.product_id = OI.product_id
            WHERE DATE(O.order_date) >= :start_date
                AND DATE(O.order_date) <= :end_date
                AND O.status = :status
                AND O.payment_status = :payment_status
            GROUP BY OI.product_id, OI.name, OI.sku, PI.qty
            ";

            $products = \DB::select($sql, [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => Order::COMPLETED,
                'payment_status' => Order::PAID,
            ]);

            $pdf = PDF::loadView('admin.reports.exports.pdf_product', compact('products', 'startDate', 'endDate'));
            $pdf->setPaper('A4', 'landscape');

            $output = $pdf->output();
            $elapsed = round(microtime(true) - $start, 2);
            $size = strlen($output);

            return response()->json([
                'success' => true,
                'status_code' => 200,
                'message' => 'PDF berhasil digenerate',
                'file_size' => $this->formatBytes($size),
                'file_size_bytes' => $size,
                'generation_time' => $elapsed . 's',
                'num_products' => count($products),
                'download_url' => route('admin.reports.product.pdf', ['start' => $startDate, 'end' => $endDate]),
            ]);
        } catch (\Exception $e) {
            $elapsed = round(microtime(true) - $start, 2);
            $codeFile = file_get_contents(app_path('Exports/ReportProduct.php'));
            $lines = explode("\n", $codeFile);
            $codeSnippet = '';
            $startLine = max(0, $e->getLine() - 5);
            $endLine = min(count($lines), $e->getLine() + 5);
            for ($i = $startLine; $i < $endLine; $i++) {
                $lineNum = str_pad($i + 1, 4, ' ', STR_PAD_LEFT);
                $marker = ($i + 1 === $e->getLine()) ? ' >>' : '   ';
                $codeSnippet .= "{$marker} {$lineNum}: {$lines[$i]}";
            }

            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => $e->getMessage(),
                'generation_time' => $elapsed . 's',
                'error_file' => str_replace(base_path(), '', $e->getFile()),
                'error_line' => $e->getLine(),
                'code_snippet' => $codeSnippet,
            ]);
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function inventory(Request $request)
	{
        $exports = $this->exports;

		$sql = "
		SELECT
			P.*,
			PI.qty as stock
		FROM product_inventories PI
		LEFT JOIN products P ON P.id = PI.product_id
		ORDER BY stock ASC
		";

		$products = \DB::select($sql);

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				// \Session::flash('error', 'Invalid export request');
				return redirect('admin/reports/inventory');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-inventory.xlsx';

				return Excel::download(new ReportInventory($products), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-inventory.pdf';
				$pdf = PDF::loadView('admin.reports.exports.pdf_inventory', compact('products'));

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.inventory', compact('products', 'exports'));
    }

    public function payment(Request $request)
	{
        $exports = $this->exports;

		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			// \Session::flash('error', 'The end date is required if the start date is present');
			return redirect('admin/reports/payment');
		}

		if (!$startDate && $endDate) {
			// \Session::flash('error', 'The start date is required if the end date is present');
			return redirect('admin/reports/payment');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				// \Session::flash('error', 'The end date should be greater or equal than start date');
				return redirect('admin/reports/payment');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");

			if ($diff >= 31) {
				// \Session::flash('error', 'The number of days in the date ranges should be lower or equal to 31 days');
				return redirect('admin/reports/payment');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}

		$sql = "
		SELECT
			O.code,
			P.*
		FROM payments P
		LEFT JOIN orders O ON O.id = P.order_id
		WHERE DATE(P.created_at) >= :start_date
			AND DATE(P.created_at) <= :end_date
		ORDER BY created_at DESC
		";

		$payments = \DB::select($sql,
			[
				'start_date' => $startDate,
				'end_date' => $endDate
			]
		);

		$payments = ($startDate && $endDate) ? $payments : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				// \Session::flash('error', 'Invalid export request');
				return redirect('admin/reports/payment');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-payment-'. $startDate .'-'. $endDate .'.xlsx';

				return Excel::download(new ReportPayment($payments), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-payment-'. $startDate .'-'. $endDate .'.pdf';
				$pdf = PDF::loadView('admin.reports.exports.pdf_payment', compact('payments','startDate','endDate'));

				return $pdf->download($fileName);
			}
		}

		return view('admin.reports.payment', compact('payments', 'exports'));
	}
}
