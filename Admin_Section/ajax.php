<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}
if($action == "save_timing"){
	$save = $crud->save_timing();
	if($save)
		echo $save;
}
if($action == "flipp_state_timing"){
	$save = $crud->flipp_timing_state();
	if($save)
		echo $save;
}
if($action == "save_menu"){
	$save = $crud->save_menu();
	if($save)
		echo $save;
}
if($action == "delete_menu"){
	$save = $crud->delete_menu();
	if($save)
		echo $save;
}
if($action == "save_pages"){
	$save = $crud->save_pages();
	if($save)
		echo $save;
}
if($action == "edit_reservations"){
	$save = $crud->edit_reservations();
	if($save)
		echo $save;
}

ob_end_flush();
?>
