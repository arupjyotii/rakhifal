<?php
session_start();
include('admin/config/dbcon.php');

if(isset($_POST['register_btn']))
{
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password == $confirm_password)
    {
        //check Email
        $checkmail = "SELECT email FROM users WHERE email='$email'";
        $checkmail_run = mysqli_query($con, $checkmail);

        if(mysqli_num_rows($checkmail_run) > 0)
        {
            //Already email exists
            $_SESSION['message'] = "Already email exists";
            header("Location: register.php");
            exit(0);
        }
        else
        {
            $user_query = "INSERT INTO users (fname,lname,email,password) VALUES ('$fname','$lname','$email','$password')";
            $user_query_run = mysqli_query($con, $user_query);

            if($user_query_run)
            {
                $_SESSION['message'] = "Registered Successfully!";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "Registration failed!";
                header("Location: register.php");
                exit(0);
            }
        }
    }
    else
    {
        $_SESSION['message'] = "Password and Confirm Password doesn't match";
        header("Location: register.php");
        exit(0);
    }
}
else
{
    header("Location: register.php");
    exit(0);
}

?>