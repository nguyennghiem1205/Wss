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
                <?= __('Slides')?>
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <?= $this->Html->link(__('New Slide'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
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
                <h2><?= __('List of Slides')?></h2>
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
                            <th><?php echo __('Content')?></th>
                            <th><?php echo __('Description')?></th>
                            <th><?php echo __('Image')?></th>
                            <th><?php echo __('status')?></th>
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
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Content') ?>" />
                            </th>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Description') ?>" />
                            </th>
                            <th class="hasinput" ></th>
                            <th class="hasinput" ></th>
                            <th class="hasinput" ></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($slides->toArray() as $slide): ?>
                            <tr>
                                <td><?= $slide->id ?></td>
                                <td><?= $slide['name_'.__('lang')] ?></td>
                                <td><?= $slide['content_'.__('lang')] ?></td>
                                <td><?= $slide['description_'.__('lang')] ?></td>
                                <td><?= $this->Core->image('Slides/'.$slide->image, 200, 200); ?></td>
                                <td><?= $this->Core->active($slide, 'active')?></td>
                                <td>
                                    <?php echo $this->element('link_action',['item'=>$slide,'model'=>'Slides','view'=>1]) ?>
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
