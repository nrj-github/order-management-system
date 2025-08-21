@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Create New Order</h2>

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="customer_id" class="block text-gray-700">Customer</label>
                        <select name="customer_id" id="customer_id" class="w-full border rounded px-2 py-1" required>
                            <option value="">Select a Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h3 class="text-lg font-bold my-4">Order Items</h3>
                    <div id="product-list">
                        </div>
                    
                    <button type="button" id="add-product" class="bg-gray-300 text-gray-700 rounded px-4 py-2 hover:bg-gray-400 mb-4">Add Product</button>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Place Order</button>
                        <a href="{{ route('orders.index') }}" class="ml-2 bg-gray-300 rounded px-4 py-2">Cancel</a>
                    </div>
                </form>

                <div id="product-template" style="display: none;">
                    <div class="product-item grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700">Product</label>
                            <select name="products[0][id]" class="w-full border rounded px-2 py-1 product-select" required>
                                <option value="">Select a Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }} (Stock: {{ $product->stock_quantity }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Quantity</label>
                            <input type="number" name="products[0][quantity]" class="w-full border rounded px-2 py-1 quantity-input" min="1" required>
                        </div>
                        <div class="flex items-end">
                            <button type="button" class="remove-product bg-red-500 text-white rounded px-2 py-1 hover:bg-red-600">Remove</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addProductBtn = document.getElementById('add-product');
    const productList = document.getElementById('product-list');
    const productTemplate = document.getElementById('product-template');
    let productCount = 0;

    function addProductField() {
        const newProductItem = productTemplate.firstElementChild.cloneNode(true);
        newProductItem.style.display = 'grid';
        
        // Update names for uniqueness
        newProductItem.querySelectorAll('select, input').forEach(element => {
            const originalName = element.getAttribute('name');
            element.setAttribute('name', originalName.replace('[0]', '[' + productCount + ']'));
        });

        productList.appendChild(newProductItem);
        productCount++;
    }

    // Initial product field
    addProductField();

    addProductBtn.addEventListener('click', addProductField);

    productList.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.closest('.product-item').remove();
        }
    });
});
</script>
@endsection