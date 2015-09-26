<?php use Cake\Core\Configure;use Cake\Routing\Router; ?>
<?php $this->Html->addCrumb(__('system'));?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-cog fa-fw "></i>
            <?= __('system');?>
            <span>&gt;
                <?= $this->Html->link(__('list of news'), ['action' => 'index'])?>
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
                if($news->isNew()){
                    $titleBox = __('news add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($news, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>
                        <section>
                            <label for="category_id" class="label"><?= __('Category') ?></label>
                            <label class="select col-6">
                                <?= $this->Form->input('category_id', ['empty' => '--- '.__('Select category').' ---','0' => __('ROOT'), 'type' => 'select', 'options' => $list , 'required' => false, 'placeholder' => 'Category']); ?>
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
                                <?= $this->Form->textarea('description_eng', ['required' => false, 'placeholder' => __('description english'), 'style' => 'width:100%']); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-jpn" class="label"><?= __('Description Japanese') ?></label>
                            <label class="input">
                                <?= $this->Form->textarea('description_jpn', ['required' => false, 'placeholder' => __('description japanese'), 'style' => 'width:100%']); ?>
                            </label>
                        </section>

                        <section>
                            <label for="description-vie" class="label"><?= __('Description Vietnamese') ?></label>
                            <label class="input">
                                <?= $this->Form->textarea('description_vie', ['required' => false, 'placeholder' => __('description vietnamese'), 'style' => 'width:100%']); ?>
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
                            <label for="posted" class="label"><?= __('Set posted time')?></label>
                            <label class="input">
                                <?= $this->Form->input('posted', ['required' => false, 'placeholder' => date("Y-m-d H:i"), 'id' => 'datetimepicker', 'type' => 'text', 'value' => isset($news->posted) ? date("Y-m-d H:i", strtotime($news->posted)) : date("Y-m-d H:i")]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="created" class="label"><?= __('Set created time')?></label>
                            <label class="input">
                                <?= $this->Form->input('created', ['required' => false, 'placeholder' => date("Y-m-d H:i"), 'id' => 'datetimepicker2', 'type' => 'text', 'value' => isset($news->created) ? date("Y-m-d H:i", strtotime($news->created)) : date("Y-m-d H:i")]); ?>
                            </label>
                        </section>

                        <section>
                            <label for="image" class="label"><?= __('Image') ?></label>
                            <?= ($news->image) ? $this->Core->image('News/'.$news->image, 50, 50) : '' ?>
                            <label class="input">
                                <?= $this->Form->input('image', ['label' => false, 'placeholder' => __('image'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                            <br>
                            <button type="button" class="btn" id="deleteImage">Delete Image</button>
                        </section>

                        <section>
                            <label for="file" class="label"><?= __('File') ?><p id="titleFile"><?php if($news->file) echo ($news->file) ?></p></label>
                            <label class="input">
                                <?= $this->Form->input('file', ['label' => false, 'placeholder' => __('file'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                                <br>
                                <button type="button" class="btn" id="deleteFile">Delete File</button>
                        </section>

                        <section class="col col-2">
                            <label class="toggle">
                                <?= $this->Form->checkbox('featured', ['required' => false, 'placeholder' => __('active')]); ?>
                                <i data-swchon-text="ON" data-swchoff-text="OFF"></i><?= __('Featured News')?>
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
    jQuery('#datetimepicker').datetimepicker({
        format:'Y-m-d H:i'
    });
    jQuery('#datetimepicker2').datetimepicker({
        format:'Y-m-d H:i'
    });
    var baseUrl = "<?= Router::url('/', true) ?>";
    var cID = <?= ($news->id) ? json_decode($news->id) : -1 ?>;
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
                    url: baseUrl + 'news/ajaxDeleleImage',
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

    inputFile = $('#file');
    $("#deleteFile").click(function() {
        if(cID < 0){
            inputFile.replaceWith(inputFile.val('').clone(true));
        }
        else{
            if (confirm('Do you want to delete this file?')) {
                jQuery.ajax
                ({
                    type: "POST",
                    dataType: 'json',
                    url: baseUrl + 'news/ajaxDeleleFile',
                    data: 'cid=' + cID,
                    success: function (data) {
                        alert("Delete success!");
                        $("#titleFile").fadeOut();
                        inputFile.replaceWith(inputFile.val('').clone(true));
                    }
                });
                return false;
            }
        }
    });
</script>
<?= $this->Html->script('Admin.jquery.js')?>