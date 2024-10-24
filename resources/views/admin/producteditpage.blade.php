<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Edit {{ $product->name }}</h3>
        <form action="{{ url('/product/' . $product->id . '/edit') }}" method="POST" enctype="multipart/form-data" class="mb-4" onkeydown="if(event.keyCode === 13) {
            alert('You have pressed Enter key, use submit button instead'); 
            return false;
        }">
            @csrf
            @method('PATCH')
            <!-- Product Photos -->
            <div class="form-group">
                <label for="photos">Product Photos:</label>
                <input type="file" name="photos" class="form-control" id="photos" multiple enctype="multipart/form-data" value="{{ asset('storage/' . $product->image) }}" onchange="previewImage()" accept="image/*">
                {{-- current image --}}
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" id="image-preview" class="mt-2" style="max-width: 200px;">
            </div>

            <!-- Product Name -->
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name" required value="{{ $product->name }}">
            </div>
            
            <!-- Year Created -->
            <div class="form-group">
                <label for="year_created">Year Created:</label>
                <input type="number" name="year_created" class="form-control" id="year_created" required value="{{ $product->year }}">
            </div>

            <!-- Condition -->
            <div class="form-group">
                <label for="condition">Condition:</label>
                <select name="condition" class="form-control" id="condition" required value="{{ $product->condition }}">
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="description">Product Description:</label>
                <textarea name="description" class="form-control" id="description" rows="3" required value="{{ $product->description }}">{{ $product->description }}</textarea>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" id="price" required value="{{ $product->price }}">
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" class="form-control" id="stock" required value="{{ $product->stock }}">
            </div>

            {{-- input to add dataTag --}}
            <div class="form-group">
                <label for="newTag">Add New Tag:</label>
                <input type="text" name="newTag" class="form-control" id="newTag" placeholder="Tap '/' to input new tag">
            </div>

            {{-- tags --}}
            <div class="form-group">
                <label for="tags">Tags:</label>
                <select name="tags" class="form-control" id="tags" multiple required>
                    <option value="0" disabled>
                        Please select tags or add new tag
                    </option>
                    @foreach ($product->tags as $tag)
                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-end w-full align-items-center">
                <!-- Back Button -->
                <a href="{{ url('/product') }}" class="btn btn-secondary">Back</a>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary ml-4">Submit</button>
            </div>
        </form>
        
    </div>

    <script>
        // init dataTag and fill it with function addNewTag
        let dataTag = [];

        document.getElementById("newTag").addEventListener("keyup", function(event) {
            // every time user press tab, it will add new tag
            if (event.keyCode === 16) {
                event.preventDefault();
                addNewTag();
            }
        });

        // create a function to add new tag
        function addNewTag() {
            // get newTag value
            var newTag = document.getElementById("newTag").value;

            // check if newTag is not empty
            if (newTag != "") {
                if (dataTag.some(tag => tag.name === newTag)) {
                    alert("Tag already exists!");
                    return;
                }
                // push newTag to dataTag
                dataTag.push({
                    name: newTag
                });

                // create new option element
                var option = document.createElement("option");
                option.text = newTag;
                option.value = newTag;

                // append new option to select element
                document.getElementById("tags").add(option);

                // clear newTag value
                document.getElementById("newTag").value = "";
            }
        }

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
