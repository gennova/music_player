<?php
$servername = "localhost";
$username = "u545061311_music";
$password = ">5itXwJt";
$dbname = "u545061311_music";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 

}
    // variable pendefinisian kredensial
    $usernamelogin = 'onebiliondollar';
    $passwordlogin = 'UmpuKakah2024!@#$';

    // memulai session
    session_start();

    // mengambil isian dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // pengecekan kredensial login
    if ($username == $usernamelogin && $password == $passwordlogin || $username == "android" && $password == "jangkrikhitam") {
        session_start();
        $_SESSION['username'] = $username;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        // Insert login history to database
            $sql = "INSERT INTO login_history (username, login_time,ip_address) VALUES ('$username', NOW(),'$ip_address')";
            if ($conn->query($sql) === TRUE) {
                header("Location: app.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        header("Location: app.php");
    } 
    else {
        header("Location: index.php");
   }
?>