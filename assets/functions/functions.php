<?php
include "assets/functions/config.php";

/*== USERS ==*/
function createUser($usr_id, $usr_name, $usr_surname){
  global $db_server;
  global $db_user;
  global $db_pass;
  global $db_name;
  $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
  $conn->set_charset("utf8");
  if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
  }
  $query = "
  INSERT INTO hupc_users
  VALUES('".$usr_id."', '".$usr_name."', '".$usr_surname."');";
  $result = mysqli_query($conn, $query);
  return $result;
}
function getUserInfo($usr_id){
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
    SELECT usr.name, usr.surname
    FROM hupc_users usr
    WHERE usr.id = '".$usr_id."';";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_array($result);
  return $result;
}

/*== POSITIONS ==*/
function getOcupation($pos_row, $pos_col){
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
    SELECT pos.row, pos.col, pos.id
    FROM hupc_positions pos
    WHERE (pos.row = '".$pos_row."') AND (pos.col = '".$pos_col."');";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_array($result);
  return $result;
}

/*== MISC ==*/
function numToChar($num){
  return chr($num+65);
}
?>
