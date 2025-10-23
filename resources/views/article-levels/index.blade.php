@extends('layouts.app')

@section('title', 'Article Levels')

@section('content')
<div class="container">
  <div class="row mb-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
      <h1>Article Levels</h1>
      <a href="{{ route('article-levels.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Create Level
      </a>
    </div>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif
  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
  @endif

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="levelsTable">
          <thead>
            <tr>
              <th>Order</th>
              <th>Name</th>
              <th>Color</th>
              <th>Status</th>
              <th>Articles Count</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($levels as $level)
            <tr data-id="{{ $level->id }}">
              <td>
                <span class="badge bg-secondary">{{ $level->level_order }}</span>
                <i class="bi bi-grip-vertical text-muted ms-2" style="cursor: move;"></i>
              </td>
              <td>
                <strong>{{ $level->name }}</strong>
                @if($level->description)
                <br><small class="text-muted">{{ Str::limit($level->description, 80) }}</small>
                @endif
              </td>
              <td>
                @if($level->color)
                <span class="badge" style="background-color: {{ $level->color }};">
                  <span style="color: white;">{{ $level->color }}</span>
                </span>
                @else
                <span class="text-muted">-</span>
                @endif
              </td>
              <td>
                <span class="badge bg-{{ $level->status === 'active' ? 'success' : 'secondary' }}">
                  {{ ucfirst($level->status) }}
                </span>
              </td>
              <td>
                @php
                  try {
                    $articlesCount = $level->articles ? $level->articles->count() : 0;
                  } catch (\Exception $e) {
                    $articlesCount = 0;
                  }
                @endphp
                <span class="badge bg-info">{{ $articlesCount }}</span>
              </td>
              <td>
                <a href="{{ route('article-levels.edit', $level) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('article-levels.destroy', $level) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this level? This action cannot be undone.')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center text-muted">No article levels found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
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
        handle: '.bi-grip-vertical',
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
                const badge = row.querySelector('.badge.bg-secondary');
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