<?php
// Create connection to Oracle
 $db= "(DESCRIPTION =
              (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.1)(PORT = 1521))
              (CONNECT_DATA =
              (SERVER = DEDICATED)
                (SERVICE_NAME = scdbsnew)
              )
           )";
$conn = oci_connect("vsicane", "cane", $db);
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
}
//Close the Oracle connection
oci_close($conn);
?>