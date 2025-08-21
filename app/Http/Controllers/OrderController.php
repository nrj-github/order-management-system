<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('customer');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
        public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;
        $orderItems = [];

        // Check for insufficient stock first
        foreach ($request->input('products') as $item) {
            $product = Product::find($item['id']);
            if ($product->stock_quantity < $item['quantity']) {
                return redirect()->back()->with('error', 'Insufficient stock for ' . $product->name . '. Only ' . $product->stock_quantity . ' available.')->withInput();
            }
            $subtotal = $product->price * $item['quantity'];
            $totalAmount += $subtotal;
            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
            ];
        }

        // Use a transaction to ensure everything is saved or nothing is
        DB::transaction(function () use ($request, $totalAmount, $orderItems) {
            // Create the order
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Create order items and update product stock
            foreach ($orderItems as $item) {
                $order->orderItems()->create($item);

                // Update product stock
                $product = Product::find($item['product_id']);
                $product->decrement('stock_quantity', $item['quantity']);
            }
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $products = Product::all();
        $order->load('orderItems');

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    // Rest of the methods...
}