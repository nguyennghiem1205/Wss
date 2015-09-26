<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
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
                <h2><?= __('edit profile')?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($user, ['id' => 'smart-form-register', 'class' => 'smart-form','type'=>'file']) ?>

                    <fieldset>
                        <section>
                            <label class="input state-disabled">
                                <?= $this->Form->input('email', ['disabled' => true, 'required' => false, 'placeholder' => __('email')]); ?>
                                <i class="icon-append fa fa-envelope-o"></i>
                            </label>
                        </section>
                    </fieldset>

                    <fieldset>
                        <div class="row">
                            <section class="col col-6">
                                <label class="input">
                                    <?= $this->Form->input('first_name', ['required' => false, 'placeholder' => __('first name')]); ?>
                                </label>
                            </section>
                            <section class="col col-6">
                                <label class="input">
                                    <?= $this->Form->input('last_name', ['required' => false, 'placeholder' => __('last name')]); ?>
                                </label>
                            </section>
                            
                            <section class="col col-12">
                                <?= $this->Core->image('Users/'.$user->avatar, 50, 50, array(), true); ?>
                                <label class="input">
                                    <?= $this->Form->input('avatar', ['label' => false, 'placeholder' => __('avatar'), 'type' => 'file', 'class' => 'hw-file']); ?>
                                </label>
                            </section>
                        </div>
                    </fieldset>
          
                    
                    <footer>
                        <?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link('cancel', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
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