<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\ProductVariant;
use App\Models\StockMovement;
use App\Models\RekamanStok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    public function index()
    {
        $products = Product::with(['productInventory', 'productVariants'])
            ->orderBy('name')
            ->get()
            ->map(function ($product) {
                $stock = 0;
                $variantCount = 0;

                if ($product->type === 'configurable' && $product->productVariants->count() > 0) {
                    $stock = $product->productVariants->sum('stock');
                    $variantCount = $product->productVariants->count();
                } else {
                    $stock = $product->productInventory?->qty ?? 0;
                }

                $product->system_stock = $stock;
                $product->variant_count = $variantCount;

                return $product;
            });

        return view('admin.stock-opname.index', compact('products'));
    }

    public function variants($productId)
    {
        $product = Product::with('productVariants')->findOrFail($productId);

        if ($product->type !== 'configurable') {
            return response()->json(['variants' => []]);
        }

        $variants = $product->productVariants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'name' => $variant->name,
                'sku' => $variant->sku,
                'stock' => $variant->stock,
                'paper_size' => $variant->paper_size,
                'print_type' => $variant->print_type,
            ];
        });

        return response()->json(['variants' => $variants]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.physical_stock' => 'required|integer|min:0',
        ]);

        $results = [];
        $errors = [];

        DB::beginTransaction();
        try {
            foreach ($request->items as $item) {
                $product = Product::with(['productInventory', 'productVariants'])->find($item['product_id']);
                if (!$product) continue;

                $oldStock = $this->getSystemStock($product);
                $newStock = (int) $item['physical_stock'];
                $difference = $newStock - $oldStock;

                if ($difference === 0) {
                    $results[] = [
                        'product_name' => $product->name,
                        'old_stock' => $oldStock,
                        'new_stock' => $newStock,
                        'difference' => 0,
                        'status' => 'same',
                    ];
                    continue;
                }

                if ($product->type === 'configurable' && $product->productVariants->count() > 0) {
                    $totalCurrent = $product->productVariants->sum('stock');
                    $ratio = $totalCurrent > 0 ? $newStock / $totalCurrent : 0;
                    $distributed = 0;
                    $variantCount = $product->productVariants->count();

                    foreach ($product->productVariants as $i => $variant) {
                        if ($i === $variantCount - 1) {
                            $variantNewStock = max(0, $newStock - $distributed);
                        } else {
                            $variantNewStock = max(0, (int) round($variant->stock * $ratio));
                        }

                        $variantOldStock = $variant->stock;
                        $variantDiff = $variantNewStock - $variantOldStock;

                        if ($variantDiff !== 0) {
                            $variant->stock = $variantNewStock;
                            $variant->save();

                            StockMovement::create([
                                'variant_id' => $variant->id,
                                'movement_type' => $variantDiff > 0 ? StockMovement::MOVEMENT_IN : StockMovement::MOVEMENT_OUT,
                                'quantity' => abs($variantDiff),
                                'old_stock' => $variantOldStock,
                                'new_stock' => $variantNewStock,
                                'reference_type' => 'stock_opname',
                                'reason' => StockMovement::REASON_INVENTORY_CORRECTION,
                                'notes' => "Stock opname adjustment (physical: {$newStock})",
                            ]);
                        }

                        $distributed += $variantNewStock;
                    }

                    RekamanStok::create([
                        'product_id' => $product->id,
                        'waktu' => now(),
                        'stok_awal' => $oldStock,
                        'stok_sisa' => $newStock,
                    ]);
                } else {
                    $inventory = $product->productInventory;
                    if ($inventory) {
                        $inventory->qty = $newStock;
                        $inventory->save();
                    }

                    RekamanStok::create([
                        'product_id' => $product->id,
                        'waktu' => now(),
                        'stok_awal' => $oldStock,
                        'stok_sisa' => $newStock,
                    ]);
                }

                $results[] = [
                    'product_name' => $product->name,
                    'old_stock' => $oldStock,
                    'new_stock' => $newStock,
                    'difference' => $difference,
                    'status' => $difference > 0 ? 'increased' : 'decreased',
                ];
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Stock opname berhasil diproses',
                'results' => $results,
                'total_adjusted' => count(array_filter($results, fn($r) => $r['difference'] !== 0)),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'results' => [],
            ], 500);
        }
    }

    private function getSystemStock(Product $product): int
    {
        if ($product->type === 'configurable' && $product->productVariants->count() > 0) {
            return $product->productVariants->sum('stock');
        }
        return $product->productInventory?->qty ?? 0;
    }
}
