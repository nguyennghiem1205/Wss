<?php $this->Html->addCrumb(__('system'), '#', array('class' => 'current'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system') ?> <span> &gt; <?= $this->Html->link(__('settings'), ['action' => 'index']) ?></span>
        </h1>
    </div>
</div>
<div class="row">
    <!-- NEW COL START -->
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                <h2><?= __('update settings') ?></h2>
            </header>
            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?php $this->loadHelper('Form', [
                        'templates' => 'Setting.app_form',
                        'errorClass' => 'state-error'
                    ]); ?>
                    <?= $this->Form->create($setting,['class'=>'smart-form', 'type' => 'file']) ?>
                    <fieldset>
                        <?php foreach ($stConfig as $field => $value):?>
                            <section>
                                <label class="input">
                                    <?php
                                        $type = $value;
                                        switch ($value) {
                                            case SETTING_TYPE_FILE:
                                                $class = 'hw-file';
                                                break;
                                            case SETTING_TYPE_RICHTEXTAREA:
                                                $class = 'hw-mce-advance';
                                                $type = 'textarea';
                                                break;
                                            default:
                                                $class = '';
                                        }
                                    ?>
                                    <?= $this->Form->input($field, ['type' => $type, 'class' => $class, 'required' => false]); ?>
                                </label>
                            </section>
                        <?php endforeach;?>
                    </fieldset>

                    <footer>
                        <button type="submit" class="btn btn-primary"><?= __('submit') ?></button>
                        <button type="button" class="btn btn-default" onclick="window.history.back();"><?= __('back') ?></button>
                    </footer>
                    <?= $this->Form->end() ?>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
    </article>
    <!-- END COL -->
</div>
