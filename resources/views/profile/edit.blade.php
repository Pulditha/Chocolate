@extends('layouts.external')

@section('page-title', 'Profile')
@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow md:mt-5">
    <h2 class="text-xl font-bold mb-4">Edit Profile</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block font-medium">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="w-full rounded mt-1 @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="w-full rounded mt-1 @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block font-medium">New Password</label>
            <input type="password" name="password" id="password" class="w-full border-gray-300 rounded mt-1">
        </div>

        <!-- Password Confirmation -->
        <div class="mb-6">
            <label for="password_confirmation" class="block font-medium">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded mt-1">
        </div>

        <!-- Update Button -->
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded">Update Profile</button>
        </div>
    </form>

    <!-- Delete Account -->
    <div class="mt-6">
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="bg-red-800 text-white px-4 py-2 rounded"
                    onclick="return confirm('Are you sure you want to delete your account?')">
                Delete Account
            </button>
        </form>
    </div>
    <!-- Delete Account -->
    <div class="mt-6">
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 text-white py-2 px-6 rounded">
                Logout
            </button>
            <a href="{{ route('account') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">Cancel</a>
        </form>
    </div>
</div>
@endsection
    