@extends('layouts.app')

@section('title', 'Create Article')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Create New Article</h1>
    <nav aria-label="Breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-gray-500">
        <li>
          <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Dashboard</a>
        </li>
        <li class="text-gray-400">/</li>
        <li>
          <a href="{{ route('articles.index') }}" class="hover:text-gray-700">Articles</a>
        </li>
        <li class="text-gray-400">/</li>
        <li class="text-gray-700">Create</li>
      </ol>
    </nav>
  </div>

  <div class="bg-white shadow-sm ring-1 ring-gray-200 rounded-xl">
    <div class="p-6">
      <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
          <label for="title" class="block text-sm font-medium text-gray-700">Title <span
              class="text-rose-600">*</span></label>
          <input type="text" id="title" name="title" value="{{ old('title') }}" required
            class="p-2 mt-1 block w-full rounded-md shadow-sm {{ $errors->has('title') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
          @error('title')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="content" class="block text-sm font-medium text-gray-700">Content <span
              class="text-rose-600">*</span></label>
          <textarea id="content" name="content" rows="10" required
            class="p-2 mt-1 block w-full rounded-md shadow-sm {{ $errors->has('content') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">{{ old('content') }}</textarea>
          @error('content')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700">Featured Image</label>
          <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg"
            class="mt-1 block w-full text-sm text-gray-900 file:mr-4 file:rounded-md file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-gray-700 hover:file:bg-gray-200 focus:outline-none">
          <p class="mt-2 text-xs text-gray-500">Max size: 2MB. Formats: JPEG, PNG, JPG</p>
          @error('image')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category <span
                class="text-rose-600">*</span></label>
            <select id="category_id" name="category_id" required
              class="mt-1 block w-full rounded-md bg-white shadow-sm {{ $errors->has('category_id') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
              <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>-- Select Category --</option>
              @foreach($categories as $category)
              <option value="{{ $category->_id }}" {{ old('category_id') == $category->_id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
              @endforeach
            </select>
            @error('category_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status <span
                class="text-rose-600">*</span></label>
            <select id="status" name="status" required
              class="mt-1 block w-full rounded-md bg-white shadow-sm {{ $errors->has('status') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
              <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
              <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex items-center justify-between pt-4">
          <a href="{{ route('articles.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Cancel
          </a>
          <button type="submit"
            class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Create Article
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection