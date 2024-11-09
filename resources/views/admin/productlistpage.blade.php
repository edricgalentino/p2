<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="my-20 flex flex-col justify-center items-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Product List</h1>
            <p class="text-gray-600">Browse through our collection of products</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($dataProduct as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <a href="{{ url('/product/detail/' . $item->id) }}">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4">
                                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">New</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                            <div class="flex flex-col gap-4">
                                <span class="text-xl font-bold text-blue-600">${{ number_format($item->price, 2) }}</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($item->tags->take(4) as $tag)
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                                @if(Auth::check() && Auth::user()->role == 'admin')
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ url('/product/' . $item->id . '/edit') }}" class="px-2 py-1 rounded border border-black bg-blue-200 text-black">Edit</a>
                                        <form action="{{ url('/product/' . $item->id . '/delete') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 rounded border border-black bg-red-200 text-black" onclick="return confirmDelete()">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <div class="mt-5">
            <a href="{{ url('/product') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this product?');
        }
    </script>
</body>

</html>