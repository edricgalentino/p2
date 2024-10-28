<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #f5f9e9, #e0f7fa);
            color: #3c3b3b;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            margin-top: 100px;
        }
        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #4e9f3d;
            margin-bottom: 20px;
        }
        .btn-primary, .btn-warning, .btn-success, .btn-danger {
            font-size: 1.1rem;
            padding: 10px 20px;
            border-radius: 25px;
            margin-top: 10px;
        }
        .product-description {
            font-size: 1.1rem;
            color: #606060;
            margin-top: 10px;
            margin-bottom: 30px;
        }
        .hero-image {
        width: 700px;
        height: auto;
        max-height: 700px;
        object-fit: cover;
        border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/storage/images/grateaful.png" alt="logo_Image" class="hero-image"> 
        <h1>Discover the Beauty of Floral Teas</h1>
        <p class="product-description">Indulge in a variety of exquisite floral teas that will bring harmony to your senses and refresh your mind. Hand-picked and crafted to perfection.</p>

        
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>