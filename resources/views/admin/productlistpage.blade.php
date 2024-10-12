<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .product-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Product List</h1>

        <div class="row">
            @foreach ($dataProduct as $item)
                <div class="col-md-4"> <!-- Change this to col-md-3 for 4 columns -->
                    <div class="product-card">
                        <img src="{{ 
                            asset('storage/' . $item->image)
                            }}" alt="{{ $item->name }}" class="product-img">
                        <h5 class="mt-2">{{ $item->name }}</h5>
                        <p><strong>Condition:</strong> {{ ucfirst($item->condition) }}</p>
                        <p><strong>Description:</strong> {{ $item->description }}</p>
                        <p><strong>Price:</strong> Rp{{ number_format($item->price, 2) }}</p>
                        <p><a href="{{url('/edit-product')}}"><button>Edit</button></a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Back Button -->
        <a href="{{ url('/product') }}" class="btn btn-secondary">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
