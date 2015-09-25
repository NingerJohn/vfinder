<?php
/**
* 
*/
class Migration_create_pages extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => TRUE,
        'auto_increment' => TRUE
      ),
      'email' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
      'password' => array(
        'type' => 'VARCHAR',
        'constraint' => '128',
      ),
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '100',
      ),
    ));
    $this->dbforge->add_key('id',TRUE);
    $this->dbforge->create_table('pages');
  }

  public function down()
  {
    $this->dbforge->drop_table('pages');
  }

}

/* */