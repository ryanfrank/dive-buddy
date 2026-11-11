<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateDiveSites extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'SERIAL', 'unsigned' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'location'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'country'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'latitude'      => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude'     => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'max_depth'     => ['type' => 'INTEGER', 'null' => true],
            'difficulty'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'water_type'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'best_season'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'    => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at'    => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->createTable('dive_sites', true);
    }

    public function down()
    {
        $this->forge->dropTable('dive_sites', true);
    }
}
