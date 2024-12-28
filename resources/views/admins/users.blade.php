@extends('layouts.admin-nav')

@section('content')
<div class="container mx-auto p-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-500 text-white p-4 rounded shadow">
            <h2 class="text-xl font-bold">Total Users</h2>
            <p class="text-3xl mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-brown-700 text-white p-4 rounded shadow">
            <h2 class="text-xl font-bold"><i class="fa-solid fa-circle fa-beat" style="color: #13fb59;"></i> Active Users </h2>
            <p class="text-3xl mt-2">{{ $activeUsers }}</p>
        </div>
        <div class="bg-red-500 text-white p-4 rounded shadow">
            <h2 class="text-xl font-bold">Admins</h2>
            <p class="text-3xl mt-2">{{ $admins }}</p>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-2xl font-bold mb-4">Users</h2>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">#</th>
                    <th class="border border-gray-300 p-2">Name</th>
                    <th class="border border-gray-300 p-2">Email</th>
                    <th class="border border-gray-300 p-2">Role</th>
                    <th class="border border-gray-300 p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $user->id }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 p-2">{{ucfirst( $user->role)  }}</td>
                        <td class="border border-gray-300 p-2">
                            @if (auth()->id() !== $user->id) <!-- Prevent deleting self -->
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
                                </form>
                            @else
                                <span class="text-gray-500">Cannot delete self</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="text-center text-sm text-white-600 mt-10 text-gray-500">
    Created by : Pulditha Wathsal | CB011498 | CB011498@students.apiit.lk
</div>

@endsection
