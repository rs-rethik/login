<?php

$user = $_POST['user'];
$fname = $_POST['fname'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$mail = $_POST['mail'];
$dep = $_POST['dep'];

if (!empty($user) || !empty($fname) || !empty($dob) || !empty($dob) || !empty($dob) || !empty($dob))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "project";

$conn = new mysqli ("$host","$dbusername","$dbpassword","$dbname");

if(mysqli_connect_error())
{
    die('Connect Error ('.mysqli_connect_error() .')'. mysqli_connect_error());
}
else{
    $SELECT = "SELECT mail from register where mail = ? Limit 1";
    $INSERT = "INSERT into register (user , fname , dob , gender , mail , dep) values(?,?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $mail);
    $stmt->execute();
    $stmt->bind_result($mail);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if($rnum==0){
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ssssss",$user,$fname,$dob,$gender,$mail,$dep);
        $stmt->execute();
        echo "New record inserted successfully";
    }
    else{
        echo "Some already register using this email";
    }
    $stmt->close();
    $conn->close();
}
}else{
    echo "All are required";
    die();
}
?>