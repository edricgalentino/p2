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
        <h1>Ada yang ingin kamu tambahkan?</h1>
        
        <!-- Button Show Product List -->
        <a href="{{ route('product.list') }}"><button class="btn btn-primary">Show Product List</button></a>

        @if(Auth::check())
            @if(Auth::user()->role == 'admin')
                <!-- Button Add Product -->
                <a href="{{ url('/product/add') }}"><button class="btn btn-warning ml-2">Add Product</button></a>
            @endif
            <!-- Button Logout -->
            <a href="{{ route('logout') }}"><button class="btn btn-danger ml-2">Logout</button></a>
        @else
            <!-- Button Login -->
            <a href="{{ route('login') }}"><button class="btn btn-success ml-2">Login</button></a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>