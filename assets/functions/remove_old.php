<?php
    include "config.php";

    $rem_row = chr($_GET['rem_row']+65);
    $rem_col = ord($_GET['rem_col'])-48;

    global $db_server;
    global $db_user;
    global $db_pass;
    global $db_name;
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    $conn->set_charset("utf8");
    if($conn->connect_error){
      die("Connection failed: ".$conn->connect_error);
    }
    $query = "
      UPDATE hupc_positions
      SET deleted = CURRENT_TIMESTAMP
      WHERE (row = '".$rem_row."') AND (col = '".$rem_col."') AND (deleted IS NULL);";
    $result = mysqli_query($conn, $query);
    header('Location: ../../');
?>
