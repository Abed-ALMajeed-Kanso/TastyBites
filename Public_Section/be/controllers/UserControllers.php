<?php
include("../common/dbconfig.php");
require_once("../models/UserModel.php");


if (isset($_POST["action"])){
    switch ($_POST["action"]){
        
        //    This part of the switch is responsible for transfering the login data to the model for log in.
        
        case "LOGIN":
            if (!isMissingArgsLogin()){
                $un=$_POST["Customer_username"];
                $pass=$_POST["Customer_password"];
                Login($un,$pass);
            }
        break; 
        
        //    This part of the switch is responsible for sending Sign up data to the model for creating account.
        
        case "SIGNUP":
            if (!isMissingArgsSignUp()){
                $un=$_POST["Customer_username2"];
                $name=$_POST["Customer_fullname"];
                $pass=$_POST["Customer_password2"];
                $nb=$_POST["Customer_number"];
                $em=$_POST["Customer_email"];
                SignUp($un, $name, $pass, $nb, $em);
            }
        break;
        
        //    This part of the switch is responsible for sending contact data to the model.
        
        case "CONTACT":
            if (!isMissingArgscontact()){
                $name=trim($_POST["Contact_name"]);
                $number=trim($_POST["Contact_number"]);
                $email=trim($_POST["Contact_email"]);
                $subject=trim($_POST["Contact_subject"]);
                $messsage=trim($_POST["Contact_message"]);
                Contact($name,$number,$email,$subject,$message); 
            }
        break;
        
        //    This part of the switch is responsible for sending booked table data to the model for booking a table.
        
        case "BOOK":
            if (!isMissingArgsBook()){
                $date=$_POST["appointment_date"];
                $time=$_POST["time_slot"];
                $people=$_POST["People_number"];
                $message=$_POST["Reservation_message"];
                ReserveTable($date, $time, $people, $message);
            }
        break;
        
        //     This part of the switch is for logging out.
        
        case "LOGOUT":
                LogOut();
        break;
        }   
    }
function isMissingArgsSignUp(){
    if (!isset($_POST["Customer_username2"]) || !isset($_POST["Customer_fullname"]) || !isset($_POST["Customer_password2"]) 
    || !isset($_POST["Customer_number"]) || !isset($_POST["Customer_email"]))
        return true;
    else
        return false;   
}

function IsSetUser(){
    if (isset($_SESSION['Customer_username']))
        return true;
    else
        return false;
}

function isMissingArgsLogin(){
    if (!isset($_POST["Customer_username"]) || !isset($_POST["Customer_password"]))
        return true;
    else
        return false;   
}

function isMissingArgscontact(){
    if (!isset($_POST["Contact_name"]) || !isset($_POST["Contact_number"]) || !isset($_POST["Contact_email"]) || !isset($_POST["Contact_subject"]) || !isset($_POST["Contact_message"]))
        return true; 
    else
        return false;  
}
function isMissingArgsBook(){
    if (!isset($_POST["appointment_date"]) || !isset($_POST["time_slot"]) || !isset($_POST["People_number"]) || !isset($_POST["Reservation_message"]))
        return true; 
    else
        return false;  
}
?>

