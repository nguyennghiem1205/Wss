<!DOCTYPE HTML>
<html>
<body>
<div class="wrapper">

    <!--top-->
    <?= $this->element('top')?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner')?>
    <!--banner-->
    <!--slide-->
    <?=$this->element('slide')?>
    <!--slide-->

    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?=__('Tuyển dụng')?></a> </h1>
            </div>
            <div class="row">
                <div class="col-sm-9 news">
                    <div class="titleNews">
                        <a><?= $news['title_'.__('lang')]?></a>
                    </div>
                    <?php if($news['image']){
                        echo $this->Html->image('/upload/Recruits/'.$news['image']);
                    } ?>
                    <p><?= $news['content_'.__('lang')]?></p>
                    <div class="clearfix"></div>

                    <div class="recentNews">
                        <div class="titleRecent"><?=__('Recent')?></div>
                        <ul>
                            <?php foreach($recent_news as $row) {
                                $url = Core::generateUrl([
                                    'controller'=>'Pages',
                                    'action'=>'recruitment',
                                    'name' => $row['title_'.__('lang')],
                                    'id' => $row['id']
                                ]);
                                ?>
                            <li><a href="<?=$url?>"><?=$row['title_'.__('lang')]?></a></li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-3 mainRight">
                    <div class="rightBlock rightRecruitment">
                        <h5><img src="<?=$this->Url->build('/images')?>/icon4.png"><p><span><?=__('WSS hiện đang tuyển các vị trí sau')?></span></p></h5>
                        <ul>
                            <?php foreach($positions as $row){
                                $url = Core::generateUrl([
                                    'controller'=>'Pages',
                                    'action'=>'recruitment',
                                    'name' => $row['title_'.__('lang')],
                                    'id' => $row['id']
                                ]);
                                ?>
                            <li><a href="<?= $url?>"><?= $row['position']?><span><?= ' ('.$row['number'].' '.__('people').')'?></span></a> </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="downloadCV">
                        <a href="#"> Download CV</a>
                    </div>
                    <div class="downloadCV">
                        <a href="#"> Sent CV</a>
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


<script src="js/jquery.flexnav.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {

        // initialize FlexNav
        $(".flexnav").flexNav();
    });

</script>
</body>
</html>
