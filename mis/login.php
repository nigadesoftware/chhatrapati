<?php
    if (isset($_GET['flag']))
    {
        $flag = $_GET['flag'];    
    }
    else
    {
        $flag = -1;
    }
    /*require ("../info/ncryptdcrypt.php");
    $pwd="CMX0weHdKa7y4QxlpoYQ2A==";
    echo 'ur pwd : '.fnDecryptpass($pwd);*/

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <title>Login</title>
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
            <div><img src="../img/swapp_namelogo.png" width="93px" height="31px">
                </div>
        </header>
        <nav "w3-container">
            <ul class="navbar">
                <li><a class="navbar" href="../index.php">MIS Home</a>
            </ul>
        </nav>
        <article class="w3-container">
            <div><img src="../img/userlogin.png" width="50px" height="50px">
            </div>
            <section>
                <form method="post" role="form" action="../sqlproc/validatelogin.php">
                    <table style="border=1px solid black; border-radius:10px; padding:0px; padding-top:6px;margin: 0px;" align="left" width=250px>
                       <div class="form-group">
                        <tr>
                            <td><h4 for="">User Login</h4></td>
                        </tr>
                        <tr>
                            <td><label for="userid">User Id</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="userid" id="userid" autofocus></td>
                            <td><label for="userid">*</label></td>
                        </tr>
                        </div>
                        <div class="form-group">
                        <tr>
                            <td><label for="users_pass">Password</label></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="users_pass" id="users_pass"></input></td>
                            <td><label for="password">*</label></td>
                        </tr>
                        </div>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td height="30px"><button type="submit">Login </button>
                        </tr>
                        <tr>
                            <td><a ><input type="checkbox" name="usedefaultusersettings" id="usedefaultusersettings" checked="checked">Use Default User Settings</a></td>
                        </tr>
                        <tr>
                            <td><a ><input type="checkbox" name="changedefaultusersettings" id="changedefaultusersettings">Change Default User Settings</a></td>
                        </tr>
                        
                        <?php
                            if ($flag == 0)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Successfully, Logged out!</label></td>';
                                echo '</tr>';
                            }
                            elseif ($flag == 2)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Timed out! Login Again</label></td>';
                                echo '</tr>';
                            }
                            elseif ($flag == 3)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Login IP Changed! Login Again</label></td>';
                                echo '</tr>';
                            }
                            elseif ($flag == 4)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Incomplete Login Information!</label></td>';
                                echo '</tr>';
                            }
                            elseif ($flag == 5)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Invalid Credentials</label></td>';
                                echo '</tr>';
                            }
                            elseif ($flag == 6)
                            {
                                echo '<tr>';
                                echo '<td style = "color: #b00"><label for="message">Invalid Aadhar Number</label></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </form>
            </section>
        </article>
        <footer>
        </footer>
    </body>
</html>