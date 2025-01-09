<?php

function Login($un, $pass) {

    // This function is responsible for the login of the customer.

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Customer_username"]) && isset($_POST["Customer_password"])) {

            global $db;
            $un = $_POST["Customer_username"];
            $pass = $_POST["Customer_password"];
            
            try {
                // Prepare a statement to fetch the hashed password for the given username
                $stmt = $db->prepare("SELECT Customer_ID, Customer_password FROM Customers WHERE Customer_username = :username");
                $stmt->execute(array(':username' => $un));
                
                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $customerID = $row['Customer_ID'];
                    $hashedPassword = $row['Customer_password'];

                    // Verify the provided password against the hashed password
                    if (password_verify($pass, $hashedPassword)) {
                        session_start();
                        $_SESSION['Customer_ID'] = $customerID;
                        echo "success";
                    } else {
                        echo "invalidPassword";
                    }
                } else {
                    echo "usernameNotFound";
                }
            } catch (PDOException $e) {
                echo "error";
            }
        } else {
            echo "Username or password not provided.";
        }
    }
}

function SignUp($un, $name, $pass, $nb, $em) {
    
    //  This function is responsible for creating records for new customers in the system.
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Customer_username2"]) && isset($_POST["Customer_fullname"]) && isset($_POST["Customer_password2"]) 
            && isset($_POST["Customer_number"]) && isset($_POST["Customer_email"])) {
    
            global $db;
            $un = $_POST["Customer_username2"];
            $pass = $_POST["Customer_password2"];
            $name = $_POST["Customer_fullname"];
            $nb = $_POST["Customer_number"];
            $em = $_POST["Customer_email"];
    
            try {

                // Check if username already exists
                $stmt = $db->prepare("SELECT Customer_ID FROM Customers WHERE Customer_username = :username");
                $stmt->execute(array(':username' => $un));
                if ($stmt->rowCount() > 0) {
                    echo "usernameExists";
                    return;
                }
    
                // Check if password already exists (unlikely, but checking to stay consistent)
                $stmt = $db->prepare("SELECT Customer_ID FROM Customers WHERE Customer_password = :pass");
                $stmt->execute(array(':pass' => $pass));
                if ($stmt->rowCount() > 0) {
                    echo "passwordExists";
                    return;
                }

                // Check if email already exists
                $stmt = $db->prepare("SELECT Customer_ID FROM Customers WHERE Customer_email = :email");
                $stmt->execute(array(':email' => $em));
                if ($stmt->rowCount() > 0) {
                    echo "emailExists";
                    return;
                }
    
                // Hash the password
                $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
                
                // Insert new customer
                $stmt = $db->prepare("INSERT INTO Customers (Customer_username, Customer_fullname, Customer_password, Customer_number, Customer_email) VALUES (:username, :fullname, :password, :number, :email)");
                $stmt->execute(array(
                    ':username' => $un,
                    ':fullname' => $name,
                    ':password' => $hashedPassword,
                    ':number' => $nb,
                    ':email' => $em
                ));
    
                // Start a session and store the customer ID
                session_start();
                $_SESSION['Customer_ID'] = $db->lastInsertId();
                echo "success";
            } catch (PDOException $e) {
                echo "fail";
            }
        } else {
            echo "Incomplete form data.";
        } 
    }
}



function LogOut(){

    //  This function is responsible for Customers Loging Out.
    
    echo "success";
    session_start();
    if (isset($_SESSION['Customer_ID']))
        unset($_SESSION['Customer_ID']);
    session_destroy();
}


function GetPlats(){
    
    // This function retrieves all platters from the database and it returns them as an array of StdClass representing each platter.
    
    include("../../be/common/dbconfig.php"); 
    
    $Plats = array();
    $query = "SELECT * FROM Platters";
    $stmt = $db->query($query);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $Plat = new stdClass();
            $Plat->ID = $row["Platter_ID"]; 
            $Plat->category = getCategoryById($db, $row["Category_ID"]);
            $Plat->timming = getTimingById($db,$row["Timing_ID"]);
            $Plat->timing_status = getTimingStatusById($db, $row["Timing_ID"]);
            $Plat->Platter = $row["Platter"];
            $Plat->small_description = $row["Platter_small_description"];
            $Plat->price = $row["Platter_price"];
            $Plat->discount = $row["Platter_discount"];
            $Plat->state = $row["Platter_status"];
            $Plat->image = $row["Platter_image"];
            $Plats[] = $Plat;
        }
        return $Plats;
    } else {
        return 0;
    }
} 

function getCategoryById($db, $categoryId) {

    // This function is used in the GetPlats process for the Customers
    // (It is functionality is clear from it is name)

    $stmt = $db->prepare("SELECT Category FROM Categories WHERE Category_ID = :categoryId");
    $stmt->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchColumn(); 

    return $result !== false ? $result : null;
}

