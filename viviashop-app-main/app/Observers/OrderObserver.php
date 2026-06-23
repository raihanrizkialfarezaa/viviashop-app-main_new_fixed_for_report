<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Order "updated" event.
     * 
     * When an order's payment status changes to 'paid',
     * increment the sold_count for each product in the order.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        // Check if payment_status changed to 'paid'
        if ($order->isDirty('payment_status') && $order->payment_status === 'paid') {
            try {
                // Get all order items for this order
                $orderItems = $order->orderItems;
                
                if ($orderItems && $orderItems->count() > 0) {
                    foreach ($orderItems as $item) {
                        if ($item->product_id) {
                            // Find the product and increment sold_count
                            $product = Product::find($item->product_id);
                            
                            if ($product) {
                                // Increment sold_count by the quantity sold
                                $product->increment('sold_count', $item->qty);
                                
                                Log::info("Product sold_count updated", [
                                    'product_id' => $product->id,
                                    'product_name' => $product->name,
                                    'quantity' => $item->qty,
                                    'new_sold_count' => $product->sold_count,
                                    'order_id' => $order->id,
                                ]);
                            } else {
                                Log::warning("Product not found when updating sold_count", [
                                    'product_id' => $item->product_id,
                                    'order_id' => $order->id,
                                ]);
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::error("Error updating product sold_count in OrderObserver", [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }
    }
}
