@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
  <nav class="mb-6" aria-label="Breadcrumb">
    <ol class="flex items-center gap-2 text-sm text-slate-500">
      <li>
        <a href="{{ route('dashboard') }}" class="hover:text-slate-700 transition">Dashboard</a>
      </li>
      <li aria-hidden="true" class="text-slate-400">/</li>
      <li>
        <a href="{{ route('articles.index') }}" class="hover:text-slate-700 transition">Articles</a>
      </li>
      <li aria-hidden="true" class="text-slate-400">/</li>
      <li class="text-slate-700 truncate" title="{{ $article->title }}">{{ $article->title }}</li>
    </ol>
  </nav>

  <div class="bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-200/60 rounded-xl">
    <div class="p-6">
      <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
        <div>
          <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 dark:text-white">
            {{ $article->title }}</h1>
          <div class="mt-2 text-sm text-slate-500 dark:text-slate-400 space-y-2">
            <div>
              <span>By <span class="font-medium text-slate-700 dark:text-slate-200">{{ $article->author }}</span></span>
              <span class="mx-2 text-slate-300">|</span>
              @if($article->published_at)
              <span>Published: {{ $article->published_at->format('d M Y H:i') }}</span>
              @else
              <span>Not published yet</span>
              @endif
            </div>
            <div class="flex flex-wrap items-center gap-2">
              @if($article->category)
              <span
                class="inline-flex items-center rounded-full bg-sky-100 text-sky-700 px-2.5 py-0.5 text-xs font-medium">
                {{ $article->category->name }}
              </span>
              @endif

              <span
                class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $article->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                {{ ucfirst($article->status) }}
              </span>
            </div>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <a href="{{ route('articles.edit', $article) }}"
            class="inline-flex items-center justify-center rounded-lg bg-amber-500 text-white hover:bg-amber-600 active:bg-amber-700 px-3 py-2 text-sm font-medium shadow-sm transition">
            Edit
          </a>
          <a href="{{ route('articles.index') }}"
            class="inline-flex items-center justify-center rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 active:bg-slate-300 px-3 py-2 text-sm font-medium shadow-sm transition">
            Back to List
          </a>
        </div>
      </div>

      @if($article->image)
      <div class="mb-6">
        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
          class="w-full max-h-[28rem] object-cover rounded-lg ring-1 ring-slate-200/70">
      </div>
      @endif

      <div class="text-slate-800 dark:text-slate-200 leading-relaxed whitespace-pre-line">
        {!! nl2br(e($article->content)) !!}
      </div>

      <div class="my-6 border-t border-slate-200"></div>

      <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-3">
          <dt class="text-slate-500">Slug</dt>
          <dd class="mt-1 font-medium text-slate-800 dark:text-slate-200">{{ $article->slug }}</dd>
        </div>
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-3">
          <dt class="text-slate-500">Created</dt>
          <dd class="mt-1 font-medium text-slate-800 dark:text-slate-200">
            {{ $article->created_at->format('d M Y H:i') }}</dd>
        </div>
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-3">
          <dt class="text-slate-500">Last Updated</dt>
          <dd class="mt-1 font-medium text-slate-800 dark:text-slate-200">
            {{ $article->updated_at->format('d M Y H:i') }}</dd>
        </div>
      </dl>
    </div>
  </div>
</div>
@endsection