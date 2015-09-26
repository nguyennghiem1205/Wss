<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('List of Slides'), ['action' => 'index'])?>
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
                $titleBox = __('Slide add');
                if($slide->isNew()){
                    $titleBox = __('Slide add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($slide, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>

                        <section>
                            <label for="title-eng" class="label"><?= __('Name English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_eng', ['required' => false, 'placeholder' => __('Name English')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-jpn" class="label"><?= __('Name Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_jpn', ['required' => false, 'placeholder' => __('Name Japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-vie" class="label"><?= __('Name Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_vie', ['required' => false, 'placeholder' => __('Name Vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-eng" class="label"><?= __('Content English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('content_eng', ['required' => false, 'placeholder' => __('Content English')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-jpn" class="label"><?= __('Content Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('content_jpn', ['required' => false, 'placeholder' => __('Content Japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-vie" class="label"><?= __('Content Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('content_vie', ['required' => false, 'placeholder' => __('Content Vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-eng" class="label"><?= __('Description English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_eng', ['required' => false, 'placeholder' => __('Description English')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-jpn" class="label"><?= __('Description Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_jpn', ['required' => false, 'placeholder' => __('Description Japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-vie" class="label"><?= __('Description Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_vie', ['required' => false, 'placeholder' => __('Description Vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="image" class="label"><?= __('Image') ?></label>
                            <?= $this->Core->image('Slides/'.$slide->image, 50, 50); ?>
                            <label class="input">
                                <?= $this->Form->input('image', ['label' => false, 'placeholder' => __('image'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                        </section>

                        <section class="col col-2">
                            <label class="toggle">
                                <?= $this->Form->checkbox('active', ['required' => false, 'placeholder' => __('active')]); ?>
                                <i data-swchon-text="ON" data-swchoff-text="OFF"></i><?= __('Active')?>
                            </label>
                        </section>

                    </fieldset>

                    <?php /* Demo save has many at the same time ?>
                    <h1>List of menus</h1>
                    <div id="hasmany-container">
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="input">
                                        <a href="" class="btn_delete">Delete</a>
                                        <?= $this->Form->input('id', ['required' => false, 'placeholder' => 'id']); ?>
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input">
                                        <?= $this->Form->input('plugin', ['required' => false, 'placeholder' => 'plugin']); ?>
                                    </label>
                                    <label class="toggle">
                                        <?= $this->Form->checkbox('display', ['required' => false]); ?>
                                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="input">
                                        <?= $this->Form->input('controller', ['type' => 'text' , 'required' => false, 'placeholder' => 'controller']); ?>
                                        <i></i>
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="input">
                                        <?= $this->Form->input('action', ['type' => 'text' , 'required' => false, 'placeholder' => 'action']); ?>
                                    </label>
                                </section>
                            </div>
                        </fieldset>
                    </div>
                    <a href="" class = "btn_add">Add more row</a>
                    <?php */ ?>

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