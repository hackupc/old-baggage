<?php

class UsersTableTest extends TestCase{
  //Name of the tested table.
  protected $table = 'hupc_users';

  //Columns of the tested table.
  protected $columns = [
    'username',
    'password'
  ];

  //Verify is the table exisits.
  //@return void
  public function testCheckingForTable(){
    $this->assertTrue(Schema::hasTable($this->table));
  }

  //Verify table's fields.
  //@return void
  public function testCheckingForColumnsInATable(){
    for($i=0; $i<count($this->columns); $i++){
      $this->assertTrue(Schema::hasColumn($this->table, $this->columns[$i]));
    }
  }
}
