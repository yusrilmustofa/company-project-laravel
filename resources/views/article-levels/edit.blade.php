@extends('layouts.app')

@section('title', 'Edit Article Level')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-900">Edit Article Level: {{ $articleLevel->name }}</h1>
    <nav aria-label="Breadcrumb" class="mt-2">
      <ol class="flex items-center gap-2 text-sm text-gray-500">
        <li>
          <a href="{{ route('dashboard') }}" class="hover:text-gray-700">Dashboard</a>
        </li>
        <li class="text-gray-400">/</li>
        <li>
          <a href="{{ route('article-levels.index') }}" class="hover:text-gray-700">Article Levels</a>
        </li>
        <li class="text-gray-400">/</li>
        <li class="text-gray-700">Edit</li>
      </ol>
    </nav>
  </div>

  <div class="bg-white shadow-sm ring-1 ring-gray-200 rounded-xl">
    <div class="p-6">
      <form action="{{ route('article-levels.update', $articleLevel) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
          <!-- Main Form Fields -->
          <div class="lg:col-span-2 space-y-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Level Name <span
                  class="text-rose-600">*</span></label>
              <input type="text" id="name" name="name" value="{{ old('name', $articleLevel->name) }}" required
                placeholder="e.g., Beginner, Intermediate, Advanced"
                class="p-2 mt-1 block w-full rounded-md shadow-sm {{ $errors->has('name') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
              @error('name')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea id="description" name="description" rows="3" placeholder="Describe this article level..."
                class="p-2 mt-1 block w-full rounded-md shadow-sm {{ $errors->has('description') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">{{ old('description', $articleLevel->description) }}</textarea>
              @error('description')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
              <div class="mt-1 flex gap-2">
                <input type="color" id="color" name="color"
                  value="{{ old('color', $articleLevel->color ?? '#6c757d') }}"
                  class="h-10 w-16 rounded-md border border-gray-300 cursor-pointer {{ $errors->has('color') ? 'border-red-500' : '' }}">
                <input type="text" id="colorText" value="{{ old('color', $articleLevel->color ?? '#6c757d') }}"
                  placeholder="#6c757d" pattern="^#[0-9A-Fa-f]{6}$"
                  class="flex-1 p-2 rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
              </div>
              <p class="mt-2 text-xs text-gray-500">Choose a color to represent this level in the UI (optional)</p>
              @error('color')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Sidebar -->
          <div class="space-y-6">
            <div>
              <label for="level_order" class="block text-sm font-medium text-gray-700">Display Order</label>
              <input type="number" id="level_order" name="level_order"
                value="{{ old('level_order', $articleLevel->level_order) }}" min="1"
                placeholder="Auto-generated if empty"
                class="p-2 mt-1 block w-full rounded-md shadow-sm {{ $errors->has('level_order') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
              @error('level_order')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
              <p class="mt-2 text-xs text-gray-500">Lower numbers appear first. Leave empty to auto-generate.</p>
            </div>

            <div>
              <label for="status" class="block text-sm font-medium text-gray-700">Status <span
                  class="text-rose-600">*</span></label>
              <select id="status" name="status" required
                class="mt-1 block w-full rounded-md bg-white shadow-sm {{ $errors->has('status') ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500' }}">
                <option value="active" {{ old('status', $articleLevel->status) === 'active' ? 'selected' : '' }}>Active
                </option>
                <option value="inactive" {{ old('status', $articleLevel->status) === 'inactive' ? 'selected' : '' }}>
                  Inactive</option>
              </select>
              @error('status')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Preview Card -->
            <div class="bg-gray-50 rounded-lg p-4">
              <h3 class="text-sm font-medium text-gray-900 mb-3">Preview</h3>
              <div class="flex items-center space-x-2">
                <span id="previewBadge"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white"
                  style="background-color: {{ $articleLevel->color ?? '#6c757d' }};">
                  {{ $articleLevel->name }}
                </span>
                <span id="previewStatus"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($articleLevel->status ?? 'inactive') === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                  {{ ucfirst($articleLevel->status ?? 'inactive') }}
                </span>
              </div>
              <p class="mt-2 text-xs text-gray-500">This is how the level will appear in the article form</p>
            </div>

            <!-- Usage Statistics -->
            <div class="bg-blue-50 rounded-lg p-4">
              <h3 class="text-sm font-medium text-gray-900 mb-3">Usage Statistics</h3>
              @php
              try {
              $articlesCount = $articleLevel->articles ? $articleLevel->articles->count() : 0;
              } catch (\Exception $e) {
              $articlesCount = 0;
              }
              @endphp
              <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-600">Articles using this level:</span>
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                  {{ $articlesCount }}
                </span>
              </div>
              @if($articlesCount > 0)
              <p class="text-xs text-gray-500">
                This level is being used by {{ $articlesCount }} article(s). You cannot delete this level while it's in
                use.
              </p>
              @else
              <p class="text-xs text-gray-500">
                This level is not currently used by any articles.
              </p>
              @endif
            </div>
          </div>
        </div>

        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
          <a href="{{ route('article-levels.index') }}"
            class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
              </path>
            </svg>
            Back to Levels
          </a>
          <div class="flex gap-3">
            <button type="reset"
              class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              Reset
            </button>
            <button type="submit"
              class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Update Level
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const nameInput = document.getElementById('name');
  const colorInput = document.getElementById('color');
  const colorText = document.getElementById('colorText');
  const statusSelect = document.getElementById('status');
  const previewBadge = document.getElementById('previewBadge');
  const previewStatus = document.getElementById('previewStatus');

  // Sync color inputs
  colorInput.addEventListener('input', function() {
    colorText.value = this.value;
    updatePreview();
  });

  colorText.addEventListener('input', function() {
    if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
      colorInput.value = this.value;
      updatePreview();
    }
  });

  // Update preview when name or status changes
  nameInput.addEventListener('input', updatePreview);
  statusSelect.addEventListener('change', updatePreview);

  function updatePreview() {
    const name = nameInput.value || 'Level Name';
    const color = colorInput.value;
    const status = statusSelect.value;

    previewBadge.style.backgroundColor = color;
    previewBadge.textContent = name;

    // Update status badge
    if (status === 'active') {
      previewStatus.className =
        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
      previewStatus.textContent = 'Active';
    } else {
      previewStatus.className =
        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800';
      previewStatus.textContent = 'Inactive';
    }
  }
});
</script>
@endpush