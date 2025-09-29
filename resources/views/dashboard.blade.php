@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Dashboard</h1>
            <p class="lead">Welcome, {{ Auth::user()->name }}!</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <p class="card-text display-4">{{ \App\Models\Article::count() }}</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-light">View All</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Published</h5>
                    <p class="card-text display-4">{{ \App\Models\Article::where('status', 'published')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Draft</h5>
                    <p class="card-text display-4">{{ \App\Models\Article::where('status', 'draft')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Quick Actions
                </div>
                <div class="card-body">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create New Article</a>
                    <a href="{{ route('company-profile.edit') }}" class="btn btn-secondary">Edit Company Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection