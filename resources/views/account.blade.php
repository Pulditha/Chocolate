@extends('layouts.app')  

@section('content')  
<div class="container mx-auto py-6">  
    <h1 class="text-2xl font-bold">Account Page</h1>  
    <p>Welcome, {{ auth()->user()->name }}!</p>  

    <form method="POST" action="{{ route('logout') }}">  
        @csrf  
        <button type="submit" class="mt-4 bg-red-500 text-white py-2 px-4 rounded">Logout</button>  
    </form>  
</div>  
@endsection