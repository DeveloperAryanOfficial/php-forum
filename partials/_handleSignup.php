<?php
$showalert = false;
$showerror = false;
include '_DBconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "post") {
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $existsql = "SELECT FROM `signup` where user_email = '$Emal";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
        $showerror = "Email already exist";
    } else {


        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $hashsql = "INSERT INTO `signup` (`Email`, `password`, `date`) VALUES ('$Email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $hashsql);
            if ($result) {
                $showalert = "true";
                header('location: /isecure/index.php?signup=true');
                exit;
            } else {
                $showerror = "Attension ! reconfirm your password";
            }
        }
    }
}
