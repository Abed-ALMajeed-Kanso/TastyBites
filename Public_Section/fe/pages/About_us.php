<!DOCTYPE html>
<html lang="en">
  <head>
    
    <?php
      require_once("common/header.php");
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
            <h3>About Us</h3>
            <span class="breadcrumb"><a href="#">Home</a> > About Us</span>
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
              <?php echo $bodySections[0]; ?>
            <?php echo $bodySections[1]; ?>
            <?php echo $bodySections[2]; ?>
            </div>
        </div>
        <div class="col-lg-6">
          <div class="right-image">
              <img src="../../assets/images/chefs-1.jpg" alt="Chef Steve" class="img-fluid rounded" style="max-width: 100%; height: auto;" />
          </div>
    </div>
      
        </div>
        
      </div>
      
    </div>




  <?php
    require_once("common/footer.php");
  ?>

  </body>
</html>

    

    

  