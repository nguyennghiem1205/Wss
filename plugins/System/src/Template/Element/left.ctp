<div id="left">
    <div class="left_top"><?php echo __('account') ?></div>
    <div class="content_left">
        <ul>
            <li><?php echo $this->Html->image('admin/icon_menu_left.png'); ?><?php echo $this->Html->link(__('profile'),array('controller'=>'users','action'=>'profile')); ?></li>
            <li><?php echo $this->Html->image('admin/icon_menu_left.png'); ?><?php echo $this->Html->link(__('change password'),array('controller'=>'users','action'=>'password')); ?></li>
        </ul>
    </div>
</div>