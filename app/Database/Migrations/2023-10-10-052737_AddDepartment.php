<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDepartment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('departments');
    }

    public function down()
    {
        $this->forge->dropTable('departments');
    }
}
