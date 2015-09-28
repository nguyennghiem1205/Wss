<?php
use Phinx\Migration\AbstractMigration;
use Cake\ORM\TableRegistry;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $users = $this->table('users');
        $users->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('facebook_id', 'string', ['null' => true, 'default' => null])
            ->addColumn('first_name', 'string', ['null' => true, 'default' => null])
            ->addColumn('last_name', 'string', ['null' => true, 'default' => null])
            ->addColumn('avatar', 'string', ['null' => true, 'default' => null])
            ->addColumn('smart_admin_themes', 'string', ['null' => true, 'default' => 'smart-style-0'])
            ->addColumn('auth_token', 'string', ['null' => true, 'default' => null])
            ->addColumn('extra_token', 'string', ['null' => true, 'default' => null])
            ->addColumn('group', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('status', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->save();
        
        /* ---------- Insert default admin data  { ---------- */
        $tblUser = TableRegistry::get('Users');
        $user = $tblUser->newEntity();
        $user->email = 'admin@hiworld.com.vn';
        $user->password = '12345678';
        $user->first_name = 'Hiworld';
        $user->last_name = 'Admin';
        $tblUser->save($user);
        /* ---------- Insert default admin data  } ---------- */
        
        $user_auths = $this->table('user_auths');
        $user_auths->addColumn('group', 'integer', ['limit' => 1,'default' => 1])            
            ->addColumn('plugin', 'string', ['null' => true, 'default' => null])
            ->addColumn('controller', 'string')
            ->addColumn('action', 'string')
            ->save();
        
        $email_stacks = $this->table('email_stacks');
        $email_stacks->addColumn('email', 'string')
            ->addColumn('subject', 'string')
            ->addColumn('content', 'text')
            ->addColumn('sent', 'boolean', ['default' => 0])
            ->addColumn('created', 'datetime')
            ->save();

        $email_templates = $this->table('email_templates');
        $email_templates->addColumn('subject', 'string')
            ->addColumn('content', 'text')
            ->save();

        $menus = $this->table('menus');
        $menus->addColumn('parent_id', 'integer', ['default' => null])
            ->addColumn('name', 'string', ['null' => true,'default' => null])
            ->addColumn('icon', 'string')
            ->addColumn('group', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('plugin', 'string', ['null' => true, 'default' => null])
            ->addColumn('controller', 'string')
            ->addColumn('action', 'string')
            ->addColumn('param', 'string')
            ->addColumn('display', 'boolean', ['default' => 1])
            ->addColumn('display_order', 'integer')
            ->save();
        
        $pages = $this->table('pages');
        $pages->addColumn('code', 'string')
            ->addColumn('title', 'string')
            ->addColumn('content', 'text')
            ->save();

        $categories = $this->table('categories');
        $categories
            ->addColumn('parent_id','integer')
            ->addColumn('lft','integer')
            ->addColumn('rght','integer')
            ->addColumn('title_eng','string')
            ->addColumn('title_jpn','string')
            ->addColumn('title_vie','string')
            ->addColumn('content_eng','text')
            ->addColumn('content_jpn','text')
            ->addColumn('content_vie','text')
            ->addColumn('description_eng','string',['limit'=>1000])
            ->addColumn('description_jpn','string',['limit'=>1000])
            ->addColumn('description_vie','string',['limit'=>1000])
            ->addColumn('image', 'string', ['default' => null,'limit' => 255,'null' => true, ])
            ->addColumn('active', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('home', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('service', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->save();

        $categories = $this->table('ceo_info');
        $categories
            ->addColumn('name','string',['limit'=>1000])
            ->addColumn('position_jpn','string',['limit'=>1000])
            ->addColumn('position_vie','string',['limit'=>1000])
            ->addColumn('position_eng','string',['limit'=>1000])
            ->addColumn('comment_eng','string',['limit'=>1000])
            ->addColumn('comment_jpn','string',['limit'=>1000])
            ->addColumn('comment_vie','string',['limit'=>1000])
            ->addColumn('image', 'string', ['default' => null,'limit' => 255,'null' => true, ])
            ->addColumn('link', 'string', ['default' => null,'limit' => 255,'null' => true, ])
            ->addColumn('active', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('type', 'integer', ['limit' => 1])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->save();

        $frontend_menus = $this->table('frontend_menus');
        $frontend_menus
            ->addColumn('parent_id','integer')
            ->addColumn('lft','integer')
            ->addColumn('rght','integer')
            ->addColumn('level','integer')
            ->addColumn('name_eng','string')
            ->addColumn('name_jpn','string')
            ->addColumn('name_vie','string')
            ->addColumn('description_eng','string')
            ->addColumn('description_jpn','string')
            ->addColumn('description_vie','string')
            ->addColumn('link','text')
            ->addColumn('active', 'integer', ['limit' => 1,'default' => 1])
            ->addColumn('position', 'integer')
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime', ['null' => true, 'default' => null])
            ->save();
    }

    public function down()
    {
        $this->dropTable('users');
        $this->dropTable('user_auths');
        $this->dropTable('email_stacks');
        $this->dropTable('email_templates');
        $this->dropTable('menus');
        $this->dropTable('categories');
        $this->dropTable('news');
        $this->dropTable('slides');
        $this->dropTable('sites');
        $this->dropTable('recruits');
        $this->dropTable('contacts');
        $this->dropTable('settings');
    }
}