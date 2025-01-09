  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php 
        $fullname = $_SESSION['login_Admin_fullname'];
        $parts = explode(' ', $fullname);
        $initials = '';
        foreach ($parts as $part) {
            $initials .= substr($part, 0, 1);
        }
        echo strtoupper($initials) ?></span>
        <span class="brand-text font-weight-light"><?php echo ucwords($_SESSION['login_Admin_fullname'])?></span>
      </a>
      <div class="dropdown-menu" style="">
        <a class="dropdown-item manage_account" href="javascript:void(0)" data-id="<?php echo ($_SESSION['login_Admin_ID']) ?>">Manage Account</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
      </div>
    </div>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_document nav-view_document">
              <i class="nav-icon fa fa-folder-open"></i>
              <p>
                Services
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
     
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="./index.php?page=Settings" class="nav-link nav-Certificates tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Settings</p>
                </a>
              </li>              
              
              <li class="nav-item">
                <a href="./index.php?page=menu" class="nav-link nav-Certificates tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Menu</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=Booked_tables" class="nav-link nav-Certificates tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Booked Tables</p>
                </a>
              </li>   
              
              <li class="nav-item" style = "display: none;">
                <a href="./index.php?page=Booked_tables_form" class="nav-link nav-Certificates tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Booked Tables Form</p>
                </a>
              </li>  
              
              <li class="nav-item" style = "display: none;">
                <a href= "./index.php?page=Body_Sections" class="nav-link nav-Exams tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Manage Pages Body</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=Manage_Pages" class="nav-link nav-Exams tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Manage Pages</p>
                </a>
              </li>  

            </ul>

          </li>  
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
  		var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		if($('.nav-link.nav-'+page).length > 0){
  			$('.nav-link.nav-'+page).addClass('active')
          console.log($('.nav-link.nav-'+page).hasClass('tree-item'))
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
          $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
      $('.manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
      })
  	})
  </script>