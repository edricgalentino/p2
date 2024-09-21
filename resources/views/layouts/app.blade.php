<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

		{{-- tailwind CDN --}}
          <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>
        <!-- navbar -->
		<nav class="flex justify-between items-center bg-gray-800 text-white p-4">
			<a href="{{ route('home') }}" class="text-2xl font-semibold">My Portfolio</a>
			<ul class="flex space-x-4">
				<li>
					<a href="{{ route('home') }}" class="hover:underline">Home</a>
				</li>
				<li>
					<a href="{{ route('about') }}" class="hover:underline">About</a>
				</li>
				<li>
					<a href="{{ route('services') }}" class="hover:underline">Services</a>
				</li>
			</ul>
		</nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="flex justify-center items-center my-4">
		<p class="text-lg font-semibold">
			Made with <span class="text-red-600">&hearts;</span>
		</p>
    </footer>
</body>
</html>
