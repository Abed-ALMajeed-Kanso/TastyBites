<?php
include("DB_Connect.php");

if (isset($_GET['date'])) {
    $date = $_GET['date'];
    // Retrieve reservations for the specified date along with their settings
    $sql = "SELECT r.*, rs.Max_reservations, rs.Current_reservations 
            FROM Reservation r
            JOIN Reservation_settings rs ON r.Reservation_settings = rs.Reservation_settings
            WHERE DATE(r.Reservation_settings) = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();
?>

            
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2>Reservations for <?php echo date("F d, Y", strtotime($date)); ?></h2><br>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Time</th>
                            <th>Customer Name</th>
                            <th>Customer Number</th>
                            <th>Customer Email</th>
                            <th>Number of People</th>
                            <th>Message</th>
                            <th>Current Reservations</th>
                            <th>Max Reservations</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($result->num_rows > 0) {
                                $i = 1;
                                while ($row = $result->fetch_assoc()) {
                                    $customerInfo = getCustomerInfo($conn, $row['Customer_ID']);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo date("H:i:s", strtotime($row['Reservation_settings'])); ?></td> 
                            <td><?php echo htmlspecialchars($customerInfo['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($customerInfo['number']); ?></td>
                            <td><?php echo htmlspecialchars($customerInfo['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['People_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['Reservation_message']); ?></td>
                            <td><?php echo htmlspecialchars($row['Current_reservations']); ?></td>
                            <td><?php echo htmlspecialchars($row['Max_reservations']); ?></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-primary edit_reservations" type="button" 
                                        data-id="<?php echo htmlspecialchars($row['Reservation_settings']); ?>" 
                                        data-name="<?php echo htmlspecialchars($row['Max_reservations']); ?>">Edit
                                </button>
                            </td>
                        </tr>
                        <?php
                                }
                            } else {
                        ?>
                            <tr>
                                <td colspan="8" class="text-center">No reservations for <?php echo date("F d, Y", strtotime($date)); ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div><br><br>

                <?php
                    $stmt->close();
                }

    function getCustomerInfo($conn, $customerID) {
        $sql = "SELECT Customer_fullname, Customer_email, Customer_number FROM Customers WHERE Customer_ID = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $customerID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $customerFullName, $customerEmail, $customerNumber);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            return array('fullname' => $customerFullName, 'email' => $customerEmail, 'number' => $customerNumber);
        } else {
            return null; // or handle error as needed
        }
    }
    ?>

    <div class="container-fluid container-flex">
        <div class="col-lg-12">
            <div class="row justify-content-center">
                <!-- FORM Panel -->
                <div class="col-md-4">
                    <form action="" id="manage-reservations">
                        <div class="card">
                            <div class="card-header">
                                Manage Capacity
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id">
                                <div class="form-group">
                                    <label class="control-label">Maximum Capacity</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12"><div class="col-md-12 text-center">
                                        <button class="btn btn-sm btn-primary col-md-3">Save</button>
                                        <button class="btn btn-sm btn-default col-md-3" type="button" onclick="$('#manage-reservations').get(0).reset()">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><br><br>
    

    <script>

	$('#manage-reservations').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=edit_reservations',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_reservations').click(function(){
		start_load()
		var cat = $('#manage-reservations')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		end_load()
	})
	
    </script>