<?php
	//require("../info/phpsqlajax_dbinfo.php");
	require("../info/phpgetloginview.php");
	require("../info/ncryptdcrypt.php");
	require("../info/rawmaterialroutine.php");
	include("../api_oracle/contractsigndetail_db_oracle.php");
	$connection = rawmaterial_connection();
	$contractsigndetail1 = new contractsigndetail($connection);
	/* switch ($_POST['btn'])
	{
		case 'Add': */
			$contractsigndetail1->contractid = $_POST["contractid"];
			$contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
			$contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];
			session_start(); 
			/* $upload_dir = "../doc_signs/";
			$img = $_POST['mysign'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = $upload_dir . $_POST['contractid']. ".jpg";
			$success = file_put_contents($file, $data);
			//print $success ? $file : 'Unable to save the file.';
			$contractsigndetail1->sign = fread(fopen($file, "r"), filesize($file)); */

            // Get the cropping coordinates and dimensions from the form
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

//echo "Image processing complete!";

            // Convert the cropped image to binary data for storage
            $croppedImageContent = file_get_contents($croppedImagePath);
			unlink($croppedImagePath);
            $contractsigndetail1->sign = $croppedImageContent;
			$ret = $contractsigndetail1->insert();
			if ($ret==1)
			{
				oci_commit($connection);
				echo '<span class="w3-container" style="background-color:#0a0;color:#ff8;text-align:left;">Contract Signature is added successfully</span></br>';
				echo '<a href="../data/contractsigndetail_list.php?contractid='.fnEncrypt($contractsigndetail1->contractid).'&contractreferencecategoryid='.fnEncrypt($contractsigndetail1->contractreferencecategoryid).'&contractreferencedetailid='.fnEncrypt($contractsigndetail1->contractreferencedetailid).'&contractsigndetailid='.fnEncrypt($contractsigndetail1->contractsigndetailid).'">Contract Signature List</a></br>';
			}
			else
			{
				oci_rollback($connection);
				echo '<span style="background-color:#f44;color:#ff8;text-align:left;">'.$contractsigndetail1->Get_invalidmessagetext().'</span></br>';
			}
			/* break;
		case 'Change':
			$contractsigndetail1->contractsigndetailid = $_POST["contractsigndetailid"];
			$contractsigndetail1->contractid = $_POST["contractid"];
			$contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
            $contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];
			
			if (isset($_FILES['sign']) && $_FILES['sign']['size'] > 0) 
			{
				// Temporary file name stored on the server

				$tmpName = $_FILES['sign']['tmp_name'];


				// Read the file

				$fp = fopen($tmpName, 'r');

				$data = fread($fp, filesize($tmpName));

				$data = addslashes($data);

				fclose($fp);
			}

			$contractsigndetail1->sign = $data;

			$ret = $contractsigndetail1->update();
			if ($ret==1)
			{
				oci_commit($connection);
				echo '<span class="w3-container" style="background-color:#0a0;color:#ff8;text-align:left;">Contract Finger Print is Updated successfully</span></br>';	
				echo '<a href="../data/contractsigndetail_list.php?contractid='.fnEncrypt($contractsigndetail1->contractid).'&contractreferencecategoryid='.fnEncrypt($contractsigndetail1->contractreferencecategoryid).'&contractreferencedetailid='.fnEncrypt($contractsigndetail1->contractreferencedetailid).'&contractsigndetailid='.fnEncrypt($contractsigndetail1->contractsigndetailid).'">Contract Aadhar Detail List</a></br>';
			}
			else
			{
				oci_rollback($connection);
				echo '<span style="background-color:#f44;color:#ff8;text-align:left;">'.$contractsigndetail1->Get_invalidmessagetext().'</span></br>';
			}
			break;
		case 'Display':
			$contractsigndetail1->contractsigndetailid = $_POST["contractsigndetailid"];
			$contractsigndetail1->contractid = $_POST["contractid"];
			$contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
			$contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];
			$contractsigndetail1->sign = $_POST["sign"];

			$result1 = $contractsigndetail1->display();
			if ($contractsigndetail1->Get_invalidid()==0)
			{
				while ($row1 = oci_fetch_array($result1))
				{
					echo '<a href="../data/contractsigndetail.php?contractid='.fnEncrypt($contractsigndetail1->contractid).'&contractreferencecategoryid='.fnEncrypt($contractsigndetail1->contractreferencecategoryid).'&contractreferencedetailid='.fnEncrypt($contractsigndetail1->contractreferencedetailid).'&contractsigndetailid='.fnEncrypt($row1['CONTRACTFINGERPRINTDETAILID']).'&flag='.fnencrypt('Display').'">AADHAR DETAIL</BR>';
				}	
			}
			else
			{
				echo '<span style="background-color:#f44;color:#ff8;text-align:left;">'.$contractsigndetail1->Get_invalidmessagetext().'</span></br>';
			}
			break;
		case 'Delete':
			$contractsigndetail1->contractsigndetailid = $_POST["contractsigndetailid"];
			$contractsigndetail1->contractid = $_POST["contractid"];
			$contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
            $contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];

			$ret = $contractsigndetail1->delete();
			if ($ret == 1)
			{
				oci_commit($connection);
				echo '<span class="w3-container" style="background-color:#0a0;color:#ff8;text-align:left;">Contract Sign is Deleted Successfully</span></br>';
				echo '<a href="../data/contractsigndetail_list.php?contractid='.fnEncrypt($contractsigndetail1->contractid).'&contractreferencecategoryid='.fnEncrypt($contractsigndetail1->contractreferencecategoryid).'&contractreferencedetailid='.fnEncrypt($contractsigndetail1->contractreferencedetailid).'&contractsigndetailid='.fnEncrypt($contractsigndetail1->contractsigndetailid).'">Contract Sign List</a></br>';
			}
			else
			{
				oci_rollback($connection);
				echo '<span style="background-color:#f44;color:#ff8;text-align:left;">'.$contractsigndetail1->Get_invalidmessagetext().'</span></br>';
			}
			break;
		case 'Reset':
			$contractsigndetail1->contractsigndetailid = $_POST["contractsigndetailid"];
			$contractsigndetail1->contractid = $_POST["contractid"];
			echo '<a href="../data/contractsigndetail_list.php?contractid='.fnEncrypt($contractsigndetail1->contractid).'&contractreferencecategoryid='.fnEncrypt($contractsigndetail1->contractreferencecategoryid).'&contractreferencedetailid='.fnEncrypt($contractsigndetail1->contractreferencedetailid).'&contractsigndetailid='.fnEncrypt($contractsigndetail1->contractsigndetailid).'">Contract Finger Print List</a></br>';
			break;
		default:
			echo 'Communication Error';
			break; 
	}*/
?>