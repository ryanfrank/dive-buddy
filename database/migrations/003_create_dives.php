<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateDives extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'SERIAL', 'unsigned' => true],
            'user_id'      => ['type' => 'INTEGER', 'unsigned' => true],
            'dive_site_id' => ['type' => 'INTEGER', 'unsigned' => true, 'null' => true],
            'dive_date'    => ['type' => 'DATE'],
            'max_depth'    => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'bottom_time'  => ['type' => 'INTEGER', 'null' => true],
            'visibility'   => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'conditions'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'notes'        => ['type' => 'TEXT', 'null' => true],
            'is_public'    => ['type' => 'BOOLEAN', 'default' => true],
            'created_at'   => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'   => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addForeignKey('dive_site_id', 'dive_sites', 'id', 'SET NULL', 'NO ACTION');
        $this->forge->createTable('dives', true);
    }

    public function down()
    {
        $this->forge->dropTable('dives', true);
    }
}
