<?php
use Phinx\Migration\AbstractMigration;

class CreateNews extends AbstractMigration
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
        $table = $this->table('news');
        $table->addColumn('title_eng', 'string', [ 'default' => null,'limit' => 255,'null' => false,])
        ->addColumn('title_jpn', 'string', ['default' => null, 'limit' => 255,'null' => false,])
        ->addColumn('title_vie', 'string', [ 'default' => null, 'limit' => 255,'null' => false,])
        ->addColumn('content_eng', 'text', ['default' => null,'null' => false,])
        ->addColumn('content_jpn', 'text', ['default' => null,'null' => false,])
        ->addColumn('content_vie', 'text', ['default' => null,'null' => false,])
        ->addColumn('image', 'string', ['default' => null,'limit' => 1000,'null' => true, ])
        ->addColumn('file', 'string', ['default' => null,'limit' => 1000,'null' => true, ])
        ->addColumn('category_id', 'string', ['default' => null,'limit' => 255,'null' => false,])
        ->addColumn('featured', 'integer', ['limit' => 1,'default' => 1])
        ->addColumn('active', 'integer', ['limit' => 1,'default' => 1])
        ->addColumn('created', 'datetime', ['default' => null,'null' => false,])
        ->addColumn('modified', 'datetime', ['default' => null,'null' => true,])
        ->addColumn('posted', 'datetime', ['default' => null,'null' => true,])
        ->addColumn('description_eng','string',['limit'=>1000])
        ->addColumn('description_jpn','string',['limit'=>1000])
        ->addColumn('description_vie','string',['limit'=>1000]);
        $table->create();
    }
}
