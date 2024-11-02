<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d8f3dc;
            color: #3c3b3b;
            font-family: Arial, sans-serif;
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Product</h1>
        <form action="{{ url('/product/add') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <!-- Product Photos -->
            <div class="form-group mb-3">
                <label for="photos" class="form-label">Product Photos:</label>
                <button type="button" class="btn btn-primary mb-2" onclick="document.getElementById('photos').click();">Select Images</button>
                <input type="file" name="photos[]" class="form-control" id="photos" multiple accept="image/*" style="display: none;" onchange="handleFiles(this.files, {{ json_encode($tags) }})">
            </div>
            <div id="thumbnails" class="row mb-4"></div>

            <!-- Product Name -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Product Name:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <!-- Year Created -->
            <div class="form-group mb-3">
                <label for="year_created" class="form-label">Year Created:</label>
                <input type="number" name="year_created" class="form-control" id="year_created" required>
            </div>

            <!-- Condition -->
            <div class="form-group mb-3">
                <label for="condition" class="form-label">Condition:</label>
                <select name="condition" class="form-control" id="condition" required>
                    <option value="new">New</option>
                    <option value="used">Used</option>
                </select>
            </div>

            <!-- Product Description -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Product Description:</label>
                <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
            </div>

            <!-- Price -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Price:</label>
                <input type="text" name="price" class="form-control" id="price" required>
            </div>

            <!-- Stock -->
            <div class="form-group mb-3">
                <label for="stock" class="form-label">Stock:</label>
                <input type="number" name="stock" class="form-control" id="stock" required>
            </div>

            <!-- Add New Tag -->
            <div class="form-group row mb-3">
                <label for="newTag" class="col-sm-2 col-form-label">Add New Tag:</label>
                <div class="col-sm-8">
                    <input type="text" name="newTag" class="form-control" id="newTag" value="#" placeholder="">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-success" onclick="addNewTag('newTag')">+</button>
                </div>
            </div>

            <!-- Tags -->
            <div class="form-group mb-4">
                <label for="tags" class="form-label">Tags:</label>
                <select name="tags[]" class="form-control" id="tags" multiple required>
                    @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
        function addNewTag(inputId) {
    let newTag = document.getElementById(inputId).value;

    if (newTag.trim() === "#") {
        alert("Tag cannot be empty!");
        return;
    }

    // Kirim permintaan AJAX untuk membuat tag baru
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
                // Buat opsi baru dengan ID tag
                let newOption = document.createElement("option");
                newOption.text = newTag;
                newOption.value = data.tag_id;
                newOption.selected = true;

                // Tambahkan opsi ke semua elemen `<select>` dinamis untuk foto
                document.querySelectorAll('select[name^="tags-"]').forEach(selectElement => {
                    selectElement.appendChild(newOption.cloneNode(true));
                });

                // Tambahkan juga ke kolom `Tags` utama di bawah
                document.getElementById("tags").appendChild(newOption.cloneNode(true));

                // Reset input ke nilai awal
                document.getElementById(inputId).value = "#";
            } else {
                alert("Failed to add the tag!");
            }
        })
        .catch(error => console.error('Error:', error));
}


        let selectedFiles = [];

        function handleFiles(files, tags) {
            const thumbnails = document.getElementById('thumbnails');
            const selectedFiles = Array.from(files); // Store files in array

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const rowDiv = document.createElement('div');
                    rowDiv.className = 'row';

                    const col3Div = document.createElement('div');
                    col3Div.className = 'col-3 mb-3';

                    const positionRelativeDiv = document.createElement('div');
                    positionRelativeDiv.className = 'position-relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.alt = 'Product Image';
                    img.style.width = '150px';

                    positionRelativeDiv.appendChild(img);
                    col3Div.appendChild(positionRelativeDiv);
                    rowDiv.appendChild(col3Div);

                    const colDiv = document.createElement('div');
                    colDiv.className = 'col';

                    const innerRowDiv = document.createElement('div');
                    innerRowDiv.className = 'row';

                    const formGroupDiv = document.createElement('div');
                    formGroupDiv.className = 'form-group row mb-3';

                    const label = document.createElement('label');
                    label.htmlFor = `newTag-${index}`;
                    label.className = 'col-sm-2 col-form-label';
                    label.innerText = 'Add New Tag:';

                    const colSm8Div = document.createElement('div');
                    colSm8Div.className = 'col-sm-8';

                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = `newTag-${index}`;
                    input.className = 'form-control';
                    input.id = `newTag-${index}`;
                    input.value = '#';
                    input.placeholder = '';

                    colSm8Div.appendChild(input);

                    const colSm2Div = document.createElement('div');
                    colSm2Div.className = 'col-sm-2';

                    const addButton = document.createElement('button');
                    addButton.type = 'button';
                    addButton.className = 'btn btn-success';
                    addButton.innerText = '+';
                    addButton.onclick = function() {
                        addNewTag(input.id); // Pass the input field ID to `addNewTag`
                    };

                    colSm2Div.appendChild(addButton);

                    formGroupDiv.appendChild(label);
                    formGroupDiv.appendChild(colSm8Div);
                    formGroupDiv.appendChild(colSm2Div);

                    innerRowDiv.appendChild(formGroupDiv);

                    const tagsFormGroupDiv = document.createElement('div');
                    tagsFormGroupDiv.className = 'form-group mb-4';

                    const tagsLabel = document.createElement('label');
                    tagsLabel.htmlFor = `tags-${index}`;
                    tagsLabel.className = 'form-label';
                    tagsLabel.innerText = 'Tags:';

                    const select = document.createElement('select');
                    select.name = `tags-${index}[]`;
                    select.className = 'form-control';
                    select.id = `tags-${index}`;
                    select.multiple = true;
                    select.required = true;

                    tags.forEach(tag => {
                        const option = document.createElement('option');
                        option.value = tag.id;
                        option.innerText = tag.name;
                        select.appendChild(option);
                    });

                    tagsFormGroupDiv.appendChild(tagsLabel);
                    tagsFormGroupDiv.appendChild(select);

                    innerRowDiv.appendChild(tagsFormGroupDiv);

                    colDiv.appendChild(innerRowDiv);
                    rowDiv.appendChild(colDiv);

                    thumbnails.appendChild(rowDiv);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>