<?php use \Cake\Core\Configure; ?>
<?php $curTempID = (isset($this->request->params['pass'][0])) ? $this->request->params['pass'][0]:null; ?>

<div class="breadscrumb">
    <span><?= __("system") ?></span>
    <?= $this->Html->image('System.brk_center.png') ?>
    <span><?= __("email template management") ?></span>
</div>

<div id="center">
    <div id="left">
        <div class="left_top"><?= __('template') ?></div>
        <div class="content_left hw-tab-link">
            <ul>
                <?php 
                    $listTemplate = Configure::read('Core.EmailTemplates');
                    foreach($listTemplate as $id => $name): ?>
                    <li <?php if($curTempID == $id) echo 'class="active"'; ?> ><?= $this->Html->image('System.icon_menu_left.png'); ?> <?= $this->Html->link($name,['action'=>'index',$id]); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
    <div id="right_notfull">
        <?= $this->Flash->render('flash'); ?>
        
        <?= $this->Form->create($emailTemplate) ?>
        <table width="100%" class="tblForm">
            <tr>
                <th style="text-align: left;"><?php echo __('manage email template') ?></th>
            </tr>
            <tr>
                <td><?= $this->Form->input('subject',['size'=>100,'label'=>false,'placeholder'=>__('subject')]); ?></td>
            </tr>
            <tr>
                <td><?= $this->Form->input('content',['label'=>false,'class'=>'hw-mce-advance']); ?></td>
            </tr>
            <tr>
                <td><?= $this->Form->button(__('submit'),['class'=>'btn_small_blue']) ?></td>
            </tr>
        </table>
        <?= $this->Form->end() ?>
        
    </div>
    <!--right end-->
    <div class="cl"></div>
    <div class="height10"></div>
</div>