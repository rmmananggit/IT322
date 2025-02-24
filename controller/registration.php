<?php
include("../dB/config.php");
session_start();

if (isset($_POST["registration"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phonenumber = $_POST["phonenumber"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];

    if($password != $cpassword){
        $_SESSION["message"] = "Password and confirm password does not match";
        $_SESSION["code"] = "error"; 
    }

    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION["message"] = "Email address already exist";
        $_SESSION["code"] = "error";
        header("Location: ../registration.php");
        exit();
    }



    $query = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`) VALUES ('$firstname','$lastname','$email','$password','$phonenumber','$gender','$birthday')";

    if(mysqli_query($conn, $query)){
        $_SESSION["message"] = "Registered Successfuly";
        $_SESSION["code"] = "success";
        header("Location: ../login.php");
        exit();
    }else{
        echo "Error" , mysqli_error($conn);
    }
    mysqli_close($conn);
} 
?>