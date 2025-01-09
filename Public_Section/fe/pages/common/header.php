<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    session_start();
    require_once("../../be/common/dbconfig.php");
    require_once("../controllers/UserController.php");
    require_once("../views/UserViews.php");
    LogIn_Form_index();
    SignUp_Form_index();
    DontBookTable_index();
    BookTable_index();
    $requestUri = $_SERVER['REQUEST_URI'];
    if(strpos($requestUri, "About_us.php"))
      $pageId = 2;
    else if(strpos($requestUri, "Contact_us.php"))
      $pageId = 3;
    else if(strpos($requestUri,"Platters.php"))
      $pageId = 4;
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Bootstrap core CSS -->
<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Additional CSS Files -->
<link rel="stylesheet" href="../../assets/css/fontawesome.css">
<link rel="stylesheet" href="../../assets/css/templatemo-lugx-gaming.css">
<link rel="stylesheet" href="../../assets/css/owl.css">
<link rel="stylesheet" href="../../assets/css/Styles.css">
<link rel="stylesheet" href="../../assets/css/animate.css">
<link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css"/>
<link rel="stylesheet" href="../../assets/css/all.min.css"/>


   <!-- ***** Preloader Start ***** --> <!--
   <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> -->
  <!-- ***** Preloader End ***** -->

<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="../../index.php">
                        <img src="../../assets/images/logo.png" alt="" style="width: 80px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                      <li><a href="../../index.php">Home</a></li>
                      <li><a href="Platters.php" <?php if($pageId==4) echo 'class = "active"'; ?> >Our Plates</a></li>
                      <li><a href="About_us.php" <?php if($pageId==2) echo 'class = "active"'; ?> >About Us</a></li>
                      <li><a href="Contact_us.php" <?php if($pageId==3) echo 'class = "active"'; ?> >Contact Us</a></li>
                      <?php
                        BookTableButton_index();
                        SignIn_LogOut_index();
                       ?>
                  </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  </html>
