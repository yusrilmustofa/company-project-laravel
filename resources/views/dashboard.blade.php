@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="p-3 h-full flex flex-col">
  <div>
    <p class="text-2xl font-semibold ">Dashboard</p>
    <p class="text-sm mt-1">Welcome, {{ Auth::user()->name }}!</p>
  </div>

  <div class="mt-10 w-full flex gap-4">
    <div class="bg-red-200 rounded-md p-4 flex-1 h-[100px] flex flex-col justify-between">
      <p class="">Articles</p>
      <p class="text-xl font-semibold mt-2">{{ \App\Models\Article::count() }}</p>
    </div>

    <div class="bg-green-200 rounded-md p-4 flex-1 h-[100px] flex flex-col justify-between">
      <p>Published</p>
      <p class="text-xl font-semibold mt-2">{{ \App\Models\Article::where('status', 'published')->count() }}</p>
    </div>

    <div class="bg-gray-200 rounded-md p-4 flex-1 h-[100px] flex flex-col justify-between">
      <p>Drafs</p>
      <p class="text-xl font-semibold mt-2">{{ \App\Models\Article::where('status', 'draft')->count() }}</p>
    </div>

    <div class="bg-violet-200 rounded-md p-4 flex-1 h-[100px] flex flex-col justify-between">
      <p>Category</p>
      <p class="text-xl font-semibold mt-2">{{ \App\Models\Category::count() }}</p>
    </div>
  </div>

  <div class="w-full mt-10 grow flex">
    <div class="flex-1">
      <div class="flex justify-between items-center">
        <p class="text-lg font-semibold">Top Articles</p>
        <a href="{{ route('articles.create') }}" class="text-blue-400 text-xs p-2 rounded-lg hover:bg-slate-100">
          Create New Article
        </a>
      </div>

      <div class="mt-4 flex flex-col gap-3">
        @forelse($topArticles as $article)
        <div class="border border-slate-200 p-4 flex justify-between rounded-lg hover:bg-slate-50 transition-colors">
          <div class="flex-1">
            <div class="flex items-center gap-2">
              <p class="text-sm font-semibold">{{ $article->title }}</p>
              <p class="text-xs text-slate-400">
                @if($article->category)
                {{ $article->category->name }}
                @else
                No Category
                @endif
              </p>
            </div>
            <div class="flex items-center gap-2 mt-2">
              @if($article->status === 'published')
              <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Published</span>
              @else
              <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
              @endif
            </div>
          </div>
          <div class="text-right">
            <p class="text-xs text-slate-500">{{ $article->created_at->format('M d, Y') }}</p>
            <a href="{{ route('articles.show', $article) }}"
              class="text-xs text-blue-600 hover:text-blue-800 mt-1 block">View</a>
          </div>
        </div>
        @empty
        <div class="border border-slate-200 p-4 rounded-lg text-center">
          <p class="text-sm text-slate-500">No articles found</p>
        </div>
        @endforelse
      </div>

    </div>

    <div class="flex-1">

    </div>
  </div>
</div>
@endsection