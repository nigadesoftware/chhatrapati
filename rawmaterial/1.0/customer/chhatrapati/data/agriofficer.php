<?php
$categorycode = $_GET['categorycode'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agri Officer Detail</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <style>
        /* Custom Styles */
        body {
            background: #f8f9fa;
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .title {
            text-align: center;
            color: #5a5a5a;
            margin-bottom: 20px;
        }

        #imageContainer {
            width: 100%; /* Full width inside the container */
            height: auto;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        #imageToCrop {
            max-width: 100%; /* Responsive to container width */
            height: auto;
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 10px;
            background: #fafafa;
        }

        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border-radius: 30px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Select, Crop, and Upload Your Image</h1>

        <!-- Image upload form -->
        <form id="imageForm" action="../api_action/agriofficer_action.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="imageInput" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
                <label for="imageInput" class="form-label">Select Sign Image:</label>
                <input type="file" name="image" id="imageInput" accept="image/*" required class="form-control">
            </div>

            <!-- Container for the image preview and cropping -->
            <div id="imageContainer">
                <img id="imageToCrop" />
            </div>

            <!-- Hidden fields to store crop data -->
            <input type="hidden" id="x" name="x">
            <input type="hidden" id="y" name="y">
            <input type="hidden" id="width" name="width">
            <input type="hidden" id="height" name="height">
            <?php echo '<input type="hidden" id="categorycode" name="categorycode" value="'.$categorycode.'">'?>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <input type="submit" value="Crop & Upload" class="btn btn-custom px-4">
            </div>
        </form>
    </div>

    <script>
        let cropper;
        const imageInput = document.getElementById('imageInput');
        const imageToCrop = document.getElementById('imageToCrop');
        const form = document.getElementById('imageForm');

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                imageToCrop.src = e.target.result;

                // Initialize Cropper.js with a custom crop box size
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: NaN,
                    viewMode: 1,
                    minContainerWidth: 500,
                    minContainerHeight: 300,
                    cropBoxResizable: true,
                    ready: function () {
                        // Set the default crop box size (e.g., 200x200)
                        cropper.setCropBoxData({
                            width: 200,
                            height: 50
                        });
                    }
                });
            };
            reader.readAsDataURL(file);
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const cropData = cropper.getData();
            document.getElementById('x').value = cropData.x;
            document.getElementById('y').value = cropData.y;
            document.getElementById('width').value = cropData.width;
            document.getElementById('height').value = cropData.height;

            form.submit();
        });
    </script>
</body>
</html>
