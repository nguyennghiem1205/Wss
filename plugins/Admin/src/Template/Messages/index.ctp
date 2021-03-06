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
                <?= __('Messages')?>
            </span>
        </h1>
    </div>
</div>

<div class="row">
    <!-- NEW WIDGET START -->
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-deletebutton="false" data-widget-editbutton="true">
            <header>
                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                <h2><?= __('List of Messages')?></h2>
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
                            <th width="5%"><?php echo __('ID')?></th>
                            <th><?php echo __('Name')?></th>
                            <th><?php echo __('Email')?></th>
                            <th><?php echo __('Phone')?></th>
                            <th><?php echo __('Content')?></th>
                            <th width="13%"><?php echo __('action') ?></th>
                        </tr>
                        <tr>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('ID') ?>" />
                            </th>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Name') ?>" />
                            </th>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Email') ?>" />
                            </th>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Phone') ?>" />
                            </th>
                            <th class="hasinput" style="width:40%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Content') ?>" />
                            </th>
                            <th class="hasinput" ></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($messages->toArray() as $message): ?>
                            <tr>
                                <td><?= $message->id ?></td>
                                <td><?= $message['name'] ?></td>
                                <td><?= $message['email'] ?></td>
                                <td><?= $message['phone'] ?></td>
                                <td><?= $message['content'] ?></td>
                                <td>
                                    <?php echo $this->element('link_action',['item'=>$message,'model'=>'Messages','view'=>0,'edit'=>0]) ?>
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
