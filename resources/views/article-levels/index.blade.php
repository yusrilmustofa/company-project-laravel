@extends('layouts.app')

@section('title', 'Article Levels')

@section('content')
<div class="p-6">
  <!-- Header Section -->
  <div class="flex justify-between items-center mb-6">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Article Levels</h1>
      <p class="text-gray-600 mt-1">Manage article difficulty levels and categories</p>
    </div>
    <a href="{{ route('article-levels.create') }}"
      class="inline-flex items-center px-4 py-2 text-blue-400 font-medium rounded-lg transition-colors duration-200 text-sm hover:bg-slate-100 hover:text-blue-600">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      Create New Level
    </a>
  </div>

  <!-- Success Message -->
  @if(session('success'))
  <div
    class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
    <div class="flex items-center">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
          clip-rule="evenodd"></path>
      </svg>
      {{ session('success') }}
    </div>
    <button type="button" onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-700">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </button>
  </div>
  @endif

  <!-- Error Message -->
  @if(session('error'))
  <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between">
    <div class="flex items-center">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
          clip-rule="evenodd"></path>
      </svg>
      {{ session('error') }}
    </div>
    <button type="button" onclick="this.parentElement.style.display='none'" class="text-red-500 hover:text-red-700">
      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
          clip-rule="evenodd"></path>
      </svg>
    </button>
  </div>
  @endif

  <!-- Levels Table -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200" id="levelsTable">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articles Count
            </th>
            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse($levels as $level)
          <tr class="hover:bg-gray-50 transition-colors duration-150" data-id="{{ $level->id }}">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <span
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                  {{ $level->level_order }}
                </span>
                <svg class="w-4 h-4 text-gray-400 ml-2 cursor-move" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                </svg>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm font-medium text-gray-900">{{ $level->name }}</div>
              @if($level->description)
              <div class="text-sm text-gray-500 mt-1">{{ Str::limit($level->description, 80) }}</div>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($level->color)
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white"
                style="background-color: {{ $level->color }};">
                {{ $level->color }}
              </span>
              @else
              <span class="text-gray-400">-</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($level->status === 'active')
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                  <circle cx="4" cy="4" r="3"></circle>
                </svg>
                Active
              </span>
              @else
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                <svg class="w-2 h-2 mr-1.5" fill="currentColor" viewBox="0 0 8 8">
                  <circle cx="4" cy="4" r="3"></circle>
                </svg>
                Inactive
              </span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
              @php
              try {
              $articlesCount = $level->articles ? $level->articles->count() : 0;
              } catch (\Exception $e) {
              $articlesCount = 0;
              }
              @endphp
              <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $articlesCount }}
              </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <div class="flex space-x-2">
                <a href="{{ route('article-levels.edit', $level) }}"
                  class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                  <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                  </svg>
                  Edit
                </a>
                <form action="{{ route('article-levels.destroy', $level) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this level? This action cannot be undone.')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="inline-flex items-center px-3 py-1.5 border border-red-300 shadow-sm text-xs font-medium rounded text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                      </path>
                    </svg>
                    Delete
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="px-6 py-12 text-center">
              <div class="flex flex-col items-center">
                <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                  </path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No article levels found</h3>
                <p class="text-gray-500 mb-4">Get started by creating your first article level.</p>
                <a href="{{ route('article-levels.create') }}"
                  class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                  </svg>
                  Create New Level
                </a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const table = document.getElementById('levelsTable');
  const tbody = table.querySelector('tbody');

  new Sortable(tbody, {
    animation: 150,
    handle: 'svg.cursor-move',
    onEnd: function(evt) {
      const rows = tbody.querySelectorAll('tr[data-id]');
      const data = [];

      rows.forEach((row, index) => {
        data.push({
          id: row.dataset.id,
          order: index + 1
        });
      });

      // Update order badges
      rows.forEach((row, index) => {
        const badge = row.querySelector('.bg-gray-100');
        if (badge) {
          badge.textContent = index + 1;
        }
      });

      // Send AJAX request to update order
      fetch('{{ route("article-levels.updateOrder") }}', {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
            levels: data
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            console.log('Order updated successfully');
          }
        })
        .catch(error => {
          console.error('Error updating order:', error);
          // Refresh page if there's an error
          location.reload();
        });
    }
  });
});
</script>
@endpush