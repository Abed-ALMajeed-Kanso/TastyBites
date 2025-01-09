<!DOCTYPE html>
<html lang="en">

  <head>  
    <?php
      require_once("common/header.php");
      require_once("../../be/models/UserModel.php");
      require_once("../controllers/UserController.php");
      require_once("../views/UserViews.php")
    ?>
    <title>Our Plates</title>
  </head>

<body>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>OUR PLATES</h3>
          <span class="breadcrumb"><a href="#">Home</a> > Our Plates</span>
        </div>
      </div>
    </div>
  </div>

  <div class="section trending">
    <div class="container">

    <?php  
        ListPlats(GetPlats()); 
    ?> 

    </div>
  </div>

  <?php
    require_once("common/footer.php");
    ScriptViewItem();
  ?>

  </body>
</html>