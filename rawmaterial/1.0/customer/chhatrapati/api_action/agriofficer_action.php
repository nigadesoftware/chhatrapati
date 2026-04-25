<?php
require("../info/phpgetloginview.php");
require("../info/ncryptdcrypt.php");
require("../info/rawmaterialroutine.php");
include("../api_oracle/contractsigndetail_db_oracle.php");

session_start();
$connection = rawmaterial_connection();
if (!$connection) {
    die("Database connection failed: " . oci_error()['message']);
}

$x = $_POST['x'];
$y = $_POST['y'];
$width = $_POST['width'];
$height = $_POST['height'];

// Image file from the form
$imageFile = $_FILES['image']['tmp_name'];

// Load the image using GD
$image = imagecreatefromstring(file_get_contents($imageFile));
if ($image === false) {
    die('Invalid image file.');
}

// Create a new true color image with the desired width and height
$cropped = imagecreatetruecolor($width, $height);

// Enable transparency for the new image if needed
imagealphablending($cropped, false);
imagesavealpha($cropped, true);

// Create a fully transparent background (or white depending on your choice)
$transparentColor = imagecolorallocatealpha($cropped, 0, 0, 0, 127); // For transparent
$whiteColor = imagecolorallocate($cropped, 255, 255, 255); // For white background
$backgroundToWhite = true; // Set to false if you want transparency, true for white

// Copy the cropped area from the original image
imagecopy($cropped, $image, 0, 0, $x, $y, $width, $height);

// Loop through the image to find background-like colors and replace them
for ($i = 0; $i < $width; $i++) {
    for ($j = 0; $j < $height; $j++) {
        $rgba = imagecolorat($cropped, $i, $j);
        $colors = imagecolorsforindex($cropped, $rgba);
        
        // Check if the pixel is part of the background (light-colored, almost white)
        if ($colors['red'] > 240 && $colors['green'] > 240 && $colors['blue'] > 240) {
            if ($backgroundToWhite) {
                // Set the pixel to white
                imagesetpixel($cropped, $i, $j, $whiteColor);
            } else {
                // Set the pixel to transparent
                imagesetpixel($cropped, $i, $j, $transparentColor);
            }
        }
    }
}

// Save the image as PNG (to preserve transparency if needed)
$croppedImagePath = 'cropped_signature.png';
imagepng($cropped, $croppedImagePath);

// Free up memory
imagedestroy($image);
imagedestroy($cropped);

// Prepare to update the database
$seasonid = $_SESSION['finalreportperiodid'];
$description = $_POST['name'];
$categorycode = $_POST['categorycode'];
// Convert the cropped image to binary data for storage
$croppedImageContent = file_get_contents($croppedImagePath);
unlink($croppedImagePath);
// Create a new LOB descriptor
$lob = oci_new_descriptor($connection, OCI_D_LOB);
if ($categorycode==1)
{
    // Prepare the update SQL statement
    $query = 'UPDATE season 
            SET sign = EMPTY_BLOB(),
                agriofficernameuni = :agriofficernameuni
            WHERE seasonid = :seasonid 
            RETURNING sign INTO :SIGN';

    // Prepare the statement
    $stmt = oci_parse($connection, $query);

    // Bind the parameters
    oci_bind_by_name($stmt, ':seasonid', $seasonid); // assuming $seasonid is defined in your code
    oci_bind_by_name($stmt, ':agriofficernameuni', $description); // assuming $description is defined in your code
    oci_bind_by_name($stmt, ':SIGN', $lob, -1, OCI_B_BLOB);
}
elseif ($categorycode==2)
{
    // Prepare the update SQL statement
    $query = 'UPDATE season 
            SET managersign = EMPTY_BLOB(),
                managernameuni = :managernameuni
            WHERE seasonid = :seasonid 
            RETURNING managersign INTO :SIGN';

    // Prepare the statement
    $stmt = oci_parse($connection, $query);

    // Bind the parameters
    oci_bind_by_name($stmt, ':seasonid', $seasonid); // assuming $seasonid is defined in your code
    oci_bind_by_name($stmt, ':managernameuni', $description); // assuming $description is defined in your code
    oci_bind_by_name($stmt, ':SIGN', $lob, -1, OCI_B_BLOB);
}
// Execute the statement
if (oci_execute($stmt, OCI_DEFAULT)) {
    // If the execution was successful, save the new image data to the BLOB
    if ($lob->save($croppedImageContent)) { // Assuming $this->sign contains the binary data for the image
        oci_commit($connection); // Commit the transaction
        echo '<a href="../data/entitymenu.php">Contract Signature updated successfully. Click here to view.</a>'; // Replace with your success URL
        return 1; // Indicate success
    } else {
        // Handle save failure
        oci_rollback($connection); // Rollback on failure
        echo '<span style="color:red;">Failed to save the BLOB data. <a href="previous_page.php">Click here to go back.</a></span>'; // Replace with your previous URL
        return 0; 
    }
} else {
    // If the statement failed, handle the error
    $error = oci_error($stmt);
    echo "Error executing statement: " . $error['message'];
    oci_rollback(connection); // Rollback on error
    return 0; 
}

// Clean up
$lob->free(); // Free the LOB descriptor
oci_free_statement($stmt); // Free the statement

?>
