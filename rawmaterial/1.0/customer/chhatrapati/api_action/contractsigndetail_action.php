<?php
	//require("../info/phpsqlajax_dbinfo.php");
	require("../info/phpgetloginview.php");
	require("../info/ncryptdcrypt.php");
	require("../info/rawmaterialroutine.php");
	include("../api_oracle/contractsigndetail_db_oracle.php");
	$connection = rawmaterial_connection();
	$contractsigndetail1 = new contractsigndetail($connection);
	switch ($_POST['btn'])
	{
		case 'Add':
			$contractsigndetail1->contractid = $_POST["contractid"];
			$contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
			$contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];
			session_start(); 
			$upload_dir = "../doc_signs/";
			$img = $_POST['mysign'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = $upload_dir . $_POST['contractid']. ".jpg";
			$success = file_put_contents($file, $data);
			//print $success ? $file : 'Unable to save the file.';
			$contractsigndetail1->sign = fread(fopen($file, "r"), filesize($file));
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
			break;
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
	}
?>