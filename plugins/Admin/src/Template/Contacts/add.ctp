<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('list of contacts'), ['action' => 'index'])?>
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
                $titleBox = __('new edit');
                if($contact->isNew()){
                    $titleBox = __('news add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($contact, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>

                        <section>
                            <label for="title" class="label"><?= __('Title') ?></label>
                            <label class="input">
                                <?= $this->Form->input('title', ['required' => false, 'placeholder' => __('title english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="address" class="label"><?= __('Address') ?></label>
                            <label class="input">
                                <?= $this->Form->input('address', ['required' => false, 'placeholder' => __('Address')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="tel" class="label"><?= __('Telephone') ?></label>
                            <label class="input">
                                <?= $this->Form->input('tel', ['required' => false, 'placeholder' => __('Telephone')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="fax" class="label"><?= __('Fax') ?></label>
                            <label class="input">
                                <?= $this->Form->input('fax', ['required' => false, 'placeholder' => __('Fax')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="email" class="label"><?= __('Email') ?></label>
                            <label class="input">
                                <?= $this->Form->input('email', ['required' => false, 'placeholder' => __('Email')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="website" class="label"><?= __('Website') ?></label>
                            <label class="input">
                                <?= $this->Form->input('website', ['required' => false, 'placeholder' => __('Website')]); ?>
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