<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      session_start();
      require_once("fe/controllers/UserController.php");
      require_once("fe/views/UserViews.php");
      LogIn_Form_index();
      SignUp_Form_index();
      DontBookTable_index();
      BookTable_index();

      $pageId = 1;
      $pageDetails = getPageDetails($pageId);

      $pageTitle = $pageDetails['pageTitle'];
      $pageState = $pageDetails['pageState'];
      
      htmlspecialchars($pageState);
      if($pageState == "Inactive")
        header("Location: fe/pages/none.php");

      $bodySections = getBodySections($pageId);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title><?php echo $pageTitle ; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-lugx-gaming.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/Styles.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="assets/css/all.min.css"/>

  </head>

<body>

<!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>  
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->

  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.php">
                        <img src="assets/images/logo.png" alt="" style="width: 80px; ">
                    </a> 
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="fe/pages/Platters.php">Our Plates</a></li>
                    <li><a href="fe/pages/About_us.php">About Us</a></li>
                    <li><a href="fe/pages/Contact_us.php">Contact Us</a></li>
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
  <!-- ***** Header Area End ***** -->
  <div class="main-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 align-self-center">
            <div class="caption header-text">
              <?php echo $bodySections[0];?>
            </div>
          </div>
          <div class="col-lg-4 offset-lg-2">
            <div class="right-image">
              <img src="assets/images/sale.png" alt="" />
              <span class="price">$22</span>
              <span class="offer">-40%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="features">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="image">
                <img
                  src="assets/images/taste.png"
                  alt=""
                  style="max-width: 44px; border-radius: 10px" />
              </div>
              <h4>Good Taste</h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="image">
                <img
                  src="assets/images/safe.jpg"
                  alt=""
                  style="max-width: 44px; border-radius: 10px" />
              </div>
              <h4>Safe</h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="image">
                <img
                  src="assets/images/24.jpg"
                  alt=""
                  style="max-width: 44px; border-radius: 10px" />
              </div>
              <h4>Available</h4>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="item">
              <div class="image">
                <img
                  src="assets/images/love.png"
                  alt=""
                  style="max-width: 65px; border-radius: 7px" />
              </div>
              <h4>Made With Love</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section most-played">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="section-heading">
              <h6>TOP PLATTERS</h6>
              <h2>Most Ordered</h2>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="main-button">
              <a href="fe/pages/Platters.php">View All</a>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="item">
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/pl1.png" alt=""
                /></a>
              </div>
              <div class="down-content">
                <span class="category">Cold Platters</span>
                <h4>Crap Salad</h4>
                <a href="fe/pages/Platters.php">Explore</a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="item">
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/pl2.png" alt=""
                /></a>
              </div>
              <div class="down-content">
                <span class="category">Cold Platters</span>
                <h4>Goat Salad</h4>
                <a href="fe/pages/Platters.php">Explore</a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="item">
              <div class="thumb">
                <a href="fe/views/Platters.php"
                  ><img src="assets/images/sale.png" alt=""
                /></a>
              </div>
              <div class="down-content">
                <span class="category">Meaters</span>
                <h4>Steve Steak</h4>
                <a href="fe/pages/Platters.php">Explore</a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-6 col-sm-6">
            <div class="item">
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/3p.jpg" alt=""
                /></a>
              </div>
              <div class="down-content">
                <span class="category">More Categories</span>

                <a href="fe/pages/Platters.php">Explore</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section categories">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="section-heading">
              <h6>Categories</h6>
              <h2>Top Categories</h2>
            </div>
          </div>
          <div class="col-lg col-sm-6 col-xs-12">
            <div class="item">
              <h4>Cold Platters</h4>
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/cold.jpeg" alt=""
                /></a>
              </div>
            </div>
          </div>
          <div class="col-lg col-sm-6 col-xs-12">
            <div class="item">
              <h4>Meaters</h4>
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/meat.jpeg" alt=""
                /></a>
              </div>
            </div>
          </div>
          <div class="col-lg col-sm-6 col-xs-12">
            <div class="item">
              <h4>Breakfast Platters</h4>
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/break.jpeg" alt=""
                /></a>
              </div>
            </div>
          </div>
          <div class="col-lg col-sm-6 col-xs-12">
            <div class="item">
              <h4>More and more</h4>
              <div class="thumb">
                <a href="fe/pages/Platters.php"
                  ><img src="assets/images/3p.jpg" alt=""
                /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section cta">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="plates">
              <div class="row">
                <div class="col-lg-12">
                  <div class="section-heading">
                    <h6>Our plates</h6>
                    <h2>
                      Go Buy & Get Best <em>Prices and Taste</em> For You!
                    </h2>
                  </div>
                  <div class="main-button">
                    <a href="fe/pages/Platters.php">Eat Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
      </div>
    </div>
  </footer>
  
  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="vendor/jquery/jquery-3.6.0.min.js"></script>
  <!--<script href="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
  <?php
    Success_index();
    ScriptLogin_index();  
    ScriptSignUp_index();
    ScriptLogOut_index();
    ScriptDontBookTable_index();
    ScriptBookTable_index();
  ?>
 </body>
</html>