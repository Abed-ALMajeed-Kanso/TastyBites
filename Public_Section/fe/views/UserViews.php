<?php
function Success_index(){
    // The success message viewed to the user.
    ?>
    <div id="successText" class="hidden">
        <div id="successTick">
          <i class="fas fa-check-circle"></i>
        </div>
        <p>User Loged In successfuly!</p>
    </div> 
<?php } ?>

<?php
function LogIn_Form_index(){
    // The Login model displayed in from the header.
    ?>
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class = "re"><span class="close">&times;</span></div>
        <h2 class = "cen">Log In Form</h2><br>
        <form id="myForm">
            <input type="hidden" name="action" value="LOGIN">
            <input type="text" class="form-control" name="Customer_username" placeholder="Username" id="Customer_username"><br>
            <input type="password" class="form-control" name="Customer_password" placeholder="Password" id="Customer_password"><br>
            <div class="Error-Message"></div>
            <div class = "cen"><button type="submit" class="button-click">Submit</button></div>
            <br>
            <div type="text">Don't have an Account?<a id = "SignUp" class="models_link">Sign Up</a></div><br>
        </form>
    </div>
</div> 
<?php }?>

<?php    
function SignUp_Form_index(){
    // The Sign Up model displayed from the header.
    ?>
<div id="myModal3" class="modal">
    <div class="modal-content">
        <div class = "re"><span class="close">&times;</span></div>
        <h2 class = "cen">Sign Up Form</h2><br>
        <form id="myForm3">
            <input type="hidden" name="action" value="SIGNUP"> 
            <input type="text" class="form-control" name="Customer_fullname" placeholder="Full Name" id="Customer_fullname"><br>
            <input type="text" class="form-control" name="Customer_username2" placeholder="Username" id="Customer_username2"><br>
            <input type="text" class="form-control" name="Customer_number" placeholder="Number" id="Customer_number"><br>
            <input type="email" class="form-control" name="Customer_email" placeholder="Email" id="Customer_email"><br>
            <input type="password" class="form-control" name="Customer_password2" placeholder="Password" id="Customer_password2"><br>
            <input type="password" class="form-control" name="check_password" placeholder="Confirm Password" id="check_password"><br>
            <div class="Error-Message2"></div>
            <div class = "cen"><button type="submit" class="button-click">Submit</button></div>
            <br>
            <div type="text">Already Have an Account?<a id = "SignIn3" class="models_link">Log In </a></div>
        </form>

    </div>
</div>
<?php }?>

<?php 
function BookTableButton_index(){
    // Book Table button in the index if customer authenticated, 
    // they will be is allowed to book, else they will be directed to log in.
    ?>
    <li><a class="<?php echo isset($_SESSION['Customer_ID']) ? 'redy' : ''; ?>" 
    id="<?php echo isset($_SESSION['Customer_ID']) ? 'Book' : 'DontBook'; ?>">
    Book A Table</a></li>";
<?php } ?>

<?php
function DontBookTable_index(){
    // The model of directing the user to Log in.
    ?>
    <div id="myModal5" class="modal">
      <div class="modal-content">
          <div class="re"><span class="close">&times;</span></div>
          <h2 style="text-align: center;">Sign In First</h2><br>
          <br><div type="text" class="cen">Please Sign In before booking a table. <a id = "SignIn5" class = "models_link ">Log In</a></div><br>
      </div>
    </div>
    <?php
    }
?>

<?php
function BookTable_index(){
    // The model of booking Tables.
    ?>
<div id="myModal7" class="modal">
    <div class="modal-content">
        <div class = "re"><span class="close">&times;</span></div>
        <h2 class = "cen">Book a Table</h2><br><br>
        <form id="myForm7">
            <input type="hidden" name="action" value="BOOK"> 
            <div class="form-group">
                <input type="date" id="appointment_date" name="appointment_date" class="form-control" value="">
            </div>
            <div class="form-group">
                <select id="time_slot" name="time_slot" class="form-control">
                    <option value="">Select a time slot</option>
                    <option value="09:00-10:30">09:00-10:30</option>
                    <option value="10:30-12:00">10:30-12:00</option>
                    <option value="12:00-13:30">12:00-13:30</option>
                    <option value="13:30-15:00">13:30-15:00</option>
                    <option value="15:00-16:30">15:00-16:30</option>
                    <option value="16:30-18:00">16:30-18:00</option>
                </select>
            </div>

            <input type="number" class="form-control" name="People_number" placeholder="Number of people in the table" id="People_number" max="4" min="1"><br>
            <textarea type="email" class="form-control" name="Reservation_message" placeholder="Call us for large reservations" id="Reservation_message"></textarea><br>

            <div class="Error-Message4"></div>
            <div class = "cen"><button type="submit" class="button-click">Book</button></div>
            <br>
        </form>

    </div>
</div>
<?php }?>

<?php
function SignIn_LogOut_index(){
    // The Button of Athuntication in the index (if customer is
    // Authenticated the button will show Log out and the opposite).
    ?>
    <li><a class="redy" id="<?php echo isset($_SESSION['Customer_ID']) ? 'LogOut' : 'SignIn'; ?>">
    <?php echo isset($_SESSION['Customer_ID']) ? 'Log Out' : 'Log In'; ?></a></li>
<?php }?>

<?php
function Contact_Us(){
    // The contact Us form in the contact Us page.
    ?>
        <div class="col-lg-12" >
            <form id="contact-form">
                <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" name="action" value="CONTACT">
                    <fieldset>
                    <input type="text" name="Contact_name" id="Contact_name" placeholder="Your Name...">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset>
                    <input type="text" name="Contact_number" id="Contact_number" placeholder="Your Number...">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset>
                    <input type="email" name="Contact_email" id="Contact_email" pattern="[^ @]*@[^ @]*" placeholder="Your E-mail...">
                    </fieldset>
                </div>
                <div class="col-lg-6">
                    <fieldset>
                    <input type="text" name="Contact_subject" id="Contact_subject" placeholder="Subject...">
                    </fieldset>
                </div>
                <div class="col-lg-12">
                    <fieldset>
                    <textarea type="text" name="Contact_message" id="Contact_message" placeholder="Your Message"></textarea>
                    </fieldset>
                </div>
                <div class="Error-Message3"></div>
                <div class="col-lg-12">
                    <fieldset>
                    <button type="submit" id = "submit-button" class="orange-button">Send Message Now</button> 
                    </fieldset>
                </div>
                </div>
            </form>
            </div>
        </div>
<?php } ?>

<?php
    function getPageDetails($pageId) {
        // Function for retriving page details in each page

        $pageTitle = "";
        $pageState = "";
        if($pageId == 1)
            include("be/common/dbconfig.php");
        else
            include("../../be/common/dbconfig.php");
        $sql = "SELECT * FROM Pages WHERE Page_ID = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pageId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $pageTitle = $result['Title'];
            $pageState = ($result['Active'] == 0 ? "Inactive" : "Activated");
        }

        return array("pageTitle" => $pageTitle, "pageState" => $pageState);
    }

    function getBodySections($pageId) {
        // Function for retriving page text sections (if exists)

        $bodySections = [];
        if($pageId == 1)
            include("be/common/dbconfig.php");
        else
            include("../../be/common/dbconfig.php");
        $sql = "SELECT Body_Section_ID FROM Pages_Body_Sections WHERE Page_ID = ? ORDER BY Body_Section_ID ASC";
        $stmt = $db->prepare($sql);
        $stmt->execute([$pageId]);
        $bodyIds = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($bodyIds as $bodyId) {
            $sqlBody = "SELECT Body_Section FROM Pages_Body_Sections WHERE Page_ID = ? AND Body_Section_ID = ?";
            $stmtBody = $db->prepare($sqlBody);
            $stmtBody->execute([$pageId, $bodyId]);
            $bodySection = $stmtBody->fetchColumn();

            if ($bodySection) {
                $bodySections[] = $bodySection;
            }
        }

        return $bodySections;
    }

