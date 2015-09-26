<?php use Cake\Core\Configure; ?>
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
                if($site->isNew()){
                    $titleBox = __('news add');
                }?>
                <h2><?= $titleBox?></h2>
            </header>

            <!-- widget div-->
            <div role="content">
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <?= $this->Form->create($site, ['id' => 'smart-form-register', 'class' => 'smart-form', 'type' => 'file']) ?>
                    <fieldset>

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
                            <?= ($site->image) ? $this->Core->image('Sites/'.$site->image, 50, 50) : '' ?>
                            <label class="input">
                                <?= $this->Form->input('image', ['label' => false, 'placeholder' => __('image'), 'type' => 'file']); ?>
                                <i class="icon-append fa fa-upload"></i>
                            </label>
                            <br>
                            <button type="button" class="btn" id="deleteImage">Delete Image</button>
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
    var baseUrl = "<?= $this->Url->build('/')?>";
    var cID = <?= ($site->id) ? json_decode($site->id) : -1 ?>;
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
                    url: baseUrl + 'pages/ajaxDeleleSiteImage',
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