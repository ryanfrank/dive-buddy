<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateRatings extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'SERIAL', 'unsigned' => true],
            'dive_id'        => ['type' => 'INTEGER', 'unsigned' => true],
            'rated_user_id'  => ['type' => 'INTEGER', 'unsigned' => true],
            'rating_user_id' => ['type' => 'INTEGER', 'unsigned' => true],
            'rating'         => ['type' => 'INTEGER', 'null' => true],
            'comment'        => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->addForeignKey('dive_id', 'dives', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addForeignKey('rated_user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addForeignKey('rating_user_id', 'users', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addUniqueKey(['dive_id', 'rated_user_id', 'rating_user_id']);
        $this->forge->createTable('ratings', true);
    }

    public function down()
    {
        $this->forge->dropTable('ratings', true);
    }
}
