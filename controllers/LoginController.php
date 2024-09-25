<?php
class LoginController
{
    public function index()
    {
        // Include the home view
        include 'views/login.php';
    }

    public function CheckLogin()
    {
        $servername = 'localhost';
        $username = 'u545061311_music';
        $password = '>5itXwJt';
        $dbname = 'u545061311_music';

        // Create connection
        // $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection

        /*
         * if ($conn->connect_error) {
         *     die("Connection failed: " . $conn->connect_error);
         *
         * }
         */
        // variable pendefinisian kredensial
        $usernamelogin = 'admin';
        $passwordlogin = 'admin';

        // memulai session
        session_start();

        // mengambil isian dari form login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // pengecekan kredensial login
        if ($username == $usernamelogin && $password == $passwordlogin || $username == 'android' && $password == 'jangkrikhitam') {
            session_start();
            $_SESSION['username'] = $username;
            $ip_address = $_SERVER['REMOTE_ADDR'];

            /*
             * disable database
             *  // Insert login history to database
             *      $sql = "INSERT INTO login_history (username, login_time,ip_address) VALUES ('$username', NOW(),'$ip_address')";
             *      if ($conn->query($sql) === TRUE) {
             *          header("Location: app.php");
             *      } else {
             *          echo "Error: " . $sql . "<br>" . $conn->error;
             *      }
             */
            header('Location: /');
        } else {
            header('Location: /login');
        }
    }
    public function logout()
    {
        session_start();
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        header('Location:/login');
    }
}
?>
