<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d8f3dc;
            color: #3c3b3b;
            font-family: Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Lebar card terbatas */
            margin: auto; /* Pusatkan card di halaman */
        }

        .carousel-inner img {
            height: 300px; /* Ukuran gambar yang lebih kecil */
            object-fit: cover;
        }

        .card-body {
            background-color: #f9f9f9;
        }

        h4.product-name {
            color: #2d6a4f; /* Warna hijau untuk nama produk */
            font-weight: bold;
            font-size: 1.5rem; /* Ukuran font nama produk */
        }

        .btn-download {
            font-size: 0.75rem; /* Ukuran font tombol lebih kecil */
            padding: 4px 8px; /* Ukuran tombol lebih kecil */
            margin-top: 10px;
            display: inline-block; /* Agar tombol tidak memenuhi lebar */
            width: auto; /* Mengatur lebar tombol otomatis */
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Warna saat hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <!-- Product Photos Carousel -->
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($product->photos as $index => $photo)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $photo->url) }}" alt="{{ $product->name }}" class="d-block w-100 img-fluid">
                            <div class="position-absolute bottom-0 start-0 m-2">
                                @foreach ($photo->tags as $tag)
                                <span class="badge bg-danger">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @if(Auth::check() && (Auth::user()->role == 'visitor' || Auth::user()->role == 'admin'))
                <div class="text-center">
                    <a href="#" onclick="downloadAllImages()" class="btn btn-primary btn-download">Download All Images</a>
                </div>
                <script>
                    function downloadAllImages() {
                        const images = @json($product->photos);
                        images.forEach((photo) => {
                            const link = document.createElement('a');
                            link.href = `{{ asset('storage/') }}/${photo.url}`;
                            link.download = photo.url.split('/').pop();
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        });
                    }
                </script>
            @endif

            <!-- Product Information -->
            <div class="card-body">
                <!-- Product Name -->
                <h4 class="product-name">{{ $product->name }}</h4>

                <!-- Year Created -->
                <p><strong>Year Created:</strong> {{ $product->year }}</p>

                <!-- Condition -->
                <p><strong>Condition:</strong> {{ ucfirst($product->condition) }}</p>

                <!-- Product Description -->
                <p><strong>Description:</strong> {{ $product->description }}</p>

                <!-- Price -->
                <p><strong>Price:</strong> Rp{{ number_format($product->price, 2) }}</p>

                <!-- Stock -->
                <p><strong>Stock:</strong> {{ $product->stock }} items available</p>

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('product.list') }}" class="btn btn-secondary">Back to Products List</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
