<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Masuk Sistem</title>

<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="icon" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="w-full max-w-md">
    
    <div class="bg-white rounded-lg shadow-lg p-8">
      <div class="flex justify-center mb-4">
         <img src="{{ asset('logobpkad.png') }}" alt="Logo" class="w-12 h-12 object-contain">
      </div>
      <h2 class="text-2xl font-semibold text-center mb-2">Masuk Sistem</h2>
      <p class="text-center text-sm text-gray-500 mb-6">Dashboard Monitoring Workflow LRA Mingguan</p>

      <!-- Error -->
        @if ($errors->any())
          <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded">
            {{ $errors->first() }}
          </div>
        @endif

      <form action="/login" method="POST" class="mt-10">
        @csrf
        <label class="block text-sm font-semibold mb-1">Username</label>
        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required
               class="w-full p-3 border rounded mb-4">

        <label class="block text-sm font-semibold mb-1">Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required
               class="w-full p-3 border rounded mb-4">

        <button type="submit" class="w-full bg-blue-800 text-white py-3 rounded font-semibold">Masuk</button>
      </form>

      <div class="text-center mt-4">
        <a href="#" class="text-sm text-blue-600">
            Lupa Password?
        </a>
      </div>

      <hr class="my-6">
      <div class="text-center text-xs text-gray-500">
        Dashboard monitoring workflow LRA mingguan untuk BPKAD Kabupaten Bangkinang akan disajikan dalam bentuk grafik dan tabel yang mudah dipahami. Data akan diperbarui setiap minggu untuk memberikan informasi terkini tentang kinerja keuangan daerah.
      </div>
    </div>

    <p class="text-center text-xs text-gray-500 mt-4">© BPKAD Kabupaten Bangkinang 2026</p>
  </div>
</body>
</html>