<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Product</title>
</head>
<body>
    <div class="container mt-10">
        <h1>Detail Product</h1>

        <div class="row">
                <div class="col-md-4"> <!-- Change this to col-md-3 for 4 columns -->
                    <div class="product-card">
                        <img src="{{ 
                            asset('storage/' . $item->image)
                            }}" alt="{{ $item->name }}" class="product-img">
                        <h5 class="mt-2">{{ $item->name }}</h5>
                        <p><strong>Condition:</strong> {{ ucfirst($item->condition) }}</p>
                        <p><strong>Description:</strong> {{ $item->description }}</p>
                        <p><strong>Price:</strong> Rp{{ number_format($item->price, 2) }}</p>

                    </div>
                </div>
        </div>

        <!-- Back Button -->
        <a href="{{ url('/product/list') }}" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>