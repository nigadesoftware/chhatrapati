<?php
    require_once('../info/phpsqlajax_dbinfo.php');
    require("../info/phpgetlogin.php");
    require ("../info/ncryptdcrypt.php");
    require_once("../info/crypto.php");
    require_once("../sqlproc/defaultusersettings.php");
    $custid = new crypto;
    $customerid_de = $custid->Decrypt($_GET['customerid']);
    $basefolder_de = $custid->Decrypt($_GET['basefolder']);
    function factoryname(&$connection, $customerid)
    {
        $query = "SELECT c.miscustomername FROM miscustomer c where c.misactive=1 and c.miscustomerid=".$customerid;
        $result = mysqli_query($connection,$query);
        if ($row = @mysqli_fetch_assoc($result))
        {
            return $row['miscustomername'];
        }
        else
        {
            return '';
        }
    }
    function currentdatetime()
    {
        date_default_timezone_set("UTC");
        $dt = time();
        $dt = date('Y-m-d H:i:sP',$dt);
        return $dt;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <title>Module Selection</title>
        <style type="text/css">
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
            article
            {
                background-color: #fff;
                display: table;
                margin-left: 0px;
                padding-left: 3px;
                font-family: Arial Unicode Ms;
                font-size: 15px;
            }
            section
            {
                margin-left: 0px;
                margin-right: 3px;
                float: left;
                text-align: left;
                color: #000;
                line-height: 23px;
            }
            a.navbar
            {
                color: #f48;
            }
            a.servicebar
            {
                color: #b00;
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
            ul
            {
                line-height: 30px;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
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
        <header class="w3-container">
            <!-- <div><img src="../img/swapp_namelogo.png" width="93px" height="31px">
                </div> -->
        </header>
        <nav "w3-container">
            <ul class="navbar">
                <li><a class="navbar" href="../index.php">MIS Home</a>
            </ul>
        </nav>
        <article class="w3-container">
            <div><img src="../img/module.png" width="50px" height="50px">
            </div>
            <section>
                    <table style="border=1px solid black; border-radius:10px; padding:0px; padding-top:6px;margin: 0px;" align="left" width=300px>
                       <div class="form-group">
                        <tr>
                            <td><h4 for="">Module Selection</h4></td>
                        </tr>
                        <?php
                            // Opens a connection to a MySQL server
                            $connection=mysqli_connect($hostname, $username, $password, $database);
                            // Check connection
                            if (mysqli_connect_errno())
                            {
                                echo "Communication Error1";
                                exit;
                            }
                            $connection ->autocommit(FALSE);
                            $custid = new crypto;
                            $query = "SELECT m.mismoduleid,mismodulename_eng,m.modulefolder,c.moduleversionfolder FROM miscustomermodules c, mismodule m where c.active=1 and m.active=1 and c.mismoduleid=m.mismoduleid and c.miscustomerid=".$customerid_de;
                            $result = mysqli_query($connection,$query);
                            $factoryname = factoryname($connection,$customerid_de);
                            $_SESSION["factorycode"]=$customerid_de;
                            $_SESSION["factoryname"]=$factoryname;
                            $query = "insert into misuserlogininformation(miscustomerid,misuserid,sessionid,ip_address,sessionstartdatetime) values (".$customerid_de.",".$_SESSION["usersid"].",'".$_SESSION["cursession"]."'".",'".$_SERVER['REMOTE_ADDR']."','".currentdatetime()."')";
                            if (mysqli_query($connection, $query))
                            {
                                if ($_SESSION['changedefaultusersettings'] == 'on')
                                {
                                   $query1 = "update userdefault set active=0 where misuserid=".$_SESSION["usersid"]." and active=1";
                                   if (mysqli_query($connection, $query1))
                                   {
                                        $query2 = "select ifnull(max(userdefaultid),354165247)+167 as userdefaultid from userdefault";
                                        $result2 = mysqli_query($connection, $query2);
			                            $row2 = mysqli_fetch_assoc($result2);
			                            $userdefaultid = $row2["userdefaultid"];
                                        $query3 = "insert userdefault(userdefaultid,misuserid,factorycode,active) values (".$userdefaultid.",".$_SESSION['usersid'].",".$_SESSION['factorycode'].",1)";
                                        if (mysqli_query($connection, $query3))
                                        {
                                            $connection -> commit();
                                        }
                                        else
                                        {
                                            echo "Communication Error3";
                                            exit;
                                        }
                                   }
                                   else
                                   {
                                        echo "Communication Error3";
                                        exit;
                                   }
                                }
                                else
                                {
                                    $connection -> commit();    
                                }
                                $defaultmoduleid = getdefaultmoduleid($connection);                            
                                $i=1;
                                while ($row = @mysqli_fetch_assoc($result))
                                {
                                    if ($defaultmoduleid == $row["mismoduleid"] and $_SESSION['usedefaultusersettings'] == 'on')
                                    {
                                        $mismoduleid_en = $custid->Encrypt($row["mismoduleid"]);
                                        header('location: ../'.$row['modulefolder'].'/'.$row['moduleversionfolder'].'/customer/'.$basefolder_de.'/mis/selectresponsibility.php?mismoduleid='.$mismoduleid_en);
                                    }
                                    else
                                    {
                                        $mismoduleid_en = $custid->Encrypt($row["mismoduleid"]);
                                        echo '<tr>';
                                        if ($row['modulefolder'] == '*' and $row['moduleversionfolder'] =='*')
                                        {
                                            echo '<td><img src="../img/lineitem.png" width="20px" height="20px"><a style="color:#000;font-size:16px" href=../mis/selectresponsibility.php?mismoduleid='.$mismoduleid_en.'>'.$row['mismodulename_eng'].' </a></td>';
                                        }
                                        else
                                        {
                                            echo '<td><img src="../img/lineitem.png" width="20px" height="20px"><a style="color:#000;font-size:16px" href=../'.$row['modulefolder'].'/'.$row['moduleversionfolder'].'/customer/'.$basefolder_de.'/mis/selectresponsibility.php?mismoduleid='.$mismoduleid_en.'>'.$row['mismodulename_eng'].' </a></td>';
                                        }
                                        echo '</tr>';
                                        $i++;
                                    }
                                }
                            }
                            else
                            {
                                echo "Communication Error2";
                                exit;
                            }
                        ?>
                    </table>
            </section>
        </article>
        <footer>
        </footer>
    </body>
</html>