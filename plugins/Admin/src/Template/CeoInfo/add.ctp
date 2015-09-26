<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('list of Ceo-Info'), ['action' => 'index'])?>
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
                <?php
                $titleBox = __('Ceo-Info edit');
                if($ceoInfo->isNew()){
                    $titleBox = __('Ceo-Info add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($ceoInfo, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>
                        <section>
                            <label for="name" class="label"><?= __('Name') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name', ['required' => false, 'placeholder' => __('Name')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="position-eng" class="label"><?= __('Position English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('position_eng', ['required' => false, 'placeholder' => __('position english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="position-jpn" class="label"><?= __('Position Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('position_jpn', ['required' => false, 'placeholder' => __('position japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="position-vie" class="label"><?= __('Position Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('position_vie', ['required' => false, 'placeholder' => __('position vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="comment-eng" class="label"><?= __('Comment English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('comment_eng', ['required' => false, 'placeholder' => __('comment english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="comment-jpn" class="label"><?= __('Comment Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('comment_jpn', ['required' => false, 'placeholder' => __('comment japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="comment-vie" class="label"><?= __('Comment Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('comment_vie', ['required' => false, 'placeholder' => __('comment vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="link" class="label"><?= __('Link (For Partnership Image Only)') ?></label>
                            <label class="input">
                                <?= $this->Form->input('link', ['required' => false, 'placeholder' => __('Link')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="image" class="label"><?= __('Image') ?></label>
                            <?= $this->Core->image('ceoInfo/'.$ceoInfo->image, 50, 50); ?>
                            <label class="input">
                                <?= $this->Form->input('image', ['label' => false, 'placeholder' => __('image'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                        </section>

                        <section>
                            <label for="type" class="label"><?= __('Type display') ?></label>
                            <?= $this->Form->error('type') ?>
                            <label class="input">
                                <?= $this->Form->input('type', ['type' => 'select', 'options' => [ 1 => 'Client Section', 2 => 'Partnership Section', 3 => 'Board of Management Section']],['empty'=>'Choose one']); ?>
                            </label>
                        </section>

                        <section class="col col-2">
                            <label class="toggle">
                                <?= $this->Form->checkbox('active', ['required' => false, 'placeholder' => __('active')]); ?>
                                <i data-swchon-text="ON" data-swchoff-text="OFF"></i><?= __('Active')?>
                            </label>
                        </section>

                    </fieldset>

                    <footer>
                        <?= $this->Form->button(__('submit'), ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link(__('cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
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