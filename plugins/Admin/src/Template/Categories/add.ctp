<?php use Cake\Core\Configure; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('list of category'), ['action' => 'index'])?>
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
                $titleBox = __('category edit');
                if($category->isNew()){
                    $titleBox = __('category add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($category, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>
                        <section>
                            <label for="parent_id" class="label"><?= __('Parent') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('parent_id', ['empty' => '--- '.__('Select parent').' ---','0' => __('ROOT'), 'type' => 'select', 'options' => $list , 'required' => false, 'placeholder' => 'Parent']); ?>
                                <i></i>
                            </label>
                        </section>

                        <section>
                            <label for="title-eng" class="label"><?= __('Title English') ?></label>
                            <label class="input">
                                <?= $this->Form->input('title_eng', ['required' => false, 'placeholder' => __('title english')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-jpn" class="label"><?= __('Title Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('title_jpn', ['required' => false, 'placeholder' => __('title japanese')]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="title-vie" class="label"><?= __('Title Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->input('title_vie', ['required' => false, 'placeholder' => __('title vietnamese')]); ?>
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
                            <label for="content-eng" class="label"><?= __('Content English') ?></label>
                            <?= $this->Form->error('content_eng') ?>
                            <label class="input">
                                <?= $this->Form->textarea('content_eng', ['required' => false, 'placeholder' => __('description vietnamese'),'class' => 'hw-mce-advance']); ?>
                            </label>
                        </section>

                        <section>
                            <label for="content-jpn" class="label"><?= __('Content Japanese') ?></label>
                            <?= $this->Form->error('content_jpn') ?>
                            <label class="input">
                                <?= $this->Form->textarea('content_jpn', ['required' => false, 'placeholder' => __('description vietnamese'),'class' => 'hw-mce-advance']); ?>
                            </label>
                        </section>

                        <section>
                            <label for="content-vie" class="label"><?= __('Content Vietnam') ?></label>
                            <?= $this->Form->error('content_vie') ?>
                            <label class="input">
                                <?= $this->Form->textarea('content_vie', ['required' => false, 'placeholder' => __('description vietnamese'),'class' => 'hw-mce-advance']); ?>
                            </label>
                        </section>

                        <section>
                            <label for="image" class="label"><?= __('Image') ?></label>
                            <?= ($category->image) ? $this->Core->image('Categories/'.$category->image, 50, 50) : '' ?>
                            <label class="input">
                                <?= $this->Form->input('image', ['label' => false, 'placeholder' => __('image'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                            <br>
                            <button type="button" class="btn" id="deleteImage">Delete Image</button>
                        </section>

                        <section class="col col-2">
                            <label class="toggle">
                                <?= $this->Form->checkbox('home', ['required' => false, 'placeholder' => __('active')]); ?>
                                <i data-swchon-text="ON" data-swchoff-text="OFF"></i><?= __('Home')?>
                            </label>
                        </section>

                        <div class="clearfix"></div>

                        <section class="col col-2">
                            <label class="toggle">
                                <?= $this->Form->checkbox('service', ['required' => false, 'placeholder' => __('active')]); ?>
                                <i data-swchon-text="ON" data-swchoff-text="OFF"></i><?= __('Service')?>
                            </label>
                        </section>

                        <div class="clearfix"></div>

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
    var baseUrl = "<?= $this->Url->build('/')?>";
    var cID = <?= ($category->id) ? json_decode($category->id) : -1 ?>;
    inputImage = $('#image');
    $("#deleteImage").click(function() {
        if(cID < 0){
            $(".image-thumb-inputfile").fadeOut();
            inputImage.replaceWith(inputImage.val('').clone(true));
        }
        else{
            if (confirm('Do you want to delete this image?')) {
                jQuery.ajax
                ({
                    type: "POST",
                    dataType: 'json',
                    url: baseUrl + 'news/ajaxDeleleCategoryImage',
                    data: 'cid=' + cID,
                    success: function (data) {
                        alert("Delete success!");
                        $(".hw-image").fadeOut();
                        inputImage.replaceWith(inputImage.val('').clone(true));
                    }
                });
                return false;
            }
        }
    });
</script>