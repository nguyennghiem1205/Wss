<?php use Cake\Core\Configure; ?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= __('my profile')?>
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
                    <i class="fa fa-edit"></i>
                </span>
                <h2><?= __('change password')?></h2>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($user, ['id' => 'smart-form-register', 'class' => 'smart-form']) ?>

                    <fieldset>
                        <section>
                            <label class="input">
                                <?= $this->Form->input('old_password', ['type' => 'password', 'required' => false, 'placeholder' => __('old password')]); ?>
                                <i class="icon-append fa fa-unlock"></i>
                            </label>
                        </section>
                    </fieldset>

                    <fieldset>
                        <section>
                            <label class="input">
                                <?= $this->Form->input('new_password', ['type' => 'password', 'required' => false, 'placeholder' => __('new password')]); ?>
                                <i class="icon-append fa fa-lock"></i>
                            </label>
                        </section>
                        <section>
                            <label class="input">
                                <?= $this->Form->input('new_password_confirm', ['type' => 'password', 'required' => false, 'placeholder' => __('password confirm')]); ?>
                                <i class="icon-append fa fa-lock"></i>
                            </label>
                        </section>
                    </fieldset>
                    <footer>
                        <?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link('cancel', ['action' => 'profile'], ['class' => 'btn btn-default']) ?>
                    </footer>
                    <?= $this->Form->end() ?>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->
    </article>
</div>