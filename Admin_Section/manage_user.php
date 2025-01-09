<?php 
session_start();
include("DB_Connect.php");
if(isset($_SESSION['login_Admin_ID'])){
	$user = $conn->query("SELECT * FROM Admins where Admin_ID =".$_SESSION['login_Admin_ID']);
	foreach($user->fetch_array() as $k =>$v){
		$meta[$k] = $v;
		}
	}
?>
	

<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="Admin_ID" value="<?php echo isset($meta['Admin_ID']) ? $meta['Admin_ID']: '' ?>">
		<div class="form-group">
			<label for="Administrator_ID">ID</label>
			<input type="number" name="Admin_ID" id="Admin_ID" class="form-control" value="<?php echo isset($meta['Admin_ID']) ? $meta['Admin_ID']: '' ?>" disabled>
		</div>
		<div class="form-group">
			<label for="Administrator_Number">User Name</label>
			<input type="text" name="Admin_number" id="Admin_number" class="form-control" value="<?php echo isset($meta['Admin_number']) ? $meta['Admin_number']: '' ?>">
		</div>
		<div class="form-group">
			<label for="name">Full Name</label>
			<input type="text" name="Admin_fullname" id="Admin_fullname" class="form-control" value="<?php echo isset($meta['Admin_fullname']) ? $meta['Admin_fullname']: '' ?>" required>
		</div>		
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="Admin_email" id="Admin_email" class="form-control" value="<?php echo isset($meta['Admin_email']) ? $meta['Admin_email']: '' ?>" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="Admin_password" id="Admin_password" class="form-control" placeholder="Enter old password or new password if you to change.">
		</div>
		<div class="form-group">
			<label for="Administrator_adrress">Address</label>
			<input type="text" name="Admin_address" id="Admin_address" class="form-control" value="<?php echo isset($meta['Admin_address']) ? $meta['Admin_address']: '' ?>">
		</div> 
		
	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){	
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					if(resp==2)
						$('#msg').html('<div class="alert alert-danger">Make sure to fill all feilds</div>')
					if(resp==3)
						$('#msg').html('<div class="alert alert-danger">Invalid email Address</div>')
					if(resp==4)
						$('#msg').html('<div class="alert alert-danger">Invalid Password</div>')
					if(resp==5)
						$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})

</script>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'update_user') 
	update_user();
?>