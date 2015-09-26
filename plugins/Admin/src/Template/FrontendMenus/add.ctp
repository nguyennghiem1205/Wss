<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('list of menu'), ['action' => 'index'])?>
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
                $titleBox = __('menu edit');
                if($frontend_menu->isNew()){
                    $titleBox = __('menu add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($frontend_menu, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>
                        <section>
                            <label for="parent_id" class="label"><?= __('Parent') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('parent_id', ['empty' => '--- '.__('Select parent').' ---','0' => __('ROOT'), 'type' => 'select', 'options' => $list_mn , 'required' => false, 'placeholder' => 'Parent']); ?>
                                <i></i>
                            </label>
                        </section>
                        <section>
                            <label for="title-eng" class="label"><?= __('Name English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_eng', ['required' => false, 'placeholder' => __('name english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-jpn" class="label"><?= __('Name Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_jpn', ['required' => false, 'placeholder' => __('name japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-vie" class="label"><?= __('Name Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('name_vie', ['required' => false, 'placeholder' => __('name vietnamese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-eng" class="label"><?= __('Description English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_eng', ['required' => false, 'placeholder' => __('description english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-jpn" class="label"><?= __('Description Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_jpn', ['required' => false, 'placeholder' => __('description japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-vie" class="label"><?= __('Description Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('description_vie', ['required' => false, 'placeholder' => __('description vietnamese')]); ?>
                            </label>
                        </section>
                        <section>
                            <label for="parent_id" class="label"><?= __('Category') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('cate', ['empty' => '--- '.__('Select category').' ---','0' => __('ROOT'), 'type' => 'select', 'options' => $list_cat , 'required' => false,'id'=>'cat', 'placeholder' => 'Select category']); ?>
                                <i></i>
                            </label>
                            <label for="parent_id" class="label"><?= __('Static Page') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('stpage', ['empty' => '--- '.__('Select a static page').' ---','0' => __('0'), 'type' => 'select', 'options' => $sites , 'required' => false, 'id'=>'sp','placeholder' => 'Select category']); ?>
                                <i></i>
                            </label>
                            <label for="parent_id" class="label"><?= __('Other') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('other', ['empty' => '--- '.__('Select a Contact or Recruitment page').' ---','0' => __('0'), 'type' => 'select', 'options' => $others , 'required' => false, 'id'=>'other','placeholder' => 'Select category']); ?>
                                <i></i>
                            </label>
                        </section>

                        <section>
                            <label for="description-vie" class="label"><?= __('Link') ?></label>
                            <label class="input">
                                <?= $this->Form->input('link', ['required' => false,'id'=>'link', 'placeholder' => __('link')]); ?>
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

<script>
    $( "#cat" ).change(function ()
        {
            var str='catid=';
            var str1='&wss$name=';
            $( "#link" ).val(str+$("#cat option:selected").val()+str1+$("#cat option:selected").text());
        }
    );
    $( "#sp" ).change(function ()
        {
            var str='siteid=';
            var str1='&wss$name=';
            $( "#link" ).val(str+$("#sp option:selected").val()+str1+$("#sp option:selected").text());
        }
    );
    $( "#other" ).change(function ()
        {
            $( "#link" ).val($("#other option:selected").val());
        }
    );
</script>