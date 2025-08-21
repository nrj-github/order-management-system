@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-4">Create Customer</h2>
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" name="name" id="name" class="w-full border rounded px-2 py-1 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="w-full border rounded px-2 py-1 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="phone_number" class="block text-gray-700">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number" class="w-full border rounded px-2 py-1 @error('phone_number') border-red-500 @enderror" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700">Address</label>
                        <textarea name="address" id="address" class="w-full border rounded px-2 py-1 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2 hover:bg-blue-600">Create Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection