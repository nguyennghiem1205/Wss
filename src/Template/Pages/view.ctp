<div class="wrapper">
    <!--top-->
    <?= $this->element('top');?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner');?>
    <!--banner-->
    <!--slide-->
    <?= $this->element('slide');?>
    <!--slide-->

    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?= $site['title_'.__('lang')]?></a> </h1>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <?= $this->element('menu_left');?>
                </div>
                <div class="col-md-9 news">
                    <?php
                    if ($site['image']){
                        echo $this->Html->image("/upload/Sites/".$site['image']);
                    }?>
                    <?php echo $site['content_'.__('lang')]?>
                    <div class="clearfix"></div>
                </div>
            </div>

            <?= $this->element('iconsection');?>
        </div>
    </div>
    <!--block news-->

    <!--bom-->
    <?= $this->element('bom');?>
</div>