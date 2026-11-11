<?php

namespace Config\Migrations;

use CodeIgniter\Database\Migration;

class CreateSiteConfigs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'SERIAL', 'unsigned' => true],
            'config_key'   => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'config_value' => ['type' => 'TEXT', 'null' => true],
            'updated_at'   => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->forge->createTable('site_configs', true);
    }

    public function down()
    {
        $this->forge->dropTable('site_configs', true);
    }
}