function getTimingById($db, $timmingId) {

    // This function is used in the GetPlats process for the Customers
    // (It is functionality is clear from it is name)

    $stmt = $db->prepare("SELECT Timing FROM Timings WHERE Timing_ID = :timingId");
    $stmt->bindParam(':timingId', $timmingId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchColumn(); 

    return $result !== false ? $result : null;

}

function getTimingStatusById($db, $timing_id) {

    // This function is used in the GetPlats process for the Customers
    // (It is functionality is clear from it is name)

    $query = "SELECT Timing_status FROM Timings WHERE Timing_ID = :timing_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':timing_id', $timing_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result['Timing_status'];
    } else {
        return null;
    }
}
function ReserveTable($date, $time, $people, $message) {

    // This function is responsible for checking if customers are able to reserve 
    // Tables in a spescific DateTime, (if limit exceeded they will not be able to),
    // and for reserviing the tables if all attributes from the form are accepted.

    global $db;

    $timeParts = explode('-', $time);
    $startTime = $timeParts[0] . ':00';  

    $reservationDatetime = $date . ' ' . $startTime;

    $checkQuery = "SELECT COUNT(*) FROM Reservation_settings WHERE Reservation_settings = :reservationDatetime";
    $checkStmt = $db->prepare($checkQuery);
    $checkStmt->bindParam(':reservationDatetime', $reservationDatetime);
    $checkStmt->execute();
    $count = $checkStmt->fetchColumn();

    if ($count == 0) {

        $maxReservations = 10;
        $currentReservations = 0;
        $insertQuery = "INSERT INTO Reservation_settings (Reservation_settings, Max_reservations, Current_reservations)
                        VALUES (:reservationDatetime, :maxReservations, :currentReservations)";
        $insertStmt = $db->prepare($insertQuery);
        $insertStmt->bindParam(':reservationDatetime', $reservationDatetime);
        $insertStmt->bindParam(':maxReservations', $maxReservations);
        $insertStmt->bindParam(':currentReservations', $currentReservations);

        $insertStmt->execute();
    }

    $checkAvailabilityQuery = "SELECT Current_reservations, Max_reservations FROM Reservation_settings WHERE Reservation_settings = :reservationDatetime";
    $checkAvailabilityStmt = $db->prepare($checkAvailabilityQuery);
    $checkAvailabilityStmt->bindParam(':reservationDatetime', $reservationDatetime);
    $checkAvailabilityStmt->execute();
    $result = $checkAvailabilityStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['Current_reservations'] >= $result['Max_reservations']) {
        echo "Allreserved";
        return;
    }

    $stmt = $db->query("SELECT Reservation_ID FROM Reservation ORDER BY Reservation_ID DESC LIMIT 1");
    $lastReservationID = $stmt->fetchColumn();

    $reservationID = $lastReservationID ? $lastReservationID + 1 : 1;

    $stmt = $db->prepare("INSERT INTO Reservation (Customer_ID, Reservation_ID, Reservation_settings, People_number, Reservation_message) VALUES (:customerID, :reservationID, :reservationDatetime, :peopleNumber, :reservationMessage)");

    session_start();
    $stmt->bindParam(':customerID', $_SESSION["Customer_ID"]);
    $stmt->bindParam(':reservationID', $reservationID);
    $stmt->bindParam(':reservationDatetime', $reservationDatetime);
    $stmt->bindParam(':peopleNumber', $people);
    $stmt->bindParam(':reservationMessage', $message);

    if ($stmt->execute()) {

        $updateQuery = "UPDATE Reservation_settings
                        SET Current_reservations = Current_reservations + 1
                        WHERE Reservation_settings = :reservationDatetime";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(':reservationDatetime', $reservationDatetime);
        $updateStmt->execute();

        echo "success";  
    }

}



function Contact($name, $number, $email, $subject, $message) {
    
    //  This function inserts the message information of the user into the database.
    
    include("../../be/common/dbconfig.php"); 

    $name = "John Doe";
    $number = "123-456-7890";
    $email = "john.doe@example.com";
    $subject = "Inquiry about Services";
    $message = "I would like to know more about your services. Please contact me.";
    
    // Prepare the SQL statement
    $query = "INSERT INTO contact_us (Contact_fullname, Contact_number, Contact_email, Contact_message, Contact_subject) VALUES (:name, :number, :email, :message, :subject)";
    $stmt = $db->prepare($query);

    // Bind the parameters
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':number', $number);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':subject', $subject);
    

        // Execute the statement
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "fail";
        }
        $stmt->close();
    } else {
        echo "Database error.";
    }
}

