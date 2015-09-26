<div class="wrapper">
    <!--top-->
    <?= $this->element('top');?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner')?>
    <!--banner-->
    <!--slide-->
    <?= $this->element('slide')?>
    <!--slide-->
    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?=__('Results')?></a> </h1>
            </div>
            <div class="row">
                <div class="col-md-12 news">
                    <div class="searchResultText">
                        <?php echo $title; ?>
                    </div>
                    <?php
                    foreach($news as $row){
                        echo '<div class="titleNews">';
                        echo $this->Html->link($row['title_'.__('lang')], ['controller'=> 'News', 'action' => 'view', $row['id']]);
                        echo '<span>'.date_format($row['created'], 'Y/m/d H:i').'</span>';
                        echo '</div>';

                        if($row['image']) {
                            echo $this->Html->image("/upload/News/" . $row['image'], ["alt" => "No Image", "url" => ['controller' => 'News', 'action' => 'view', $row['id']]]);
                        }
                        echo '<p>'.$row['description_'.__('lang')].'</p>';
                        echo $this->Html->link(__('Read more'), ['controller'=> 'News', 'action' => 'view', $row['id']], ['class' => 'readMore']);
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

            <?= $this->element('iconsection')?>
        </div>
    </div>
    <!--block news-->

    <!--bom-->
    <?= $this->element('bom')?>
    <!--bom-->

</div>