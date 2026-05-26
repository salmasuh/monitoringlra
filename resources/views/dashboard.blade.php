<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">

        <div class="bg-white p-10 rounded-2xl shadow-xl text-center">

            <h1 class="text-4xl font-bold mb-5">
                Dashboard
            </h1>

            <p class="text-xl mb-6">
                Selamat datang, {{ auth()->user()->name }}
            </p>

            <form action="{{ route('logout') }}" method="POST">
    @csrf

    <button
        type="submit"
        class="bg-red-600 text-white px-4 py-2 rounded"
    >
        Logout
    </button>
</form>

        </div>

    </div>

</body>
</html>