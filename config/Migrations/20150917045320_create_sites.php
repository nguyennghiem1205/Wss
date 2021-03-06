<?php
use Phinx\Migration\AbstractMigration;

class CreateSites extends AbstractMigration
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
        $table = $this->table('sites');
        $table->addColumn('title_eng', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
            ->addColumn('title_jpn', 'string', ['default' => null, 'limit' => 255,'null' => false,])
            ->addColumn('title_vie', 'string', [ 'default' => null, 'limit' => 255,'null' => false,])
            ->addColumn('content_eng', 'text', ['default' => null,'null' => false,])
            ->addColumn('content_jpn', 'text', ['default' => null,'null' => false,])
            ->addColumn('content_vie', 'text', ['default' => null,'null' => false,])
            ->addColumn('image', 'string', ['default' => null,'limit' => 255,'null' => true, ])
            ->addColumn('category', 'string', ['default' => null,'limit' => 255,'null' => false,])
            ->addColumn('active', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('created', 'datetime', ['default' => null,'null' => false,])
            ->addColumn('modified', 'datetime', ['default' => null,'null' => true,]);
        $table->create();
    }
}
