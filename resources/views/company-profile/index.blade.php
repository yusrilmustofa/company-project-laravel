@extends('layouts.app')

@section('title', 'Company Profile')

@section('content')
<div class="max-w-7xl mx-auto p-4 md:p-6">
  <div class="mb-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl md:text-3xl font-semibold tracking-tight">Company Profile</h1>
      <a href="{{ route('company-profile.edit') }}"
        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Edit Profile
      </a>
    </div>
  </div>

  @if(session('success'))
  <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
    {{ session('success') }}
  </div>
  @endif

  @if($profile)
  <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    <div class="md:col-span-1 space-y-6">
      <div class="rounded-xl border border-gray-200 bg-white p-6 text-center shadow-sm">
        @if($profile->logo)
        <img src="{{ asset('storage/' . $profile->logo) }}" alt="{{ $profile->company_name }}"
          class="mx-auto mb-4 h-auto max-w-[200px]">
        @else
        <div class="mb-4 rounded-lg border border-dashed border-gray-300 bg-gray-50 p-10">
          <span class="text-sm font-medium text-gray-500">No Logo</span>
        </div>
        @endif
        <h4 class="text-lg font-semibold">{{ $profile->company_name }}</h4>
      </div>

      <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-3">
          <strong class="text-sm">Contact Information</strong>
        </div>
        <div class="space-y-3 px-6 py-4 text-sm">
          <p><span class="block text-gray-500">Email</span><span class="font-medium">{{ $profile->email }}</span></p>
          <p><span class="block text-gray-500">Phone</span><span class="font-medium">{{ $profile->phone }}</span></p>
          <p><span class="block text-gray-500">Address</span><span class="font-medium">{{ $profile->address }}</span></p>
        </div>
      </div>
    </div>

    <div class="md:col-span-2 space-y-6">
      <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-3">
          <strong class="text-sm">About Company</strong>
        </div>
        <div class="px-6 py-4">
          <p class="text-sm leading-6 text-gray-700">{{ $profile->description }}</p>
        </div>
      </div>

      <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-3">
          <strong class="text-sm">Vision</strong>
        </div>
        <div class="px-6 py-4">
          <p class="text-sm leading-6 text-gray-700">{{ $profile->vision }}</p>
        </div>
      </div>

      <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-3">
          <strong class="text-sm">Mission</strong>
        </div>
        <div class="px-6 py-4">
          <p class="text-sm leading-6 text-gray-700">{{ $profile->mission }}</p>
        </div>
      </div>

      <div class="rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-3">
          <strong class="text-sm">Social Media</strong>
        </div>
        <div class="px-6 py-4">
          @if($profile->social_media)
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @if(!empty($profile->social_media['facebook']))
            <div>
              <span class="block text-sm text-gray-500">Facebook</span>
              <a href="{{ $profile->social_media['facebook'] }}" target="_blank"
                class="truncate text-sm font-medium text-indigo-600 hover:underline">
                {{ $profile->social_media['facebook'] }}
              </a>
            </div>
            @endif

            @if(!empty($profile->social_media['instagram']))
            <div>
              <span class="block text-sm text-gray-500">Instagram</span>
              <a href="{{ $profile->social_media['instagram'] }}" target="_blank"
                class="truncate text-sm font-medium text-indigo-600 hover:underline">
                {{ $profile->social_media['instagram'] }}
              </a>
            </div>
            @endif

            @if(!empty($profile->social_media['twitter']))
            <div>
              <span class="block text-sm text-gray-500">Twitter</span>
              <a href="{{ $profile->social_media['twitter'] }}" target="_blank"
                class="truncate text-sm font-medium text-indigo-600 hover:underline">
                {{ $profile->social_media['twitter'] }}
              </a>
            </div>
            @endif

            @if(!empty($profile->social_media['linkedin']))
            <div>
              <span class="block text-sm text-gray-500">LinkedIn</span>
              <a href="{{ $profile->social_media['linkedin'] }}" target="_blank"
                class="truncate text-sm font-medium text-indigo-600 hover:underline">
                {{ $profile->social_media['linkedin'] }}
              </a>
            </div>
            @endif
          </div>
          @else
          <p class="text-sm text-gray-500">No social media links added.</p>
          @endif
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-sm text-yellow-900">
    <p class="mb-3">No company profile found. Please create one.</p>
    <a href="{{ route('company-profile.edit') }}"
      class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
      Create Profile
    </a>
  </div>
  @endif
  </div>
@endsection