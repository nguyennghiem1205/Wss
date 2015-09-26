<div class="breadscrumb">
    <span><?php echo __("language") ?></span>
    <?= $this->Html->image('System.brk_center.png') ?>
    <span><?php echo __("list of the language") ?></span>
</div>

<div id="center">
    <div id="right">
        <?= $this->Flash->render('flash'); ?>
        <div align="right">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active">
                    <?= $this->Html->link(__('local'), ['action' => 'index']); ?>
                </li>
                <li role="presentation">
                    <?= $this->Html->link(__('server'), ['action' => 'server_index']); ?>
                </li>
                <button class="btn btn-info" onclick="location.href='<?php echo $this->Url->build(['action' => 'pull_from_server']); ?>';"><?= __('pull from server')?></button>
                <button class="btn btn-info" onclick="location.href='<?php echo $this->Url->build(['action' => 'push_to_server']); ?>';"><?= __('push to server')?></button>
                <button class="btn btn-success" onclick="location.href='<?php echo $this->Url->build(['action' => 'export']); ?>';"><?= __('export')?></button>
                <button class="btn btn-default" onclick="location.href='<?php echo $this->Url->build(['action' => 'update_new_key']); ?>';"><?= __('generate new key')?></button>
                <button class="btn btn-primary" onclick="location.href='<?php echo $this->Url->build(['action' => 'add']); ?>';"><?= __('new key')?></button>
            </ul>

        </div>

        <div class="height10"></div>
        <table id="tblList" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="25%"><?= __('key') ?></th>
                    <th><?= __('english') ?></th>
                    <th><?= __('vietnamese') ?></th>
                    <th><?= __('japanese') ?></th>
                    <th width="10%" class="actions" style="text-align: center"><?= __('actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($languages) && count($languages) > 0): ?>
                    <?php foreach ($languages as $language): ?>
                        <tr>
                            <td><?= h($language->key) ?></td>
                            <td><?= h($language->eng) ?></td>
                            <td><?= h($language->vie) ?></td>
                            <td><?= h($language->jpn) ?></td>
                            <td width="13%" class="actions" style="text-align: center">
                                <?= $this->Html->link(__('edit'), ['action' => 'add', $language->id]) ?>
                                <?= $this->Form->postLink('| '.__('delete'), ['action' => 'delete', $language->id], ['confirm' => __('are you sure you want to delete # {0}', $language->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="8"><?php echo __('data is empty') ?></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!--right end-->
    <div class="cl"></div>
    <div class="height10"></div>
</div>
<?php
    echo $this->Html->css('//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css');
    echo $this->Html->script('//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js');
    echo $this->Html->script('//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js');
?>
<script>
    $(document).ready(function(){
        $('#tblList').DataTable();
    });
</script>
<style>
    thead th {
        background-color: #929191;
        color: white;
    }
</style>