?>

<?php
function ListPlats($plats) {
    // Group platters by timings and displaying them in models 
    // once clicked, each with it is own information
    $groupedPlats = [];
    foreach ($plats as $plat) {
        if ($plat->state == "1" && $plat->timing_status == "1") {
            $groupedPlats[$plat->timming][] = $plat;
        }
    }
    ?>
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Our Menu</h2>
                <p>Check our <span>Tasty Menu</span></p>
            </div>
            
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <?php
                $first = true;
                foreach ($groupedPlats as $timming => $platsByTiming) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $first ? 'active show' : ''; ?>" data-bs-toggle="tab" data-bs-target="#menu-<?php echo strtolower($timming); ?>">
                            <h4><?php echo ucfirst($timming); ?></h4>
                        </a>
                    </li>
                    <?php
                    $first = false;
                } ?>
            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                <?php
                $first = true;
                foreach ($groupedPlats as $timming => $platsByTiming) { ?>
                    <div class="tab-pane fade <?php echo $first ? 'active show' : ''; ?>" id="menu-<?php echo strtolower($timming); ?>">
                        <div class="tab-header text-center">
                            <br>
                            <h3><?php echo ucfirst($timming); ?></h3>
                            <p>Menu</p>
                        </div>
                        <div class="row gy-5">
                            <?php
                            foreach ($platsByTiming as $plat) { ?>
                                <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 rac adv">
                                    <div class="item">
                                        <div class="thumb">
                                            <a class="Open_platterModal" data-id="<?php echo $plat->ID; ?>">
                                                <img src="../../assets/images/platter/<?php echo $plat->image;?>" alt="" class="">
                                            </a>
                                            <span class="price Open_platterModal" data-id="<?php echo $plat->ID; ?>">
                                                <em><?php if($plat->discount != 0) { echo "$" . $plat->price; } ?></em>
                                                <?php echo "$" . $plat->price * (1 - $plat->discount); ?>
                                            </span>
                                        </div>
                                        <div class="down-content Open_platterModal" data-id="<?php echo $plat->ID; ?>">
                                            <span class="category"><?php echo $plat->category; ?></span>
                                            <h4><?php echo $plat->Platter; ?></h4>
                                            <!-- Direct to the platter details page -->
                                            <a href="?data-id=<?php echo $plat->ID; ?>" >
                                                <i class="fa fa-shopping-bag"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hidden modal for each platter -->
                                <div id="platterModal_<?php echo $plat->ID; ?>" class="modal">
                                    <div class="modal-content">
                                        <div class="re"><span class="close">&times;</span></div>
                                        <div style="overflow: hidden; display: flex; justify-content: center; align-items: center;">
                                            <img src="../../assets/images/platter/<?php echo $plat->image; ?>" alt="" style="height: 100%; object-fit: contain;">
                                        </div>
                                        <br>
                                        <div style="margin-left: 15%; margin-right: 15%;">
                                            <h2><?php echo $plat->Platter; ?></h2>
                                            <p><?php echo $plat->small_description; ?></p>
                                            <p><strong>Category: </strong><?php echo $plat->category; ?></p>
                                            <p><del><strong>Price: </strong><?php echo "$".$plat->price; ?></del></p>
                                            <p><strong>Price with <?php echo  ($plat->discount*100)."%"; ?> discount: </strong><?php echo "$".$plat->price * (1 - $plat->discount); ?></p>
                                        </div><br>
                                        <div class="cen">
                                            <button id="<?php echo isset($_SESSION['Customer_ID']) ? 'Book3' : 'DontBook3'; ?>" class="button-click">Book a table</button>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                    $first = false;
                } ?>
            </div>
        </div>
    </section>
    <?php
}
?>