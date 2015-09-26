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
                <?= __('Frontend Menu')?>
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
                <h2><?= __('list of users')?></h2>
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
                            <th><?php echo __('Parent')?></th>
                            <th><?php echo __('Name')?></th>
                            <th><?php echo __('Description')?></th>
                            <th><?php echo __('Status')?></th>
                            <th width="13%"><?php echo __('action') ?></th>
                        </tr>
                        <tr>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('ID') ?>" />
                            </th>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Parent') ?>" />
                            </th>
                            <th class="hasinput">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Name') ?>" />
                            </th>
                            <th class="hasinput" style="width:16%">
                                <input type="text" class="form-control" placeholder="<?= __('filter') ?> <?= __('Description') ?>" />
                            </th>
                            <th class="hasinput"></th>
                            <th class="hasinput" ></th>
                        </tr>
                        </thead>

                        <tbody id="sortable">
                        <?php foreach ($frontend_menu->toArray() as $menu): ?>
                            <tr class='data' data-id="<?= $menu->id ?>">
                                <td><?= $menu['id'] ?></td>
                                <td><?= $this->Form->select('id',$list,['default' => $menu->parent_id,'class' => 'hw-select','disabled' => 'disabled']); ?></td>
                                <td><?= $menu['name_'.__('lang')] ?></td>
                                <td><?= $menu['description_'.__('lang')] ?></td>
                                <td><?= $this->Core->active($menu, 'active')?></td>
                                <td>
                                    <?php echo $this->element('link_action', array('item' => $menu, 'model'=> 'FrontendMenus')) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script>
                        var idRecord = [];
                        var positionRecord = [];
                        $(function() {
                            $( "#sortable" ).sortable({
                                helper: fixWidthHelper,
                                update: function(event, ui){

                                    var i = 1;
                                    $('.data').each(function(){
                                        idRecord[i] = ($(this).data('id'));
                                        i++;
                                    });

                                    jQuery.ajax
                                    ({
                                        type: "POST",
                                        dataType: 'json',
                                        url: BASE_URL + 'admin/frontend_menus/ajax_update_position',
                                        data: 'pid='+JSON.stringify(idRecord)+'&position='+JSON.stringify(positionRecord),
                                        success: function(r){}
                                    });
                                    idRecord = [];
                                }
                            }).disableSelection();
                            function fixWidthHelper(e, ui) {
                                ui.children().each(function() {
                                    $(this).width($(this).width());
                                });
                                return ui;
                            }
                        });
                    </script>
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