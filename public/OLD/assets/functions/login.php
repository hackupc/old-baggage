<?php
    session_start();
    if(!isset($_POST['submit'])) header('Location: ../../index.php');
    include "config.php";

    global $db_server;
    global $db_user;
    global $db_pass;
    global $db_name;
    $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
    $conn->set_charset("utf8");
    if($conn->connect_error){
      die("Connection failed: ".$conn->connect_error);
    }

    $username = htmlspecialchars($_POST['username']);
    $password = MD5(htmlspecialchars($_POST['password']));
    $query = "SELECT COUNT(*)
      FROM hupc_users
      WHERE (username = '".$username."') AND (password = '".$password."');";
    $result = mysqli_query($conn, $query);
    if(mysqli_fetch_array($result)[0]==0){
      echo "<html>
        <head>
          <script type='text/javascript'>
            alert('Invalid username or password, try again.');
            window.location.replace('../../');
            </script>
        </head>
      </html>";
    }
    else{
      $_SESSION['username'] = $username;
      setcookie('username',$username, time()+60);
      header('Location: ../../');
    }
?>
