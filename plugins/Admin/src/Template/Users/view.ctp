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
                <?= $this->Html->link(__('list of users'), ['action' => 'index'])?>
            </span>
        </h1>
    </div>
</div>
<div class="row">
    <article class="col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-sortable jarviswidget-color-darken" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false" role="widget" style="">

            <header role="heading">
                <span class="widget-icon">
                    <i class="fa fa-user"></i>
                </span>
                <h2>User View</h2>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">
                    <fieldset>
                        <table id="user" class="table table-bordered table-striped" style="clear: both">
                            <tbody>
                            <tr>
                                <td style="width:35%;"><?= __('avatar') ?></td>
                                <td style="width:65%"><?= $this->Core->image('Users/'.$user->avatar, 100, 100, ['deleteUrl' => ['controller' => 'users', 'action' =>  'deleteImage']], true) ?></td>
                            </tr>
                            <tr>
                                <td style="width:35%;"><?= __('email') ?></td>
                                <td style="width:65%"><?= h($user->email) ?></td>
                            </tr>
                            <tr>
                                <td style="width:35%;"><?= __('name') ?></td>
                                <td style="width:65%"><?= h($user->first_name.' '.$user->last_name) ?></td>
                            </tr>
                            <tr>
                                <td style="width:35%;"><?= __('group') ?></td>
                                <td style="width:65%"><?= h(Configure::read('Core.Users.group')[$user->group]) ?></td>
                            </tr>
                            <tr>
                                <td style="width:35%;"><?= __('status') ?></td>
                                <td style="width:65%"><?= h(Configure::read('Core.System.active')[$user->status]) ?></td>
                            </tr>
                            <tr>
                                <td style="width:35%;"><?= __('created') ?></td>
                                <td style="width:65%"><?= h($user->created) ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </fieldset>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->Html->link(__('cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                                <?= $this->Html->link(__('edit'), ['action' => 'add', $user->id], ['class' => 'btn btn-primary']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->
    </article>
</div>