<?php
use Cake\Core\Configure;

$this->Html->addCrumb(__('system'));
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= __('News')?>
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <?= $this->Html->link(__('add new'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-editbutton="true">
            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2><?= __('list of news')?></h2>
            </header>

            <!-- widget div-->
            <div>
                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body no-padding">

                    <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th><?php echo __('ID')?></th>
                            <th><?php echo __('Title')?></th>
                            <th><?php echo __('Category')?></th>
                            <th><?php echo __('Featured News')?></th>
                            <th><?php echo __('Posting status')?></th>
                            <th><?php echo __('Status')?></th>
                            <th width="13%"><?php echo __('action') ?></th>
                        </tr>
                        <tr>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('ID') ?>" />
                            </th>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= ('タイトル') ?>" />
                            </th>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= ('Category') ?>" />
                            </th>
                            <th class="hasinput" ></th>
                            <th class="hasinput" ></th>
                            <th class="hasinput" ></th>
                            <th class="hasinput" ></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($news as $row): ?>
                            <tr>
                                <td><?= $row->id ?></td>
                                <td><?= $row['title_'.__('lang')] ?></td>
                                <td><?= $row->category['title_'.__('lang')] ?></td>
                                <td><?= $this->Core->active($row, 'featured')?></td>
                                <td><?php if(strtotime($row['posted']) < strtotime(date("Y-m-d H:i"))){
                                        echo __('Posted');
                                    } else {
                                        echo __('Pending').': '. date("Y-m-d H:i", strtotime($row['posted']));
                                    } ?></td>
                                <td><?= $this->Core->active($row, 'active')?></td>
                                <td>
                                    <?php echo $this->element('link_action', array('item' => $row, 'model'=> 'News')) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </article>
    <!-- WIDGET END -->
</div>
<script>
    $(document).ready(function(){
        $('.onoffswitch-checkbox').click(function(){
            $(this).parents('form').submit();
        })
    })
</script>