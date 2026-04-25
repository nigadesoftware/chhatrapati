<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="msvalidate.01" content="34F40E5F5064AC6207F991E677AC6747" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Information Technology (IT) Consultancy Services">
    <meta name="author" content="Swapp Software Application">
    <meta property="og:image" content="http://www.swapp.co.in/img/swappcoinwebsite.png"/>
    <title>SwappERP</title>
    <meta property="og:image" content="http://www.swapp.co.in/img/wwwswappcoin.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script async type="text/javascript" src="js/menu.js" ></script>
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-touch-icon-120x120.png" />
    <link href="css/cssmenu.css" rel="stylesheet" type="text/css" /> 
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="ism/css/my-slider.css"/>
    <script src="ism/js/ism-2.2.min.js"></script>
    <script async src="https://apis.google.com/js/platform.js"></script>
    <style type="text/css">
    @font-face {
        font-family: siddhanta;
        src: url("../fonts/siddhanta.ttf");
        font-weight: normal;
    }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script async src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script async src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]
    -->
  <!--<script async type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=58db35533dec30001259e677&product=sticky-share-buttons"></script>-->
</head>
<body>
    <div id="fb-root"></div>
<script async>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_IN/sdk.js#xfbml=1&version=v2.8&appId=1299772940069870";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <header>
        <div class="row">
          <div style="background-color:#fff">
                    <div style="float:right;padding:20px;"><a href='/mis/login.php' style="font-size:18px"><img src="../img/userlogin.png" width="30px" height="30px">Login</a></div>
                    <div style="background-color:#fff">
                    <img class="brand-logo-big" src="../img/swapp_small_logo.png" alt="">
                    <label class="brand-name">Swapp Software Application, Pune</label>
                    </br>
                    <label style="color:#fa0;background-color:#800;font-family: 'Siddhanta';font-size:14px;"; class="brand-second">Information Technology (IT) Consultancy Services</label>
                    <label style="color:#080;background-color:#fff;font-family: 'Siddhanta';font-size:20px;"; class="brand-second">www.swapp.co.in</label>
                    </div>
                    <div id="wrapper">
                        </div>
                    </h4>
                </div>
          </div>
          </div>
          </div>
          </div>
    </header>  
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="col-lg-121">
                  <div align="right" style="background-color:#fff;color:#000">
                      <?php
                      if (isset($_SESSION['fb_access_token'])==true)
                        {
                          
                          /*echo '<label><a style="color:#080" href="../site/userarea.php">
                      <img border="0" alt="Facebook Login " src="http://graph.facebook.com/'.$_SESSION['fb_id'].'/picture?type=square&redirect=true&width=20&height=20">Welcome! '.$_SESSION['fb_name'].'
                      </a></label>';*/
                      echo '<label><a style="color:#800" href="../site/logout.php"></br>&nbspLogout</a></label></br>';
                        }
                        else
                        {
                          /*echo '<label><a style="color:#000"href="../site/login.php">
                      Login using Facebook(फेसबुक आधारित लॉगीन)
                      </a><label>';*/
                        }
                      ?>
                      </div>
                      <div  align="center" style="color:#f08;background-color:#fff;font-family: 'Siddhanta';font-size:70px;">Shri Chhatrapati SSK
                      <!--<div class="fb-like" data-href="https://www.facebook.com/swapp.co.in" data-layout="button" data-action="like" data-size="large" data-show-faces="true"></div>-->
                      </div>
                    
                    <div class="ism-slider" data-play_type="loop" data-image_fx="zoompan" id="my-slider">
      <ol>
        <li>
          <img src="ism/image/slides/green-654402_1280.jpg">
          <div class="ism-caption ism-caption-0">Enterprise Resources Planning (ERP)</div>
        </li>
        <li>
          <img src="ism/image/slides/gr_23551.jpg">
          <div class="ism-caption ism-caption-0">Information Technology (IT)</div>
        </li>
        <li>
          <img src="ism/image/slides/home-office-336373_1280.jpg">
          <div class="ism-caption ism-caption-0">Software Services (SaaS)</div>
        </li>
        <li>
          <img src="ism/image/slides/tree-701688_1280.jpg">
          <div class="ism-caption ism-caption-0">Team Work</div>
        </li>
        <li>
          <img src="ism/image/slides/smartphone-695164_1280.jpg">
          <a class="ism-caption ism-caption-0" href="https://cloudsugarerp.blogspot.in" target="_blank">परिश्रमस्य फलं मधुरं भवति</a>
        </li>
      </ol>
    </div>
            </div>
            <div class="clearfix"></div>
            </div>
        
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script async src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script async src="js/bootstrap.min.js"></script>
    <script async type="application/ld+json">
      {
        "@context" : "http://schema.org",
        "@type" : "Organization",
              "name" : ,
              "url" : ,
              "sameAs" : [ ,         ]
              "contactPoint" : [{
        "@type" : "ContactPoint",
        "telephone" : ,
        "contactType" : "customer service"
        }]
      }
</body>
</html>