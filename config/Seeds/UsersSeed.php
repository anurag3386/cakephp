<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'email' => 'admin@admin.com',
                'password' => 'admin@123',
                'role' => 'admin',
                'created' => date("c"),
                'modified' => date("c"),
            ],
            
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}