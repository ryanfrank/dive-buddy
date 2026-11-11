<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'SERIAL', 'unsigned' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'oauth_provider'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'oauth_id'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 100],
            'location'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'bio'               => ['type' => 'TEXT', 'null' => true],
            'certification_level' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'profile_image'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_active'         => ['type' => 'BOOLEAN', 'default' => true],
            'is_admin'          => ['type' => 'BOOLEAN', 'default' => false],
            'email_verified'    => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'        => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'        => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
    }
}
