<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d8f3dc;
            color: #3c3b3b;
            font-family: Arial, sans-serif;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Product List</h1>

        <div class="row g-4">
            @foreach ($dataProduct as $item)
            <div class="col-md-4">
                <a href="{{ url('/product/detail/' . $item->id) }}" class="text-decoration-none text-dark">
                    <div class="card">
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text"><strong>Condition:</strong> {{ ucfirst($item->condition) }}</p>
                            <p class="card-text"><strong>Description:</strong> {{ $item->description }}</p>
                            <p class="card-text"><strong>Price:</strong> Rp{{ number_format($item->price, 2) }}</p>
                            <div class="mb-2">
                                @foreach ($item->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            @if(Auth::check() && Auth::user()->role == 'admin')
                            <div class="d-flex justify-content-end mt-5">
                                <a href="{{ url('/product/' . $item->id . '/edit') }}" class="btn btn-warning me-3">Edit</a>
                                <form action="{{ url('/product/' . $item->id . '/delete') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Delete</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>