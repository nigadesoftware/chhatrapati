<?php
    require("../info/phpsqlajax_dbinfo.php");
    require("../info/phpgetlogin.php");
    include("../info/ncryptdcrypt.php");
    require("../info/rawmaterialroutine.php");
    //Raw Material Transaction Addition or Alteration
    if (isaccessible(452365784154249)==0 and isaccessible(658741245893258)==0)
    {
        echo 'Communication Error';
        exit;
    }
    $contractid_de = fnDecrypt($_GET['contractid']);
    $contractreferencecategoryid_de = fnDecrypt($_GET['contractreferencecategoryid']);
    $contractreferencedetailid_de = fnDecrypt($_GET['contractreferencedetailid']);
    if (isset($_GET['contractsigndetailid']))
    {
        $contractsigndetailid_de = fnDecrypt($_GET['contractsigndetailid']);    
    }
    $flag = $_GET['flag'];
    // Opens a connection to a MySQL server
    $connection=rawmaterial_connection();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <title>Contract Sign Detail</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <style type="text/css">
            @font-face {
            font-family: siddhanta;
            src: url("../fonts/siddhanta.ttf");
            font-weight: normal;
            }
            body
            {
                background-color: #fff;
            }
            header
            {
                background-color: #fff;
                min-height: 38px;
                color: #070;
                font-family: Arial;
                font-size: 19px;
            }
            nav
            {
                width: 300px;
                float: left;
                list-style-type: none;
                font-family: verdana;
                font-size: 15px;
                color: #f48;
                line-height: 30px;
            }
            a
            {
                color: #f48;
            }
            article
            {
                background-color: #fff;
                display: table;
                margin-left: 0px;
                padding-left: 10px;
                font-family: Verdana;
                font-size: 15px;
            }
            section
            {
                margin-left: 0px;
                margin-right: 15px;
                float: left;
                text-align: justify;
                color: #000;
                line-height: 23px;
            }
            footer
            {
                float: bottom;
                color: #000;
                font-family: verdana;
                font-size: 12px;
            }
            div
            {
                float:left;
            }
            input, textarea
            {
                outline: none;
                font-family: siddhanta;
            }
            button
            {
                width:200px;
                height:35px;
                color:#000;
                border-radius: 5px;
            }
            input:focus, textarea:focus
            {
                border-radius: 5px;
                outline: none;
                font-family: siddhanta;
                background-color: #fef;
            }
            label
            {
                color: #333;
                font-family: siddhanta;
                font-size: 18px;
                font-weight: normal;
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
        <!-- <style type="text/css">
            @font-face {
            font-family: siddhanta;
            src: url("../fonts/siddhanta.ttf");
            font-weight: normal;
            }
            body
            {
                background-color: #fff;
            }
            header
            {
                background-color: #fff;
                min-height: 38px;
                color: #070;
                font-family: Arial;
                font-size: 19px;
            }
            nav
            {
                width: 300px;
                float: left;
                list-style-type: none;
                font-family: verdana;
                font-size: 15px;
                color: #f48;
                line-height: 30px;
            }
            a
            {
                color: #f48;
            }
            article
            {
                background-color: #fff;
                display: table;
                margin-left: 0px;
                padding-left: 10px;
                font-family: Verdana;
                font-size: 15px;
            }
            section
            {
                margin-left: 0px;
                margin-right: 15px;
                float: left;
                text-align: justify;
                color: #000;
                line-height: 23px;
            }
            footer
            {
                float: bottom;
                color: #000;
                font-family: verdana;
                font-size: 12px;
            }
            div
            {
                float:left;
            }
            input, textarea
            {
                outline: none;
                font-family: siddhanta;
            }
            button
            {
                width:200px;
                height:35px;
                color:#000;
                border-radius: 5px;
            }
            input:focus, textarea:focus
            {
                border-radius: 5px;
                outline: none;
                font-family: siddhanta;
                background-color: #fef;
            }
            label
            {
                color: #333;
                font-family: siddhanta;
                font-size: 18px;
                font-weight: normal;
            }
        </style>  -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="http://ajax.googleapi_mysqls.com/ajax/libs/jquery/1.11.0/jquery.min.js">
         </script>
         
         <script>
            $(document).ready(function(){
             setInterval(function(){cache_clear()},3600000);
             });
             function cache_clear()
            {
             window.location.reload(true);
            }
        </script>
        
     </head>
    <body>
        <nav "w3-container">
            <ul class="navbar">
                <li><a class="navbar" href="../data/entitymenu.php">Entity Menu</a><br/>
                <?php
                    /*$personnamedetailtypeid_en = fnEncrypt($personnamedetailtypeid_de);
                    $personnamedetailid_en = fnEncrypt($personnamedetailid_de);
                    echo '<li><a style="color:#f48;text-align:left;" href="../data/personnamedetail_find.php?personnamedetailtypeid='.$personnamedetailtypeid_en.'">personnamedetail Find</a><br/>';*/
                    $contractreferencecategoryid_en = fnEncrypt($contractreferencecategoryid_de);
                    $contractreferencedetailid_en = fnEncrypt($contractreferencedetailid_de);
                    echo '<li><a class="navbar" href="../data/contract.php?contractid='.fnEncrypt($contractid_de).'&flag='.fnEncrypt('Display').'">Add/Display Contract</a></br>';
                    if ($contractreferencecategoryid_de == 254156358)
                    {
                        echo '<li><a class="navbar" href="../data/contractharvestdetail_list.php?contractid='.fnEncrypt($contractid_de).'&contractreferencecategoryid='.$_GET['contractreferencecategoryid'].'&flag='.fnEncrypt('Display').'">Add/Display Contract Harvest Detail List</a></br>';    
                    }
                    elseif ($contractreferencecategoryid_de == 584251658)
                    {
                        echo '<li><a class="navbar" href="../data/contracttransportdetail_list.php?contractid='.fnEncrypt($contractid_de).'&contractreferencecategoryid='.$_GET['contractreferencecategoryid'].'&flag='.fnEncrypt('Display').'">Add/Display Contract Transport Detail List</a></br>';    
                    }
                    elseif ($contractreferencecategoryid_de == 753621495)
                    {
                        echo '<li><a class="navbar" href="../data/contractguarantordetail_list.php?contractid='.fnEncrypt($contractid_de).'&contractreferencecategoryid='.$_GET['contractreferencecategoryid'].'&flag='.fnEncrypt('Display').'">Add/Display Contract Guarantor Detail List</a></br>';    
                    }
                    echo '<li><a class="navbar" href="../data/contractsigndetail_list.php?contractid='.fnEncrypt($contractid_de).'&contractreferencecategoryid='.$contractreferencecategoryid_en.'&contractreferencedetailid='.$contractreferencedetailid_en.'&flag='.fnEncrypt('Display').'">Add/Display Contract Sign Detail List</a></br>';
                    echo '<li><a style="color:#f48" class="navbar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
                ?>
            </ul>
        </nav>
        <article class="w3-container">
            <div><img src="../img/contract.png" width="201" height="41px"></div>
            <?php
                if ($contractreferencedetailid_de=="")
                {
                    $query = "select f.* from contractsigndetail f where f.active=1 and contractreferencecategoryid=".$contractreferencecategoryid_de." and contractreferencedetailid is null and f.contractid = ".$contractid_de;
                }
                else
                {
                    $query = "select f.* from contractsigndetail f where f.active=1 and contractreferencecategoryid=".$contractreferencecategoryid_de." and contractreferencedetailid=".$contractreferencedetailid_de." and f.contractid = ".$contractid_de;
                }
                //$query = "select f.* from contractsigndetail f where f.active=1 and f.contractid = ".$contractid_de." and f.contractreferencecategoryid=".$contractreferencecategoryid_de." and f.contractreferencedetailid=".$contractreferencedetailid_de;
                //echo $query;
                $result = oci_parse($connection, $query); $r = oci_execute($result);
                if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
                {
                     echo '<section>';
                    //if ($flag_de == 'Display')
                    //{
                        echo '<form action="../api_action/contractsigndetail_action.php" method="post" >';
                    //}
                        echo '<table border="0" >';

                        echo '<tr>';  
                        echo '<td></td>';  
                        echo '</tr>';

                        echo '<input name="MAX_FILE_SIZE" value="102400" type="hidden">';
                        echo '<img src="data:image/png;base64,'.base64_encode($row['SIGN']->load()).'" width="300px" height="auto"/>';
                        
                        echo '<tr>';
                        echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractid" id="contractid" style="width:300px" value ="'.$row['CONTRACTID'].'"></td>';
                        echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractreferencecategoryid" id="contractreferencecategoryid" style="width:300px" value ="'.$row['CONTRACTREFERENCECATEGORYID'].'"></td>';
                        echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractreferencedetailid" id="contractreferencedetailid" style="width:300px" value ="'.$row['CONTRACTREFERENCEDETAILID'].'"></td>';
                        echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractsigndetailid" id="contractsigndetailid" style="width:300px" value ="'.$row['CONTRACTSIGNDETAILID'].'"></td>';
                        echo '</tr>';

                        if ($flag=='change')
                        {
                            echo '<tr>';
                            echo '<td><input type="submit" name="btn" value="Change" style="width:100px"></td>';
                            echo '</tr>';
                        }
                        if ($flag=='delete')
                        {
                            echo '<tr>';
                            echo '<td><input type="submit" name="btn" value="Delete" style="width:100px"></td>';
                            echo '</tr>';
                        }
                        /* echo '<tr>';
                        echo '<td><input type="submit" name="btn" value="Reset" style="width:100px"></td>';
                        echo '</tr>'; */
                        
                    echo '</table>';
                    echo '</form>';
                    echo '</section>'; 
                }
                else
                {
                    echo '<section>';
                    //echo '<form id="form1" action="../api_action/contractsigndetail_action.php" method="post">';
                    ?>
                    <div class="container">
                    <h3 class="title">Select, Crop, and Upload Your Image</h3>
            
                    <!-- Image upload form -->
                    <form id="imageForm" action="../api_action/contractsigndetailnew_action.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="imageInput" class="form-label">Select Image:</label>
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
            
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="submit" name="btn" value="Add" style="width:100px">
                        </div>
                    
            
                
                    <?php
                    echo '<section>';
                    echo '</section>';
                    echo '<td></td>';  
                    echo '</tr>';
                    echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractid" id="contractid" style="width:300px" value ="'.$contractid_de.'"></td>';
                    echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractreferencecategoryid" id="contractreferencecategoryid" style="width:300px" value ="'.$contractreferencecategoryid_de.'"></td>';
                    echo '<td><input type="hidden" style="font-size:12pt;height:30px" name="contractreferencedetailid" id="contractreferencedetailid" style="width:300px" value ="'.$contractreferencedetailid_de.'"></td>';
                    echo '<td><input type="hidden" name="mysign" id="mysign" ></td>';
                    echo '</tr>';
                    echo '</div>';
                    echo '<div>';
                    //echo '<img id="signature" alt="Captured Image"/>';
                    echo '</div>';
                    /* echo '<tr>';
                    echo '<td><input type="submit" name="btn" value="Add" style="width:100px"</button>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><input type="submit" name="btn" value="Display" style="width:100px"</button>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td><input type="submit" name="btn" value="Reset" style="width:100px"</button>';
                    echo '</tr>'; */
                    echo '</table>';
                    echo '</form>';
                    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>';
                    echo '<script src="../js/example.js"></script>';
                    echo '</section>';
                }
            ?>
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
        </article>
        <footer>
        </footer>
    </body>
</html>