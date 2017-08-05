<html>
<head>
  <title>HackUPC - Baggage</title>
  <link rel="stylesheet" href="assets/css/main.css">
  <?php include "assets/functions/functions.php" ?>
  <script src="assets/js/form.js" type="text/javascript"></script>
</head>
<body>
  <div id="main-wrap">
    <div id="user-wrap">
      <form method="post" action="" onsubmit="return verifyForm();">
        <div>
          <h2>Create user</h2>
        </div>
        <div>
          <input type="text" id="id" name="id" placeholder="DNI/Passport">
          <input type="text" id="name" name="name" placeholder="Name">
          <input type="text" id="surname" name="surname" placeholder="Surname">
          <input type="submit" id="submit" value="Submit" class="submit" name="submit">
        </div>
      </form>
    </div>
    <div id="pos-wrap">
    <?php
      $rows = 3;
      $cols = 6;
      $ini_row = 0;
      $ini_col = 0;
      $med_col = $cols/2;
    ?>
      <table>
        <?php
          while($ini_row<$rows){
            ?><tr><?php
              while($ini_col<($cols+1)){
                if($ini_col==$med_col){
                  ?><td class="pos-med" id="<?php echo 'hupc-pos_'.$ini_row.'-'.$ini_col; ?>"><?php
                  ?></td><?php
                }
                else{
                  ?><td id="<?php echo 'hupc-pos_'.$ini_row.'-'.$ini_col; ?>" <?php if(getOcupation(numToChar($ini_row), $ini_col)!=NULL){ echo ' style="background-color: #db4646;"'; } ?>><?php
                    echo getOcupation(numToChar($ini_row), $ini_col)["id"];
                  ?></td><?php
                }
                $ini_col++;
              }
            ?></tr><?php
            $ini_col = 0;
            $ini_row++;
          }
        ?>
      </table>
    </div>
  </div>
</body>
</html>
