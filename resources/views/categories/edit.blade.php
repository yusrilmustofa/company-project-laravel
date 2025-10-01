@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container">
  <div class="row mb-4">
    <div class="col-md-12">
      <h1>Edit Category</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $category->name) }}" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="4">{{ old('description', $category->description) }}</textarea>
          @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
          <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
            <option value="active" {{ old('status', $category->status) === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $category->status) === 'inactive' ? 'selected' : '' }}>Inactive
            </option>
          </select>
          @error('status')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex justify-content-between">
          <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
          <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection