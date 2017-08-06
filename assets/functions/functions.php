<?php
include "assets/functions/config.php";

/*== USERS ==*/
/*function createUser($usr_id, $usr_name, $usr_surname){
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
}*/
function getBaggages(){
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
    SELECT pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description
    FROM hupc_positions pos
    WHERE pos.deleted IS NULL;";
  $users = array();
  if($users2 = $conn->query($query)){
    while($row = $users2->fetch_assoc()){
      $users[] = $row;
    }
    $users2->free();
  }
  $conn->close();
  return $users;
}
function getHistory(){
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
    SELECT pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description, pos.deleted
    FROM hupc_positions pos
    WHERE pos.deleted IS NOT NULL
    ORDER BY pos.deleted DESC;";
  $users = array();
  if($users2 = $conn->query($query)){
    while($row = $users2->fetch_assoc()){
      $users[] = $row;
    }
    $users2->free();
  }
  $conn->close();
  return $users;
}
function getInfo($pos_row, $pos_col){
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
    SELECT pos.row, pos.col, pos.id, pos.name, pos.surname, pos.created, pos.description
    FROM hupc_positions pos
    WHERE (pos.row = '".$pos_row."') AND (pos.col = '".$pos_col."') AND (pos.deleted IS NULL);";
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
    WHERE (pos.row = '".$pos_row."') AND (pos.col = '".$pos_col."') AND (pos.deleted IS NULL);";
  $result = mysqli_query($conn, $query);
  $result = mysqli_fetch_array($result);
  return $result;
}
function getPlace(){
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
    SELECT pos.row, pos.col
    FROM hupc_positions pos
    WHERE (pos.row = '".$pos_row."') AND (pos.col = '".$pos_col."') AND (pos.deleted IS NULL);";
  $places = array();
  if($places2 = $conn->query($query)){
    while($row = $places2->fetch_assoc()){
      $places[] = $row;
    }
    $places2->free();
  }
  $conn->close();

  global $rows;
  global $cols;
  $rows_i = 0;
  $cols_i = 0;
  $places_org = array();
  while($rows_i<$rows){
    while($cols_i<$cols){
      $places[] = array("row"=>$rows_i, "col"=>$cols_i);
      $cols_i++;
    }
    $rows_i++;
  }
  $founded=false;
  $def_row=NULL;
  $def_col=NULL;
  $size_org=count($places_org);
  $pos=0;
  $pos_org=0;
  while((!$founded)&&($pos_org<$size_org)){
    if(($places_org[$pos_org]["row"]==$places[$pos]["row"])&&($places_org[$pos_org]["col"]==$places[$pos]["col"])){
      $pos++;
    }
    else{
      $founded = true;
      $def_row = $places[$pos]["row"];
      $def_col = $places[$pos]["col"];
    }
    $pos_org++;
  }
  return array($def_row, $def_col);
}

/*== MISC ==*/
function numToChar($num){
  return chr($num+65);
}
function charToNum($char){
  return ord($num-65);
}
?>
