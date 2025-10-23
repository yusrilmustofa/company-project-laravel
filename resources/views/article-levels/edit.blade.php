@extends('layouts.app')

@section('title', 'Edit Article Level')

@section('content')
<div class="container">
  <div class="row mb-4">
    <div class="col-md-12">
      <h1>Edit Article Level: {{ $articleLevel->name }}</h1>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('article-levels.update', $articleLevel) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="col-md-8">
            <div class="mb-3">
              <label for="name" class="form-label">Level Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $articleLevel->name) }}" required placeholder="e.g., Beginner, Intermediate, Advanced">
              @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3" placeholder="Describe this article level...">{{ old('description', $articleLevel->description) }}</textarea>
              @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="color" class="form-label">Color</label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                  id="color" name="color" value="{{ old('color', $articleLevel->color ?? '#6c757d') }}" title="Choose a color">
                <input type="text" class="form-control" id="colorText" value="{{ old('color', $articleLevel->color ?? '#6c757d') }}"
                  placeholder="#6c757d" pattern="^#[0-9A-Fa-f]{6}$">
              </div>
              <small class="form-text text-muted">Choose a color to represent this level in the UI (optional)</small>
              @error('color')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="col-md-4">
            <div class="mb-3">
              <label for="level_order" class="form-label">Display Order</label>
              <input type="number" class="form-control @error('level_order') is-invalid @enderror"
                id="level_order" name="level_order" value="{{ old('level_order', $articleLevel->level_order) }}" min="1"
                placeholder="Auto-generated if empty">
              @error('level_order')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <small class="form-text text-muted">Lower numbers appear first. Leave empty to auto-generate.</small>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
              <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="active" {{ old('status', $articleLevel->status) === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $articleLevel->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
              </select>
              @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Preview Card -->
            <div class="card">
              <div class="card-header">
                <h6 class="mb-0">Preview</h6>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <span id="previewBadge" class="badge me-2" style="background-color: {{ $articleLevel->color ?? '#6c757d' }};">
                    <span style="color: white;">{{ $articleLevel->name }}</span>
                  </span>
                  <span class="badge bg-{{ ($articleLevel->status ?? 'inactive') === 'active' ? 'success' : 'secondary' }}">
                    {{ ucfirst($articleLevel->status ?? 'inactive') }}
                  </span>
                </div>
                <p class="mt-2 mb-0 text-muted small">This is how the level will appear in the article form</p>
              </div>
            </div>

            <!-- Usage Statistics -->
            <div class="card mt-3">
              <div class="card-header">
                <h6 class="mb-0">Usage Statistics</h6>
              </div>
              <div class="card-body">
                @php
                try {
                $articlesCount = $articleLevel->articles ? $articleLevel->articles->count() : 0;
                } catch (\Exception $e) {
                $articlesCount = 0;
                }
                @endphp
                <p class="mb-1">
                  <strong>Articles using this level:</strong>
                  <span class="badge bg-info">{{ $articlesCount }}</span>
                </p>
                @if($articlesCount > 0)
                <small class="text-muted">
                  This level is being used by {{ $articlesCount }} article(s).
                  You cannot delete this level while it's in use.
                </small>
                @else
                <small class="text-muted">
                  This level is not currently used by any articles.
                </small>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12">
            <div class="d-flex justify-content-between">
              <a href="{{ route('article-levels.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Levels
              </a>
              <div>
                <button type="reset" class="btn btn-light me-2">
                  <i class="bi bi-x-circle"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-save"></i> Update Level
                </button>
              </div>
            </div>
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
    const previewStatusBadge = previewBadge.nextElementSibling;

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
      previewBadge.querySelector('span').textContent = name;

      // Update status badge
      previewStatusBadge.className = 'badge bg-' + (status === 'active' ? 'success' : 'secondary');
      previewStatusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
    }
  });
</script>
@endpush