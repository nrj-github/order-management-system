@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Product Name</label>
                        <input type="text" name="name" id="name" class="w-full border rounded px-2 py-1" value="{{ $product->name }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full border rounded px-2 py-1">{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700">Price</label>
                        <input type="number" name="price" id="price" class="w-full border rounded px-2 py-1" step="0.01" min="0" value="{{ $product->price }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="stock_quantity" class="block text-gray-700">Stock Quantity</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" class="w-full border rounded px-2 py-1" min="0" value="{{ $product->stock_quantity }}" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Update Product</button>
                    <a href="{{ route('products.index') }}" class="ml-2 bg-gray-300 rounded px-4 py-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection