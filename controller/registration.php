<?php
session_start();
include("../dB/config.php");

if (isset($_POST["registration"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phonenumber = $_POST["phonenumber"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];

    // Check if password and confirm password match
    if($password != $cpassword){
        $_SESSION['message'] = "Password and confirm password do not match";
        $_SESSION['code'] = "error";
        header("Location: ../registration.php"); // Redirect to registration page
        exit(0); // Stop further execution
    }

    // Check if email already exists
    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['message'] = "Email address already exists";
        $_SESSION['code'] = "error";
        header("Location: ../registration.php");
        exit(0);

    }

    // Insert new user into the database
    $query = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`) 
              VALUES ('$firstname','$lastname','$email','$password','$phonenumber','$gender','$birthday')";

    if(mysqli_query($conn, $query)){
        $_SESSION["message"] = "Registered successfully";
        $_SESSION['code'] = "success";
        header("Location: ../login.php");
        exit(0);
    }else{
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
} 
?>
