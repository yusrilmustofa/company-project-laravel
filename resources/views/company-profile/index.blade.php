@extends('layouts.app')

@section('title', 'Company Profile')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Company Profile</h1>
                <a href="{{ route('company-profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($profile)
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($profile->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}" 
                             alt="{{ $profile->company_name }}" 
                             class="img-fluid mb-3"
                             style="max-width: 200px;">
                    @else
                        <div class="bg-light p-5 mb-3">
                            <h1 class="text-muted">Logo</h1>
                        </div>
                    @endif
                    <h4>{{ $profile->company_name }}</h4>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Contact Information</strong>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong><br>{{ $profile->email }}</p>
                    <p><strong>Phone:</strong><br>{{ $profile->phone }}</p>
                    <p><strong>Address:</strong><br>{{ $profile->address }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>About Company</strong>
                </div>
                <div class="card-body">
                    <p>{{ $profile->description }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <strong>Vision</strong>
                </div>
                <div class="card-body">
                    <p>{{ $profile->vision }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <strong>Mission</strong>
                </div>
                <div class="card-body">
                    <p>{{ $profile->mission }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <strong>Social Media</strong>
                </div>
                <div class="card-body">
                    @if($profile->social_media)
                        <div class="row">
                            @if(!empty($profile->social_media['facebook']))
                            <div class="col-md-6 mb-2">
                                <strong>Facebook:</strong><br>
                                <a href="{{ $profile->social_media['facebook'] }}" target="_blank">
                                    {{ $profile->social_media['facebook'] }}
                                </a>
                            </div>
                            @endif

                            @if(!empty($profile->social_media['instagram']))
                            <div class="col-md-6 mb-2">
                                <strong>Instagram:</strong><br>
                                <a href="{{ $profile->social_media['instagram'] }}" target="_blank">
                                    {{ $profile->social_media['instagram'] }}
                                </a>
                            </div>
                            @endif

                            @if(!empty($profile->social_media['twitter']))
                            <div class="col-md-6 mb-2">
                                <strong>Twitter:</strong><br>
                                <a href="{{ $profile->social_media['twitter'] }}" target="_blank">
                                    {{ $profile->social_media['twitter'] }}
                                </a>
                            </div>
                            @endif

                            @if(!empty($profile->social_media['linkedin']))
                            <div class="col-md-6 mb-2">
                                <strong>LinkedIn:</strong><br>
                                <a href="{{ $profile->social_media['linkedin'] }}" target="_blank">
                                    {{ $profile->social_media['linkedin'] }}
                                </a>
                            </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted">No social media links added.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-warning">
        <p>No company profile found. Please create one.</p>
        <a href="{{ route('company-profile.edit') }}" class="btn btn-primary">Create Profile</a>
    </div>
    @endif
</div>
@endsection