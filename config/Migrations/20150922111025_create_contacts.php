<?php
use Migrations\AbstractMigration;

class CreateContacts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('contacts');
        $table
            ->addColumn('title', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('address', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('tel', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('fax', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('email', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('website', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('active', 'integer', ['limit' => 1,'default' => 1]);
        $table->create();
    }
}
