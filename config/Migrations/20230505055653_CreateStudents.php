<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateStudents extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('students');
        $table->addColumn('firstName', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('lastName', 'string', [
            'default' => null,
            'limit' => 60,
            'null' => false,
        ]);
        $table->addColumn('phone', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 120,
            'null' => false,
        ]);
        $table->addColumn('dob', 'date', [
            'default' => null,
            'null' => false,
        ]);
        $table->addTimestamps();
       
        $table->create();
    }
}
