<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ColorCraft - Premium Paints & Colors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <img src="{{ URL::to('/') }}/images/logo.png" alt="ColorCraft Logo" class="h-10 w-auto">
                </div>
                <div class="hidden md:flex items-center gap-x-8">
                    <a href="/" class="text-black hover:text-blue-500">Home</a>
                    <a href="/product/list" class="text-black hover:text-blue-500">Products</a>
                    <a href="#" class="text-black hover:text-blue-500">Color Guide</a>
                    <a href="#" class="text-black hover:text-blue-500">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none"
                            >
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative h-[600px]">
        <img src="{{ URL::to('/') }}/images/hero-paint.png" alt="Paint Splash" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black bg-opacity-50">
            <div class="container mx-auto px-4 h-full flex items-center">
                <div class="text-white max-w-2xl">
                    <h1 class="text-5xl font-bold mb-4">Transform Your Space with Premium Colors</h1>
                    <p class="text-xl mb-8">Discover our extensive collection of high-quality paints and expert color matching services.</p>
                    <a href="/product/list" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold inline-block">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Our Paint Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ URL::to('/') }}/images/interior-paint.png" alt="Interior Paints" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Interior Paints</h3>
                    <p class="text-gray-600 mb-4">Premium wall paints for every room in your home.</p>
                    <a href="/product/list" class="text-blue-500 hover:text-blue-600 font-medium">Explore Interior →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ URL::to('/') }}/images/exterior-paint.png" alt="Exterior Paints" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Exterior Paints</h3>
                    <p class="text-gray-600 mb-4">Weather-resistant paints for lasting protection.</p>
                    <a href="/product/list" class="text-blue-500 hover:text-blue-600 font-medium">Explore Exterior →</a>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ URL::to('/') }}/images/speciality-paint.png" alt="Specialty Paints" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">Specialty Paints</h3>
                    <p class="text-gray-600 mb-4">Unique finishes and effects for creative projects.</p>
                    <a href="/product/list" class="text-blue-500 hover:text-blue-600 font-medium">Explore Specialty →</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Consultation -->
    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0">
                    <img src="{{ URL::to('/') }}/images/color-consultation.png" alt="Color Consultation" class="rounded-lg shadow-lg">
                </div>
                <div class="w-full md:w-1/2 md:pl-12">
                    <h2 class="text-3xl font-bold mb-4">Expert Color Consultation</h2>
                    <p class="text-gray-600 mb-6">Not sure which color to choose? Our color experts are here to help you find the perfect shade for your space.</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Personalized color recommendations
                        </li>
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Virtual color visualization
                        </li>
                        <li class="flex items-center">
                            <svg class="h-6 w-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Free color swatches
                        </li>
                    </ul>
                    <a href="/product/list" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg inline-block">Shop Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">About ColorCraft</h4>
                    <p class="text-gray-400">Premium paint solutions for all your needs. Quality and satisfaction guaranteed.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/product/list" class="hover:text-white">Products</a></li>
                        <li><a href="#" class="hover:text-white">Color Guide</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>123 Paint Street</li>
                        <li>Color City, CC 12345</li>
                        <li>Phone: (555) 123-4567</li>
                        <li>Email: info@colorcraft.com</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Subscribe for updates and special offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email" class="px-4 py-2 rounded-l-lg w-full text-gray-800">
                        <button class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-r-lg">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 ColorCraft. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>