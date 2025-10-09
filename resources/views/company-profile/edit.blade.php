@extends('layouts.app')

@section('title', 'Edit Company Profile')

@section('content')
<div class="max-w-4xl mx-auto p-4 md:p-6">
  <div class="mb-6">
    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight">Edit Company Profile</h1>
    <nav aria-label="breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-gray-500">
        <li><a href="{{ route('dashboard') }}" class="hover:text-gray-700">Dashboard</a></li>
        <li class="text-gray-400">/</li>
        <li><a href="{{ route('company-profile.index') }}" class="hover:text-gray-700">Company Profile</a></li>
        <li class="text-gray-400">/</li>
        <li class="text-gray-700">Edit</li>
      </ol>
    </nav>
  </div>

  <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
    <div>
      <form action="{{ route('company-profile.update') }}" method="POST" enctype="multipart/form-data"
        class="space-y-8">
        @csrf
        @method('PUT')

        <h5 class="mb-3 text-sm font-semibold tracking-wide text-gray-700">Basic Information</h5>

        <div class="mb-3">
          <label for="company_name" class="mb-1 block text-sm font-medium text-gray-700">Company Name <span
              class="text-red-500">*</span></label>
          <input type="text" id="company_name" name="company_name"
            class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('company_name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
            value="{{ old('company_name', $profile->company_name ?? '') }}" required>
          @error('company_name')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description <span
              class="text-red-500">*</span></label>
          <textarea id="description" name="description" rows="4"
            class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('description') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
            required>{{ old('description', $profile->description ?? '') }}</textarea>
          @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="logo" class="mb-1 block text-sm font-medium text-gray-700">Company Logo</label>

          @if($profile && $profile->logo)
          <div class="mb-3">
            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Current logo"
              class="h-auto max-w-[200px] rounded-lg border border-gray-200">
            <p class="mt-1 text-xs text-gray-500">Current logo</p>
          </div>
          @endif

          <input type="file" id="logo" name="logo" accept="image/jpeg,image/png,image/jpg"
            class="p-2 block w-full rounded-lg text-sm file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-medium hover:file:bg-gray-200 {{ $errors->has('logo') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
          <p class="mt-1 text-xs text-gray-500">Leave empty to keep current logo. Max size: 2MB.</p>
          @error('logo')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <hr class="my-6 border-gray-200">
        <h5 class="mb-3 text-sm font-semibold tracking-wide text-gray-700">Contact Information</h5>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div class="mb-3">
            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email <span
                class="text-red-500">*</span></label>
            <input type="email" id="email" name="email"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('email') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('email', $profile->email ?? '') }}" required>
            @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">Phone <span
                class="text-red-500">*</span></label>
            <input type="text" id="phone" name="phone"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('phone') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('phone', $profile->phone ?? '') }}" required>
            @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="mb-3">
          <label for="address" class="mb-1 block text-sm font-medium text-gray-700">Address <span
              class="text-red-500">*</span></label>
          <textarea id="address" name="address" rows="3"
            class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('address') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
            required>{{ old('address', $profile->address ?? '') }}</textarea>
          @error('address')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <hr class="my-6 border-gray-200">
        <h5 class="mb-3 text-sm font-semibold tracking-wide text-gray-700">Vision & Mission</h5>

        <div class="mb-3">
          <label for="vision" class="mb-1 block text-sm font-medium text-gray-700">Vision <span
              class="text-red-500">*</span></label>
          <textarea id="vision" name="vision" rows="3"
            class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('vision') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
            required>{{ old('vision', $profile->vision ?? '') }}</textarea>
          @error('vision')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="mb-3">
          <label for="mission" class="mb-1 block text-sm font-medium text-gray-700">Mission <span
              class="text-red-500">*</span></label>
          <textarea id="mission" name="mission" rows="3"
            class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('mission') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
            required>{{ old('mission', $profile->mission ?? '') }}</textarea>
          @error('mission')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <hr class="my-6 border-gray-200">
        <h5 class="mb-3 text-sm font-semibold tracking-wide text-gray-700">Social Media</h5>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div class="mb-3">
            <label for="facebook" class="mb-1 block text-sm font-medium text-gray-700">Facebook URL</label>
            <input type="url" id="facebook" name="facebook"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('facebook') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('facebook', $profile->social_media['facebook'] ?? '') }}"
              placeholder="https://facebook.com/yourpage">
            @error('facebook')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="instagram" class="mb-1 block text-sm font-medium text-gray-700">Instagram URL</label>
            <input type="url" id="instagram" name="instagram"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('instagram') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('instagram', $profile->social_media['instagram'] ?? '') }}"
              placeholder="https://instagram.com/yourpage">
            @error('instagram')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div class="mb-3">
            <label for="twitter" class="mb-1 block text-sm font-medium text-gray-700">Twitter URL</label>
            <input type="url" id="twitter" name="twitter"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('twitter') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('twitter', $profile->social_media['twitter'] ?? '') }}"
              placeholder="https://twitter.com/yourpage">
            @error('twitter')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-3">
            <label for="linkedin" class="mb-1 block text-sm font-medium text-gray-700">LinkedIn URL</label>
            <input type="url" id="linkedin" name="linkedin"
              class="p-2 block w-full rounded-lg shadow-sm {{ $errors->has('linkedin') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}"
              value="{{ old('linkedin', $profile->social_media['linkedin'] ?? '') }}"
              placeholder="https://linkedin.com/company/yourcompany">
            @error('linkedin')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <hr class="my-6 border-gray-200">

        <div class="flex items-center justify-between">
          <a href="{{ route('company-profile.index') }}"
            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</a>
          <button type="submit"
            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update
            Profile</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection