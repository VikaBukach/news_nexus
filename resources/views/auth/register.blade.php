@extends('structure.layout')
@section('title', 'Register')

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl font-medium">
                Registration form</h1>

            <form action="{{ route("register_process") }}" class="space-y-5 mt-5" method="POST">
                @csrf

                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror" placeholder="Name" />

                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Password" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Confirm password" />

                @error('password_confirmation')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <a href="{{ route("login") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Do you have an account?</a>
                </div>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Register</button>
            </form>
        </div>
    </div>
@endsection
