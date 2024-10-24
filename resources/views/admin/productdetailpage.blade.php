<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>{{ $product->name }} Details</h3>
        <form action="{{ url('/product/' . $product->id . '/edit') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            @method('PATCH')
            <!-- Product Photos -->
            <div class="form-group">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" id="image-preview" class="mt-2" style="max-width: 200px;">
                
                @if(Auth::check() && (Auth::user()->role == 'visitor' || Auth::user()->role == 'admin'))    
                <a href="{{ route('downloadimage', ['id' => $product->id]) }}" class="btn btn-primary">Download</a>
                @endif
            </div>

            <!-- Product Name -->
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name" required value="{{ $product->name }}" disabled>
            </div>
            
            <!-- Year Created -->
            <div class="form-group">
                <label for="year_created">Year Created:</label>
                <input type="number" name="year_created" class="form-control" id="year_created" required value="{{ $product->year }}" disabled>
            </div>

            <!-- Condition -->
            <div class="form-group">
                <label for="condition">Condition:</label>
                <select name="condition" class="form-control" id="condition" required disabled>
                    <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>New</option>
                    <option value="used" {{ $product->condition == 'used' ? 'selected' : '' }}>Used</option>
                </select>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="description">Product Description:</label>
                <textarea name="description" class="form-control" id="description" rows="3" required disabled>{{ $product->description }}</textarea>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" id="price" required value="{{ $product->price }}" disabled>
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" class="form-control" id="stock" required value="{{ $product->stock }}" disabled>
            </div>

            <div class="d-flex justify-content-end w-full align-items-center">
                <!-- Back Button -->
                <a href="{{ route('product.list') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
        
    </div>

    <script>
        // create a function to preview image
        function previewImage() {
            // get image file
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("photos").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").src = oFREvent.target.result;
            };
        };
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>