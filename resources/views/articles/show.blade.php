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

              @php
                $articleLevel = null;
                try {
                  $articleLevel = ($article->relationLoaded('level') ? $article->level : $article->level()->first());
                } catch (\Exception $e) {
                  // Handle error gracefully
                }
              @endphp
              @if($articleLevel)
              <span
                class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
                data-level-color="{{ $articleLevel->color ?? '#6c757d' }}"
                title="Article Level: {{ $articleLevel->name }}">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                </svg>
                {{ $articleLevel->name }}
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

      <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-3">
          <dt class="text-slate-500">Slug</dt>
          <dd class="mt-1 font-medium text-slate-800 dark:text-slate-200">{{ $article->slug }}</dd>
        </div>
        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-lg p-3">
          <dt class="text-slate-500">Article Level</dt>
          <dd class="mt-1">
            @if($articleLevel)
            <span data-level-detail-color="{{ $articleLevel->color ?? '#6c757d' }}" class="text-xs font-medium inline-flex items-center">
              <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
              </svg>
              {{ $articleLevel->name }}
            </span>
            @else
            <span class="text-slate-400">-</span>
            @endif
          </dd>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Apply level colors to badges
    const levelBadges = document.querySelectorAll('[data-level-color]');
    levelBadges.forEach(function(badge) {
        const color = badge.getAttribute('data-level-color');
        if (color && color.match(/^#[0-9A-Fa-f]{6}$/)) {
            badge.style.backgroundColor = color;
            badge.style.color = 'white';
        } else if (color) {
            // Fallback to default color if invalid
            badge.style.backgroundColor = '#6c757d';
            badge.style.color = 'white';
        }
    });

    // Apply level colors to detail badges
    const detailBadges = document.querySelectorAll('[data-level-detail-color]');
    detailBadges.forEach(function(badge) {
        const color = badge.getAttribute('data-level-detail-color');
        if (color && color.match(/^#[0-9A-Fa-f]{6}$/)) {
            badge.style.backgroundColor = color;
            badge.style.color = 'white';
            badge.style.padding = '2px 8px';
            badge.style.borderRadius = '9999px';
        } else if (color) {
            badge.style.backgroundColor = '#6c757d';
            badge.style.color = 'white';
            badge.style.padding = '2px 8px';
            badge.style.borderRadius = '9999px';
        }
    });
});
</script>
@endpush
@endsection