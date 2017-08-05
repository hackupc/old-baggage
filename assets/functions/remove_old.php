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
      SELECT pos.id, pos.name, pos.surname, pos.created, pos.description
      FROM hupc_positions pos
      WHERE (pos.row = '".$rem_row."') AND (pos.col = '".$rem_col."');";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_array($result);
    $rem_id = $result['id'];
    $rem_name = $result["name"];
    $rem_surname = $result["surname"];
    $rem_created = $result["created"];
    $rem_desc = $result["description"];
    $query = "
      DELETE FROM hupc_positions
      WHERE (row = '".$rem_row."') AND (col = '".$rem_col."');";
    $result = mysqli_query($conn, $query);
    $query = "
      INSERT INTO hupc_oldpositions
      VALUES('".$rem_row."', '".$rem_col."', '".$rem_id."', '".$rem_name."', '".$rem_surname."', '".$rem_created."', CURRENT_TIMESTAMP, '".$rem_desc."');";
    $result = mysqli_query($conn, $query);
    header('Location: ../../');
?>
