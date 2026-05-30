<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Dashboard') -  BPKAD</title>
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
      .sidebar { 
        background: linear-gradient(180deg,#053b78,#0b4d96);
      }
    </style>

</head>

<body class="bg-gray-50 flex min-h-screen font-sans">
  <aside class="sidebar w-64 text-white p-5 flex flex-col h-screen sticky top-0">

    <div class="flex items-center gap-2 mb-4">
      <img src="{{ asset('logobpkad.png') }}" alt="Logo" class="w-8 h-8 object-contain">
      <div>
        <p class="text-sm font-semibold">BPKAD</p>
        <p class="text-xs opacity-80">Kabupaten Kampar</p>
      </div>
    </div>
      
    <nav class="space-y-1 flex-1">
      <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-900
        @if(request()->routeIs('dashboard.*'))
          bg-blue-900
        @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="currentColor" d="M13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9h-6q-.425 0-.712-.288T13 8M3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13H4q-.425 0-.712-.288T3 12m10 8v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21h-6q-.425 0-.712-.288T13 20M3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21H4q-.425 0-.712-.288T3 20m2-9h4V5H5zm10 8h4v-6h-4zm0-12h4V5h-4zM5 19h4v-2H5zm4-2" />
        </svg>
        <span>Dashboard</span>
      </a>

      <a href="{{ route('skpd.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-900 
        @if(request()->routeIs('skpd.*'))
          bg-blue-900
        @endif">
         <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
            <path d="M0 0h24v24H0z" fill="none" />
            <g fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 3H7c-1.886 0-2.828 0-3.414.586S3 5.114 3 7v14l3-1l3 1l3-1l3 1V9m3-6a3 3 0 0 0-3 3v3m3-6a3 3 0 0 1 3 3v2.143c0 .334 0 .501-.077.623a.5.5 0 0 1-.157.157C20.644 9 20.477 9 20.143 9H15" />
              <path stroke-linecap="round" d="M7 7h4m-3 4H7m0 4h3" />
            </g>
          </svg>
         <span>Data SKPD</span>
      </a>

      <a href="{{ route('pjskpd.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-900
        @if(request()->routeIs('pjskpd.*'))
          bg-blue-900
        @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="currentColor" d="m21.1 12.5l1.4 1.41l-6.53 6.59L12.5 17l1.4-1.41l2.07 2.08zM11 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2m0 7c.68 0 1.5.09 2.41.26l-1.67 1.67l-.74-.03c-2.97 0-6.1 1.46-6.1 2.1v1.1h6.2L13 20H3v-3c0-2.66 5.33-4 8-4" />
        </svg>
        <span>PJ SKPD</span>
      </a>

      <a href="{{ route('monitoring.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-900
        @if(request()->routeIs('monitoring.*'))
          bg-blue-900
        @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="currentColor" d="M3.288 20.713Q3 20.425 3 20v-1q0-.425.288-.712T4 18t.713.288T5 19v1q0 .425-.288.713T4 21t-.712-.288m4 0Q7 20.426 7 20v-5.5q0-.425.288-.712T8 13.5t.713.288T9 14.5V20q0 .425-.288.713T8 21t-.712-.288m4 0Q11 20.426 11 20v-3.5q0-.425.288-.712T12 15.5t.713.288t.287.712V20q0 .425-.288.713T12 21t-.712-.288m4 0Q15 20.426 15 20v-5q0-.425.288-.712T16 14t.713.288T17 15v5q0 .425-.288.713T16 21t-.712-.288m4 0Q19 20.426 19 20v-9q0-.425.288-.712T20 10t.713.288T21 11v9q0 .425-.288.713T20 21t-.712-.288M14 11.975q-.4 0-.763-.15t-.662-.425L10 8.825l-5.3 5.3q-.3.3-.712.288t-.713-.313q-.275-.3-.262-.712T3.3 12.7l5.275-5.275q.3-.3.663-.437T10 6.85t.775.138t.65.437L14 10l5.3-5.3q.3-.3.713-.288t.712.313q.275.3.263.713t-.288.687L15.425 11.4q-.275.275-.65.425t-.775.15" />
        </svg>
        <span>Monitoring Data</span>
      </a>

      <a href="{{ route('pengguna.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-900
        @if(request()->routeIs('pengguna.*'))
          bg-blue-900
        @endif ">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
          <path d="M0 0h24v24H0z" fill="none" />
          <path fill="currentColor" d="M13.07 10.41a5 5 0 0 0 0-5.82A3.4 3.4 0 0 1 15 4a3.5 3.5 0 0 1 0 7a3.4 3.4 0 0 1-1.93-.59M5.5 7.5A3.5 3.5 0 1 1 9 11a3.5 3.5 0 0 1-3.5-3.5m2 0A1.5 1.5 0 1 0 9 6a1.5 1.5 0 0 0-1.5 1.5M16 17v2H2v-2s0-4 7-4s7 4 7 4m-2 0c-.14-.78-1.33-2-5-2s-4.93 1.31-5 2m11.95-4A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4Z" />
        </svg>
        <span>Data Pengguna</span>
      </a>
    </nav>

    <div class="bg-white/5 mt-auto p-4">
      <p class="text-sm">Pengguna</p>
      <p class="font-semibold mt-2">{{ Auth::user()->name }}</p>
      <p class="text-xs">{{ ucfirst(Auth::user()->role) }}</p>
      <div class="mt-4 space-y-2">
        <a href="" class="block py-2 px-3 border rounded text-white text-sm">Profil</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full bg-red-600 text-white py-2 rounded text-sm">Logout</button>
        </form>
      </div>
    </div>
  </aside>

  <main class="flex-1 p-6">
    <header class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-4xl font-bold">@yield('page-title','Dashboard')</h1>
        <p class="text-m text-gray-500">@yield('page-subtitle','Monitoring, Validasi, dan Konsolidasi Data SKPD')</p>
      </div>
      <div class="text-sm text-gray-600 hidden sm:block">
        Hai, <strong>{{ Auth::user()->name }}</strong>
      </div>
    </header>

    <div class="content">
      @yield('content')
    </div>
  </main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>