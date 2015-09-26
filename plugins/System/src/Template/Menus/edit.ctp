<div class="breadscrumb">
    <span><?php echo __('system') ?></span>
    <?= $this->Html->image('System.brk_center.png') ?>
    <span><?=  $this->Html->link(__('list of the menus'), array('action'=>'index', $menu->group)); ?></span> >
    <span><?= __('menu edit') ?></span>
</div>

<div id="center">
    <div id="right">
        <?php
        $this->loadHelper('Form', [
            'templates' => 'System.app_form',
        ]);
        ?>
        <?= $this->Form->create($menu) ?>
        <table width="100%" class="tblForm">
            <tr>
                <th width="30%"><?php echo __('parent') ?></th>
                <td width="70%"><?php echo $this->Form->select('parent_id', $parents, ['empty' => '--Select parent--']); ?></td>
            </tr>
            <tr>
                <th><?php echo __('name') ?></th>
                <td><?php echo $this->Form->input('name'); ?></td>
            </tr>
            <tr>
                <th><?php echo __('icon') ?></th>
                <td>
                    <div class="input-group">
                        <input class="form-control icp icp-auto" name="icon" value="<?= $menu->icon?>" type="text" />
                        <span class="input-group-addon"></span>
                    </div>
                </td>
            </tr>
            <tr>
                <th><?php echo __('plugin') ?></th>
                <td><?php echo $this->Form->select('plugin', $listPlugin, ['empty' => '--- '.__('select plugin').' ---']); ?></td>
            </tr>
            <tr>
                <th><?php echo __('controller') ?></th>
                <td><?php echo $this->Form->input('controller'); ?></td>
            </tr>
            <tr>
                <th><?php echo __('action') ?></th>
                <td><?php echo $this->Form->input('action'); ?></td>
            </tr>
            <tr>
                <th><?php echo __('display') ?></th>
                <td><?php echo $this->Form->checkbox('display',array('label'=>false, 'required'=>false)); ?></td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <button type="submit" class="btn_small_blue"><?php echo __('save') ?></button>
                    <button type = "button" class="btn_small_blue" onclick="location.href='<?php echo $this->Url->build(['action' => 'index', $menu->group]); ?>';"><?php echo __('back') ?></button>
                </td>
            </tr>
        </table>
        <?php echo $this->Form->end(); ?>

    </div>
    <!--right end-->

    <div class="cl"></div>
    <div class="height10"></div>
</div>
<script>
    $(function() {
        $('.icp-auto').iconpicker();
    });
</script>
