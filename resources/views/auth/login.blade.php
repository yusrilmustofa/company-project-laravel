@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-12">
  <div class="w-full max-w-md">
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">
      <div class="bg-indigo-600 text-white text-center py-5">
        <h4 class="text-xl font-semibold tracking-wide">Login</h4>
      </div>
      <div class="p-6 sm:p-8">
        @if ($errors->any())
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
          <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
          @csrf

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
              class="block w-full rounded-lg placeholder-gray-400 text-gray-900 {{ $errors->has('email') ? 'ring-1 ring-red-500 border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }} border p-2">
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" id="password" name="password" required
              class="block w-full rounded-lg placeholder-gray-400 text-gray-900 {{ $errors->has('password') ? 'ring-1 ring-red-500 border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}  border p-2">
            @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2">
              <input id="remember" name="remember" type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
              <span class="text-sm text-gray-700">Remember me</span>
            </label>
            <!-- Placeholder for future "Forgot password?" link if needed -->
          </div>

          <button type="submit"
            class="inline-flex w-full justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
            Login
          </button>
        </form>

        <div class="mt-8 text-center text-gray-500">
          <p class="text-xs uppercase tracking-widest">Demo Account</p>
          <div class="mt-2 text-sm">
            <p><span class="font-medium text-gray-700">Email:</span> superadmin@company.com</p>
            <p><span class="font-medium text-gray-700">Password:</span> password123</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection