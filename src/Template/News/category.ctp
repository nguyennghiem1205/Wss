<div class="wrapper">
    <!--top-->
    <?= $this->element('top');?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner');?>
    <!--banner-->
    <!--slide-->
    <?= $this->element('slide')?>
    <!--slide-->

    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?php echo $title['title_'.__('lang')] ?></a> </h1>
            </div>

            <div class="row">
                <div class="col-md-3 ">
                    <?= $this->element('menu_left');?>
                </div>
                <div class="col-md-9 news">
                    <?php
                    foreach($news as $row){
                        $url = Core::generateUrl([
                            'controller'=>'News',
                            'action'=>'view',
                            'name' => $row['title_'.__('lang')],
                            'id' => $row['id']
                        ]);
                        echo '<div class="titleNews">';
                        echo '<a href="'.$url.'">'.$row['title_'.__('lang')].'</a>';
                        echo '<span>'.date_format($row['created'], 'Y/m/d H:i').'</span>';
                        echo '</div>';

                        if($row['image']) {
                            echo $this->Html->image("/upload/News/" . $row['image'], ["alt" => "No Image", "url" => ['controller' => 'News', 'action' => 'view', $row['id']]]);
                        }
                        echo '<p>'.$row['description_'.__('lang')].'</p>';
                        echo '<a href="'.$url.'" class="readMore">Read more</a>';
                        echo '<div class="clearfix"></div>';
                        echo '<hr>';
                    }
                    ?>
                    <div align="center">
                        <div class="paginator">
                            <ul class="pagination">
                                <?= $this->Paginator->prev('«') ?>
                                <?= $this->Paginator->numbers() ?>
                                <?= $this->Paginator->next('»') ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->element('iconsection');?>
        </div>
    </div>
    <!--block news-->

    <!--bom-->
    <?= $this->element('bom');?>
    <!--bom-->
</div>