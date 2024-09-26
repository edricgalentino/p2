<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Product List</h1>
        <a href="{{ url('/product/add') }}"><button class="btn btn-danger">Add Product</button></a>
        <ul class="list-group">
            @foreach ($dataProduct as $item)
                <li class="list-group-item">
                    <strong>{{ $item->name }}</strong> - {{ $item->tags->pluck('name')->implode(', ') }}
                    <ul class="list-group mt-2">
                        @foreach($item->tags as $item2)
                            <li class="list-group-item">{{ $item2->name }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>