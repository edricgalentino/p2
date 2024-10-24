<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Product List</h1>

        <div class="row mt-5">
            @foreach ($dataProduct as $item)
            <a href="{{ url('/product/detail/' . $item->id) }}" class="text-decoration-none text-dark">
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p><strong>Condition:</strong> {{ ucfirst($item->condition) }}</p>
                        <p><strong>Description:</strong> {{ $item->description }}</p>
                        <p><strong>Price:</strong> Rp{{ number_format($item->price, 2) }}</p>
                        @foreach ($item->tags as $tag)
                            <span class="badge badge-primary">{{ $tag->name }}</span>   
                        @endforeach
                        @if(Auth::check() && Auth::user()->role == 'admin')
                        <div class="d-flex justify-content-end w-full align-items-center mt-2">
                            <a href="{{ url('/product/' . $item->id . '/edit') }}">
                                <button class="btn btn-primary">Edit</button>
                            </a>
                            <form action="{{ url('/product/' . $item->id . '/delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger ml-4" onclick="return confirmDelete()">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
            <script>
                function confirmDelete() {
                    return confirm('Are you sure you want to delete this product?');
                }
            </script>
        </div>

        <!-- Back Button -->
        <a href="{{ url('/product') }}" class="mt-5 btn btn-secondary">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>