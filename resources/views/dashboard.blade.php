@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-xl font-semibold mb-4">Dashboard</h2>

                <div class="flex space-x-4">
                    <a href="{{ route('customers.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Manage Customers</a>
                    <a href="{{ route('orders.index') }}" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Go to Orders</a>
                    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Manage Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection