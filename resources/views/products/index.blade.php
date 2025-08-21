@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold">Products</h2>
                    <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Product</a>
                </div>

                <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                    <input type="text" name="search" placeholder="Search products..." class="border rounded px-2 py-1">
                    <button type="submit" class="bg-gray-300 rounded px-4 py-1 ml-2">Search</button>
                </form>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock_quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('products.edit', $product) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection