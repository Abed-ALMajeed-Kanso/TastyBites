<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
		include("DB_Connect.php");
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login() {
		extract($_POST);
		$stmt = $this->db->prepare("SELECT * FROM admins WHERE Admin_email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
	
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$hashedPassword = $row['Admin_password'];
			if (password_verify($password, $hashedPassword)) {
				foreach ($row as $key => $value) {
					$_SESSION['login_'.$key] = $value; 
				}
				return 1; 
			} else {
				return 3; 
			}
		} else {
			return 2; 
		}
	}
	
	
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	

	function update_user() {
		extract($_POST);
		$data = "";
		$id = $_POST['Admin_ID'];
		$number = $_POST['Admin_number'];
		$fullname = $_POST['Admin_fullname'];
		$email = $_POST['Admin_email'];
		$password = $_POST['Admin_password'];
		$address = $_POST['Admin_address'];
	
		if (
			$fullname == "" || $email == "" || $password == "" || $address == "" || $number == ""
		) {
			echo 2; 
			exit;
		}
	
		if (strpos($email, "@") === false || strpos($email, ".") === false) {
			echo 3; 
			exit;
		}
	
		if (strlen($password) < 8 || (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password))) {
			echo 4; 
			exit;
		}
		
		foreach ($_POST as $k => $v) {
			
			if (!in_array($k, array('Admin_ID', 'table')) && !is_numeric($k)) {
				if ($k == 'Admin_password') {
					$v = password_hash($v, PASSWORD_DEFAULT);
				}
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM Admins WHERE Admin_email ='$email' AND Admin_ID != $id")->num_rows;
		if ($check > 0) {
			echo 5; 
			exit;
		}
		else {
			// Perform the database update
			$update_query = $this->db->query("UPDATE Admins SET $data WHERE Admin_ID = $id");
			if ($update_query) {
				echo 1; // Success
				exit;
			} else {
				echo 2; // General error
				exit;
			}
		}
	} 
	
	

	function save_category(){
		extract($_POST);
		$data = " Category = '$name' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO Categories set ".$data);
		}else{
			$save = $this->db->query("UPDATE Categories set ".$data." where Category_ID=".$id);
		}
		if($save)
			return 1;
	}
	function delete_category(){
		extract($_POST);
		$update = $this->db->query("UPDATE Platters SET Category_ID = 1, Platter_status = 0 WHERE Category_ID = ".$id);
		if ($update) {
		$delete = $this->db->query("DELETE FROM Categories WHERE Category_ID = ".$id);
		if ($delete) {
			return 1;
		} else {
			return 0;
		}
		}
	}
	function save_timing() {
		extract($_POST);
		$data = "Timing = '$name'";
		
		if (empty($id)) {
			// Insert new record
			$save = $this->db->query("INSERT INTO Timings (Timing, Timing_status) VALUES ('$name', 1)");
		} else {
			// Update existing record
			$save = $this->db->query("UPDATE Timings SET $data, Timing_status = 1 WHERE Timing_ID = $id");
		}
		
		if ($save)
			return 1;
	}
	
	function flipp_timing_state() {
		extract($_POST);
		$update = $this->db->query("UPDATE Timings SET Timing_status = 1 - Timing_status WHERE Timing_ID = $id");
		if ($update) {
			return 1;
		} else {
			return 0;
		}
	}
	
	function save_menu(){
		extract($_POST);
		$data = " Platter = '$name' ";
		$data .= ", Platter_price = '$price' ";
		$data .= ", Platter_discount = '$discount' ";
		$data .= ", Category_ID = '$category_id' ";
		$data .= ", Timing_ID = '$timing_id' ";
		$data .= ", Platter_small_description = '$description' ";
		if(isset($status) && $status  == 'on')
		$data .= ", Platter_status = 1 ";
			else
		$data .= ", Platter_status = 0 ";

		if($_FILES['img']['tmp_name'] != ''){
					$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
					$move = move_uploaded_file($_FILES['img']['tmp_name'],'../Public_Section/assets/images/platter/'. $fname);
					$data .= ", Platter_image = '$fname' "; 

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO Platters set ".$data);
		}else{
			$save = $this->db->query("UPDATE Platters set ".$data." where Platter_ID=".$id);
		}
		if($save)
			return 1;
	}

	function delete_menu(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM Platters where Platter_ID = ".$id);
		if($delete)
			return 1;
	}

	function edit_reservations() {
		extract($_POST);

		$stmt = $this->db->prepare("UPDATE Reservation_settings SET Max_reservations = ? WHERE Reservation_settings = ?");
		if ($stmt) {
			$stmt->bind_param('is', $name, $id); 
			if ($stmt->execute()) {
				return 1;
			}
		} 
	
	}
	
	function save_pages() {
		extract($_POST);
	
		$stmt1 = $this->db->prepare("UPDATE Pages SET Title = ? WHERE Page_ID = ?");

		if ($stmt1) {
			$stmt1->bind_param('si', $_POST['title'], $_SESSION['Page_ID']);
			$stmt1->execute();
		}

		if ($_POST['state'] === "activate")
			$stmt2 = $this->db->prepare("UPDATE Pages SET Active = 1 WHERE Page_ID = ?");
		else
			$stmt2 = $this->db->prepare("UPDATE Pages SET Active = 0 WHERE Page_ID = ?");

		if ($stmt2) {
			$stmt2->bind_param('i', $_SESSION['Page_ID']);
			$stmt2->execute();
		}
		
		$i = 1;
        while (isset($_POST["summernote$i"])) {
            $newBodySection = $_POST["summernote$i"];
			$stmt3 = $this->db->prepare("UPDATE Pages_Body_Sections SET Body_Section = ? WHERE Page_ID = ? AND Body_Section_ID = ?");
			if ($stmt3) {
				$stmt3->bind_param('sii', $newBodySection, $_SESSION['Page_ID'], $i);
				$stmt3->execute();
			}
			$i++;
		}

		if($stmt1 && $stmt2 && $stmt3)
			return 1;
		
	}
}