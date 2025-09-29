@extends('layouts.app')

@section('title', 'Edit Company Profile')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Edit Company Profile</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('company-profile.index') }}">Company Profile</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('company-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5 class="mb-3">Basic Information</h5>

                <div class="mb-3">
                    <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('company_name') is-invalid @enderror" 
                           id="company_name" 
                           name="company_name" 
                           value="{{ old('company_name', $profile->company_name ?? '') }}" 
                           required>
                    @error('company_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="4" 
                              required>{{ old('description', $profile->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Company Logo</label>
                    
                    @if($profile && $profile->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $profile->logo) }}" 
                                 alt="Current logo" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                            <p class="text-muted small mt-1">Current logo</p>
                        </div>
                    @endif
                    
                    <input type="file" 
                           class="form-control @error('logo') is-invalid @enderror" 
                           id="logo" 
                           name="logo"
                           accept="image/jpeg,image/png,image/jpg">
                    <small class="text-muted">Leave empty to keep current logo. Max size: 2MB.</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Contact Information</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $profile->email ?? '') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $profile->phone ?? '') }}" 
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" 
                              name="address" 
                              rows="3" 
                              required>{{ old('address', $profile->address ?? '') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Vision & Mission</h5>

                <div class="mb-3">
                    <label for="vision" class="form-label">Vision <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('vision') is-invalid @enderror" 
                              id="vision" 
                              name="vision" 
                              rows="3" 
                              required>{{ old('vision', $profile->vision ?? '') }}</textarea>
                    @error('vision')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mission" class="form-label">Mission <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('mission') is-invalid @enderror" 
                              id="mission" 
                              name="mission" 
                              rows="3" 
                              required>{{ old('mission', $profile->mission ?? '') }}</textarea>
                    @error('mission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">
                <h5 class="mb-3">Social Media</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook URL</label>
                            <input type="url" 
                                   class="form-control @error('facebook') is-invalid @enderror" 
                                   id="facebook" 
                                   name="facebook" 
                                   value="{{ old('facebook', $profile->social_media['facebook'] ?? '') }}" 
                                   placeholder="https://facebook.com/yourpage">
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram URL</label>
                            <input type="url" 
                                   class="form-control @error('instagram') is-invalid @enderror" 
                                   id="instagram" 
                                   name="instagram" 
                                   value="{{ old('instagram', $profile->social_media['instagram'] ?? '') }}" 
                                   placeholder="https://instagram.com/yourpage">
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter URL</label>
                            <input type="url" 
                                   class="form-control @error('twitter') is-invalid @enderror" 
                                   id="twitter" 
                                   name="twitter" 
                                   value="{{ old('twitter', $profile->social_media['twitter'] ?? '') }}" 
                                   placeholder="https://twitter.com/yourpage">
                            @error('twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn URL</label>
                            <input type="url" 
                                   class="form-control @error('linkedin') is-invalid @enderror" 
                                   id="linkedin" 
                                   name="linkedin" 
                                   value="{{ old('linkedin', $profile->social_media['linkedin'] ?? '') }}" 
                                   placeholder="https://linkedin.com/company/yourcompany">
                            @error('linkedin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('company-profile.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection