<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name') }} - @yield('title')</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

  @stack('styles')
</head>

<body class="p-3 h-screen">
  <div class="flex w-full h-full rounded-xl gap-3">
    @auth

    <nav class="w-1/6 bg-slate-200 rounded-xl p-6 flex flex-col gap-6">
      <p class="text-lg border-b pb-4 border-slate-400 !text-slate-800">TK Group 5</p>

      <div class="flex flex-col gap-3 grow ">
        <a href="{{ route('dashboard') }}" class="!no-underline !text-slate-800">Dashboard</a>
        <a href="{{ route('articles.index') }}" class="!no-underline !text-slate-800">Articles</a>
        <a href="{{ route('company-profile.index') }}" class="!no-underline !text-slate-800">Company Profile</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto">
          @csrf
          <button type="submit" class="btn btn-link nav-link">Logout</button>
        </form>
      </div>
    </nav>
    @endauth

    <div class="grow overflow-y-auto">
      @yield('content')
    </div>
  </div>

  @stack('scripts')
</body>

</html>