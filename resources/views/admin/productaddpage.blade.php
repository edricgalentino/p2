<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Product</h1>
        <form action="{{ url('/product/add') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <!-- Product Photos -->
            <div class="form-group">
                <label for="photos">Product Photos:</label>
                <input type="file" name="photos" class="form-control" id="photos" multiple accept="image/*">
            </div>
            
            <!-- Product Name -->
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            
            <!-- Year Created -->
            <div class="form-group">
                <label for="year_created">Year Created:</label>
                <input type="number" name="year_created" class="form-control" id="year_created" required>
            </div>

            <!-- Condition -->
            <div class="form-group">
                <label for="condition">Condition:</label>
                <select name="condition" class="form-control" id="condition" required>
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="description">Product Description:</label>
                <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" id="price" required>
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" name="stock" class="form-control" id="stock" required>
            </div>
            
            {{-- input to add dataTag --}}
            <div class="form-group">
                <label for="newTag">Add New Tag:</label>
                <input type="text" name="newTag" class="form-control" id="newTag" placeholder="Press shift to add new tag">
            </div>

            {{-- tags --}}
           <div class="form-group">
                <label for="tags">Tags:</label>
                <select name="tags[]" class="form-control" id="tags" multiple required>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>


            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        <!-- Back Button -->
        <a href="{{ url('/product') }}" class="btn btn-secondary">Back</a>
    </div>

   <script>
        document.getElementById("newTag").addEventListener("keyup", function(event) {
            if (event.keyCode === 16) { // Shift key is pressed
                event.preventDefault();
                addNewTag();
            }
        });

        function addNewTag() {
            let newTag = document.getElementById("newTag").value;

            if (newTag.trim() === "") {
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
                body: JSON.stringify({ name: newTag })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let option = document.createElement("option");
                    option.text = newTag;
                    option.value = data.tag_id; // Set the newly created tag's ID
                    option.selected = true;

                    document.getElementById("tags").appendChild(option);
                    document.getElementById("newTag").value = "";
                } else {
                    alert("Failed to add the tag!");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
