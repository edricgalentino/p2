<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <h3 class="mb-4">Edit {{ $product->name }}</h3>
        <form action="{{ url('/product/' . $product->id . '/edit') }}" method="POST" enctype="multipart/form-data" class="mb-4" onkeydown="if(event.keyCode === 13) {
            alert('You have pressed Enter key, use submit button instead'); 
            return false;
        }">
            @csrf
            @method('PUT')
            <!-- Product Photos -->
            <div class="form-group mb-4">
                <label for="photos" class="form-label">Product Photos:</label>
                <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('photos').click();">Select Images</button>
                <input type="file" name="photos[]" class="form-control" id="photos" multiple accept="image/*" style="display: none;" onchange="handleFiles(this.files)">
                @foreach($product->photos as $photo)
                <input type="hidden" name="existing_photos[]" value="{{ $photo->id }}">
                @endforeach
            </div>
            <div id="thumbnails" class="col mb-4">
                @foreach($product->photos as $photo)
                <div class="row">
                    <div class="col-3 mb-3">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $photo->url) }}" class="img-thumbnail" alt="{{ $product->name }} Product Image" id="photo-{{ $photo->id }}">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0" onclick="deleteImage('{{ $photo->id }}')">x</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <!-- Add New Tag -->
                            <div class="form-group row mb-3">
                                <label for="newTag" class="col-sm-2 col-form-label">Add New Tag:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="newTag" class="form-control" id="newTag-{{ $photo->id }}" value="#" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-success" onclick="addNewTag({{ $photo->id }})">+</button>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="form-group mb-4">
                                <label for="photo-{{ $photo->id }}-tags" class="form-label">Tags:</label>
                                <select name="photo-{{ $photo->id }}-tags[]" class="form-control" id="photo-{{ $photo->id }}-tags" multiple required>
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $photo->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Product Name -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name" required value="{{ $product->name }}">
            </div>

            <!-- Year Created -->
            <div class="form-group mb-3">
                <label for="year_created" class="form-label">Year Created:</label>
                <input type="number" name="year_created" class="form-control" id="year_created" required value="{{ $product->year }}">
            </div>

            <!-- Condition -->
            <div class="form-group mb-3">
                <label for="condition" class="form-label">Condition:</label>
                <select name="condition" class="form-control" id="condition" required value="{{ $product->condition }}">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>
            </div>

            <!-- Product Description -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Product Description:</label>
                <textarea name="description" class="form-control" id="description" rows="3" required value="{{ $product->description }}">{{ $product->description }}</textarea>
            </div>

            <!-- Price -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control" id="price" required value="{{ $product->price }}">
            </div>

            <!-- Stock -->
            <div class="form-group mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" class="form-control" id="stock" required value="{{ $product->stock }}">
            </div>

            <!-- Add New Tag -->
            <div class="form-group row mb-3">
                <label for="newTag" class="col-sm-2 col-form-label">Add New Tag:</label>
                <div class="col-sm-8">
                    <input type="text" name="newTag" class="form-control" id="newTag-99" value="#" placeholder="">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-success" onclick="addNewTag(99)">+</button>
                </div>
            </div>

            <!-- Tags -->
            <div class="form-group mb-4">
                <label for="tags" class="form-label">Tags:</label>
                <select name="tags[]" class="form-control" id="photo-99-tags" multiple required>
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mb-3">Submit</button>
        </form>

        <!-- Back Button -->
        <a href="{{ url('/product') }}" class="btn btn-secondary">Back</a>
    </div>

    <script>
        function addNewTag(elementId) {
            let newTag = document.getElementById("newTag-" + elementId).value;

            if (newTag.trim() === "#") {
                alert("Tag cannot be empty!");
                return;
            }

            // Send AJAX request to create the new tag
            fetch('/tags/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: newTag
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let option = document.createElement("option");
                        option.text = newTag;
                        option.value = data.tag_id; // Set the newly created tag's ID
                        option.selected = true;

                        document.getElementById("photo-" + elementId + "-tags").appendChild(option);
                        document.getElementById("newTag-" + elementId).value = "#";
                    } else {
                        alert("Failed to add the tag!");
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        let selectedFiles = [];

        function handleFiles(files) {
            const thumbnails = document.getElementById('thumbnails');
            const selectedFiles = Array.from(files); // Store files in array

            selectedFiles.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail m-2';
                    img.style.width = '150px';
                    thumbnails.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }

        function deleteImage(id) {
            // Send AJAX request to delete the image
            fetch('/photo/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    return response.text().then(text => {
                        console.log('Raw Response:', text);
                        if (!response.ok) {
                            console.error('Error:', text);
                            throw new Error('Failed to delete the image!');
                        }
                        return JSON.parse(text);
                    });
                })
                .then(data => {
                    if (data.message === 'Photo deleted successfully') {
                        document.getElementById("photo-" + id).parentElement.parentElement.remove();
                    } else {
                        alert("Failed to delete the image!");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>