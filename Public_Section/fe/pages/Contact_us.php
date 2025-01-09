<!DOCTYPE html>
<html lang="en">

  <head>
    <?php
      require_once("common/header.php");
      require_once("../controllers/UserController.php");
      require_once("../views/UserViews.php");
      $pageDetails = getPageDetails($pageId);

      $pageTitle = $pageDetails['pageTitle'];
      $pageState = $pageDetails['pageState'];
      
      htmlspecialchars($pageState);
      if($pageState == "Inactive")
        header("Location: fe/pages/none.php");

      $bodySections = getBodySections($pageId);
    ?>

    <title><?php echo $pageTitle ; ?></title>

  </head>

  <body>



  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>Contact Us</h3>
          <span class="breadcrumb"><a href="#">Home</a>  >  Contact Us</span>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 align-self-center">
          <div class="left-text">
            <div class="section-heading">
              <h6>Contact Us</h6>
              <h2>Say Hello!</h2>
            </div>
              <?php echo $bodySections[0];?>
              <ul>
              <li><span>Address</span> <?php echo $bodySections[1];?></li>
              <li><span>Phone</span> <?php echo $bodySections[2];?></li>
              <li><span>Email</span> <?php echo $bodySections[3];?></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="right-content">
            <div class="row">
              <div class="col-lg-12">
                <div id="map">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth" width="100%" height="325px" frameborder="0" style="border:0; border-radius: 23px;" allowfullscreen=""></iframe>
                </div>
              </div>
            <?php
              Contact_Us();
            ?>
          </div>
      </div>
    </div>
  </div> 
      <?php
        require_once("common/footer.php");
        ScriptContactUs();
      ?> 
  </body>
</html>