<?php
    session_start();
    if(isset($_COOKIE['username'])) $_SESSION['username'] = $_COOKIE['username'];
?>
<html>
<head>
  <title>HackUPC | Baggage check-in</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <?php include "assets/functions/functions.php" ?>
  <script src="assets/js/form.js" type="text/javascript"></script>
  <script src="assets/js/tabs.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/css?family=Ek+Mukta" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
  <div id="background-color"></div>
  <?php
    $logged_in = isset($_SESSION['username'])?true:false;
    if($logged_in){
      ?>
      <div id="header">
        <a href="" class="logo"><img src="assets/img/logo.png" class="logo"/></a>
        <a href="assets/functions/logout.php" class="title"><h3 class="title">Logout</h3></a>
      </div>
      <div id="main-wrap">
        <div id="user-wrap">
          <div class="user-tab">
            <button class="user-tabs<?php if(!((isset($_GET['rem_row'])&&isset($_GET['rem_col']))||isset($_GET['rem_id']))){ echo ' active'; } ?>" onclick="openTab(event, 'user-checkin')">Check-in</button>
            <button class="user-tabs" onclick="openTab(event, 'user-list')">List</button>
            <button class="user-tabs" onclick="openTab(event, 'user-history')">History</button>
            <button class="tabs-last user-tabs" onclick="openTab(event, 'user-search')">Search</button>
          </div>
          <div id="user-checkin" class="user-content" <?php if(!((isset($_GET['rem_row'])&&isset($_GET['rem_col']))||isset($_GET['rem_id']))){ echo 'style="opacity: 1; height: inherit;"'; } ?>>
            <form method="post" id="reg_form" action="" onsubmit="return verifyForm();">
              <div>
                <h2 class="user-title">Baggage check-in</h2>
              </div>
              <div>
                <input type="text" id="reg_id" name="reg_id" placeholder="ID/Passport">
                <input type="text" id="reg_name" name="reg_name" placeholder="Name">
                <input type="text" id="reg_surname" name="reg_surname" placeholder="Surname">
                <input type="text" id="reg_desc" name="reg_desc" placeholder="Description">
                <input type="checkbox" id="reg_spe" name="reg_spe" value="Special">Special<br>
                <input type="submit" id="reg_submit" name="reg_submit" value="Submit">
              </div>
            </form>
          </div>
          <div id="user-list" class="user-content">
            <div>
              <h2 class="user-title">Baggage list</h2>
            </div>
            <?php
              $users = getBaggages();
              $first = true;
              foreach($users as $user){
                ?>
                  <div class="list" <?php if($first){ echo 'style="padding-top: 0; border-top: 0;"'; } ?>>
                    <div class="list-left">
                      <a href="<?php echo '?rem_row='.$user["row"].'&rem_col='.$user["col"]; ?>"><?php echo $user["row"].$user["col"]; ?></a>
                    <?php
                      echo '<p>'.date("j/Y g:i\h", strtotime($user["created"])).'</p>';
                    ?>
                    </div>
                  <?php
                  ?>
                    <div class="list-right">
                      <a href="<?php echo '?rem_id='.$user["id"]; ?>"><?php echo $user["id"]; ?></a>
                      <?php
                        echo '<p>'.$user["name"].' '.$user["surname"].'</p>';
                      ?>
                    </div>
                  </div>
                <?php
                $first = false;
              }
            ?>
          </div>
          <div id="user-history" class="user-content">
            <div>
              <h2 class="user-title">Baggage history</h2>
            </div>
            <?php
              $users = getHistory();
              $first = true;
              foreach($users as $user){
                ?>
                  <div class="list" <?php if($first){ echo 'style="padding-top: 0; border-top: 0;"'; } ?>>
                    <div class="list-left">
                      <a href="<?php echo '?rem_row='.$user["row"].'&rem_col='.$user["col"].'&rem_time='.$user["created"]; ?>"><?php echo $user["row"].$user["col"]; ?></a>
                      <?php
                        echo '<p>'.date("j g:i\h", strtotime($user["created"])).' - '.date("j g:i\h", strtotime($user["deleted"])).'</p>';
                      ?>
                    </div>
                    <div class="list-right">
                      <a href="<?php echo '?rem_id='.$user["id"]; ?>"><?php echo $user["id"]; ?></a>
                      <?php
                        echo '<p>'.$user["name"].' '.$user["surname"].'</p>';
                      ?>
                    </div>
                  </div>
                <?php
                $first = false;
              }
            ?>
          </div>
          <div id="user-search" class="user-content">
            <form method="post" id="sea_form" action="" onsubmit="return verifySearch();">
              <div>
                <h2 class="user-title">User search</h2>
              </div>
              <div>
                <input type="text" id="sea_id" name="sea_id" placeholder="DNI/Passport">
                <input type="submit" id="sea_submit" name="sea_submit" value="Submit">
              </div>
            </form>
          </div>
          <?php
            if(isset($_GET['rem_row'])&&isset($_GET['rem_col'])){
              ?>
                <div id="user-user" class="user-content" style="opacity: 1; height: inherit;">
                  <div>
                    <h2 class="user-title">Baggage details</h2>
                  </div>
                  <?php
                    $details_row = $_GET['rem_row'];
                    $details_col = $_GET['rem_col'];
                    if(isset($_GET['rem_time'])){
                      $details = getInfo($details_row, $details_col, $_GET['rem_time']);
                    }
                    else{
                      $details = getInfo($details_row, $details_col, NULL);
                    }
                    echo '<h3>'.$details_row.$details_col.'</h3>';
                    ?><p><a href="<?php echo '?rem_id='.$details["id"]; ?>"><?php echo $details["id"]; ?></a><?php
                    echo ': '.$details["name"].' '.$details["surname"].'</p>';
                    echo '<p>'.$details["description"].'</p>';
                    echo '<p>'.date("j/Y g:i\h", strtotime($details["created"]));
                    if(isset($_GET['rem_time'])){
                      echo ' - '.date("j/Y g:i\h", strtotime($details["deleted"]));
                    }
                    echo '</p>';
                    if(!isset($_GET['rem_time'])){
                      ?>
                        <a id="remove-button" href="<?php echo 'assets/functions/remove_old.php?rem_row='.$_GET['rem_row'].'&rem_col='.$_GET['rem_col']; ?>">Remove baggage</a>
                      <?php
                    }
                  ?>
                </div>
              <?php
            }
            if(isset($_GET['rem_id'])){
              ?>
                <div id="user-details" class="user-content" style="opacity: 1; height: inherit;">
                  <div>
                    <h2 class="user-title">User history</h2>
                  </div>
                  <?php
                    $details_id = $_GET['rem_id'];
                    $details = getUserBaggages($details_id);
                    if(sizeof($details)>0){
                      echo '<h3 class="user-title">'.$details[0]["id"].': '.$details[0]["name"].' '.$details[0]["surname"].'</h3>';
                      $first = true;
                      foreach($details as $detail){
                        ?>
                        <div class="list" <?php if($first){ echo 'style="padding-top: 0; border-top: 0;"'; } ?>>
                          <div class="list-left">
                            <a href="<?php echo '?rem_row='.$detail["row"].'&rem_col='.$detail["col"].'&rem_time='.$detail["created"]; ?>"><?php echo $detail["row"].$detail["col"]; ?></a>
                          </div>
                          <div class="list-right">
                            <?php
                              echo '<p>'.date("j g:i\h", strtotime($detail["created"])).' - '.date("j g:i\h", strtotime($detail["deleted"])).'</p>';
                            ?>
                          </div>
                          <?php
                            echo '<p>'.$detail["description"].'</p>';
                          ?>
                        </div>
                        <?php
                        $first = false;
                      }
                    }
                    else{
                      echo "There's no baggage with the ID/Passport provided.";
                    }
                  ?>
                </div>
              <?php
            }
          ?>
        </div>
        <div id="pos-wrap">
        <?php
          global $rows;
          global $cols;
          $ini_row = 0;
          $ini_col = 0;
          $med_col = $cols/2;
        ?>
          <table>
            <?php
              while($ini_row<$rows){
                ?><tr><?php
                  $corridor = false;
                  while($ini_col<$cols){
                    if((!$corridor)&&($ini_col==$med_col)){
                      ?><td class="pos-med" id="<?php echo 'hupc-pos_'.$ini_row.'-corridor'; ?>"><?php
                      ?></td><?php
                      $corridor = true;
                    }
                    else if(getOcupation(numToChar($ini_row), $ini_col)!=NULL){
                      ?><td id="<?php echo 'hupc-pos_'.$ini_row.'-'.$ini_col; ?>" style="background-color: #E71754;"><?php
                        ?><a class="occupied" href="<?php echo '?rem_row='.numToChar($ini_row).'&rem_col='.$ini_col; ?>"><?php echo numToChar($ini_row).$ini_col; ?></a><?php
                      ?></td><?php
                      $ini_col++;
                    }
                    else{
                      ?><td id="<?php echo 'hupc-pos_'.$ini_row.'-'.$ini_col; ?>"><?php
                        echo numToChar($ini_row).$ini_col;
                      ?></td><?php
                      $ini_col++;
                    }
                  }
                ?></tr><?php
                $ini_col = 0;
                $ini_row++;
              }
            ?>
          </table>
          <?php
            $details = getRowBaggages('@');
            if(sizeof($details)){
              ?>
                <div>
                  <h3 class="special-title">Special baggages</h3>
                  <?php
                    $first = true;
                    foreach($details as $detail){
                      if(!$first){
                        echo ', ';
                      }
                      ?><a href="<?php echo '?rem_row='.$detail["row"].'&rem_col='.$detail["col"]; ?>"><?php echo $detail["row"].$detail["col"]; ?></a><?php
                      echo ': '.$detail["id"];
                      $first = false;
                    }
                  ?>
                </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>
      <?php
    }
    else{
      ?>
        <div id="login-wrap">
          <div id="login-form">
            <a href="" class="logo2"><img src="assets/img/logo2.png" class="logo2"/></a>
            <h1 class="user-title centered">Baggage check-in</h1>
            <form class = "login-form" method="post" action="assets/functions/login.php">
              <div>
                <h2 class="user-title">Login</h2>
              </div>
              <div>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Submit" class="submit" name="submit">
              </div>
            </form>
          </div>
        </div>
      <?php
    }
  ?>
</body>
</html>
