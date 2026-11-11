<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiveParticipants extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'SERIAL', 'unsigned' => true],
            'dive_id'   => ['type' => 'INTEGER', 'unsigned' => true],
            'user_id'   => ['type' => 'INTEGER', 'unsigned' => true],
            'role'      => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'participant'],
            'created_at'=> ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addForeignKey('dive_id', 'dives', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addUniqueKey(['dive_id', 'user_id']);
        $this->forge->createTable('dive_participants', true);
    }

    public function down()
    {
        $this->forge->dropTable('dive_participants', true);
    }
}
