<html>
<head>
  <title>HackUPC | Baggage check-in</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <?php include "assets/functions/functions.php" ?>
  <script src="assets/js/form.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/css?family=Ek+Mukta" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
  <div id="background-color"></div>
  <div id="header">
    <a href="" class="logo"><img src="assets/img/logo.png" class="logo"/></a>
    <a href="" class="title"><h3 class="title">Baggage check-in</h3></a>
  </div>
  <div id="main-wrap">
    <div id="user-wrap">
      <div class="user-tab">
        <button class="user-tabs active" onclick="openTab(event, 'user-checkin')">Check-in</button>
        <button class="user-tabs" onclick="openTab(event, 'user-list')">List</button>
        <button class="user-tabs" onclick="openTab(event, 'user-history')">History</button>
        <button class="tabs-last user-tabs" onclick="openTab(event, 'user-search')">Search</button>
        <!--<?php
          if(isset($_GET['rem_row'])&&isset($_GET['rem_col'])){
            ?>
              <button class="user-tabs" onclick="openTab(event, 'user-details')">Details</button>
            <?php
          }
          if(isset($_GET['rem_id'])){
            ?>
              <button class="user-tabs" onclick="openTab(event, 'user-details')">User</button>
            <?php
          }
        ?>-->
      </div>
      <div id="user-checkin" class="user-content" <?php if(!((isset($_GET['rem_row'])&&isset($_GET['rem_col']))||isset($_GET['rem_id']))){ echo 'style="opacity: 1; height: inherit;"'; } ?>>
        <form method="post" id="reg_form" action="" onsubmit="return verifyForm();">
          <div>
            <h2>Baggage check-in</h2>
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
          <h2>Baggage list</h2>
        </div>
        <?php
          $users = getBaggages();
          foreach($users as $user){
            ?><a href="<?php echo '?rem_row='.$user["row"].'&rem_col='.$user["col"]; ?>"><?php echo $user["row"].$user["col"]; ?></a><?php
            echo ' ';
            ?><a href="<?php echo '?rem_id='.$user["id"]; ?>"><?php echo $user["id"]; ?></a><?php
            echo ' '.$user["name"].' ';
            echo $user["surname"].' ';
            echo $user["created"].'</br>';
          }
        ?>
      </div>
      <div id="user-history" class="user-content">
        <div>
          <h2>Baggage history</h2>
        </div>
        <?php
          $users = getHistory();
          foreach($users as $user){
            ?><a href="<?php echo '?rem_row='.$user["row"].'&rem_col='.$user["col"].'&rem_time='.$user["created"]; ?>"><?php echo $user["row"].$user["col"]; ?></a><?php
            echo ' ';
            ?><a href="<?php echo '?rem_id='.$user["id"]; ?>"><?php echo $user["id"]; ?></a><?php
            echo ' '.$user["name"].' ';
            echo $user["surname"].' ';
            echo $user["deleted"].'</br>';
          }
        ?>
      </div>
      <div id="user-search" class="user-content">
        <form method="post" id="sea_form" action="" onsubmit="return verifySearch();">
          <div>
            <h2>User search</h2>
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
            <div id="user-user" class="user-content" style="display: block;">
              <div>
                <h2>Baggage details</h2>
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
                echo $details_row.$details_col.'</br>';
                ?><a href="<?php echo '?rem_id='.$details["id"]; ?>"><?php echo $details["id"]; ?></a><?php
                echo ' '.$details["name"].' ';
                echo $details["surname"].'</br>';
                echo $details["created"].'</br>';
                if(isset($_GET['rem_time'])){
                  echo $details["deleted"];
                }
                echo '</br>';
                ?>
                  <a href="<?php echo 'assets/functions/remove_old.php?rem_row='.$_GET['rem_row'].'&rem_col='.$_GET['rem_col']; ?>">Remove baggage</a>
                <?php
              ?>
            </div>
          <?php
        }
        if(isset($_GET['rem_id'])){
          ?>
            <div id="user-details" class="user-content" style="display: block;">
              <div>
                <h2>User history</h2>
              </div>
              <?php
                $details_id = $_GET['rem_id'];
                $details = getUserBaggages($details_id);
                if(sizeof($details)>0){
                  echo $details[0]["id"].' ';
                  echo $details[0]["name"].' ';
                  echo $details[0]["surname"].'</br></br>';
                  foreach($details as $detail){
                    ?><a href="<?php echo '?rem_row='.$detail["row"].'&rem_col='.$detail["col"].'&rem_time='.$detail["created"]; ?>"><?php echo $detail["row"].$detail["col"]; ?></a><?php
                    echo ' '.$detail["created"].'</br></br>';
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
                  ?><td id="<?php echo 'hupc-pos_'.$ini_row.'-'.$ini_col; ?>" style="background-color: #db4646;"><?php
                    ?><a href="<?php echo '?rem_row='.numToChar($ini_row).'&rem_col='.$ini_col; ?>"><?php echo numToChar($ini_row).$ini_col; ?></a><?php
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
              <h4>Special baggages</h4>
              <?php
                foreach($details as $detail){
                  ?><a href="<?php echo '?rem_row='.$detail["row"].'&rem_col='.$detail["col"]; ?>"><?php echo $detail["row"].$detail["col"]; ?></a><?php
                  echo ' '.$detail["created"].'</br>';
                }
              ?>
            </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
<script>
  function openTab(evt, tabName){
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("user-content");
    for(i=0; i<tabcontent.length; i++){
      tabcontent[i].style.opacity = "0";
      tabcontent[i].style.height = "0";
    }
    tablinks = document.getElementsByClassName("user-tabs");
    for(i=0; i<tablinks.length; i++){
      tablinks[i].classList.remove("active");
    }
    document.getElementById(tabName).style.opacity = "1";
    document.getElementById(tabName).style.height = "inherit";
    evt.currentTarget.classList.add("active");
    window.history.pushState("object or string", "Title", location.protocol+"//"+location.host+location.pathname);
  }
</script>
