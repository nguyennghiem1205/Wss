<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
        jQuery('#demo2').skdslider({delay:5000, animationSpeed: 1000,showNextPrev:true,showPlayButton:false,autoSlide:true,animationType:'sliding'});
        jQuery('#demo3').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});

        jQuery('#responsive').change(function(){
            $('#responsive_wrapper').width(jQuery(this).val());
            $(window).trigger('resize');
        });

    });
</script>


<div class="wrapper">
    <!--top-->
    <?= $this->element('top') ?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner')?>
    <!--banner-->
    <!--slide-->
    <?= $this->element('slide');?>
    <!--slide-->
    <?= $this->Flash->render() ?>
    <!--join with us-->
    <div class="joinWithUs">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2><?=__('Join with us')?></h2>
                    <p><?=__('Join now or never')?></p>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <a href="<?= $settings->toArray()[0]['trading_link']?>"><div class="onlineTrading"> <?=__('Online trading')?></div></a>
                </div>
            </div>
        </div>
    </div>
    <!--join with us-->

    <!--Top news-->
    <div class="topNews">
        <div class="container">
            <div class="row">
                <div class="col-md-1"><div class="newsTag"><?=__('Tin tức')?></div> </div>
                <div class="col-md-11">
                    <marquee>
                        <ul>
                            <?php
                                foreach($topnews as $news){
                                    echo '<li>';
                                    echo $this->Html->link($news['title_'.__('lang')], ['controller'=> 'News', 'action' => 'view', $news['id']]);
                                    echo '</li>' ;
                                }
                            ?>
                        </ul>

                    </marquee>
                </div>
            </div>

        </div>
    </div>
    <!--Top news-->
    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?=__('News')?></a> </h1>
            </div>
            <div class="titleNews">
                <?php $featured_news = $featured_news->toArray();?>
                <?php echo $this->Html->link($featured_news[0]['title_'.__('lang')], ['controller'=> 'News', 'action' => 'view', $featured_news[0]['id']]); ?>
            </div>
            <div class="row">
                <div class="col-md-7 news">
                    <?php
                    if ($featured_news[0]['image']){
                        echo $this->Html->image("/upload/News/".$featured_news[0]['image']);
                    }?>
                    <p><?php echo $featured_news[0]['description_'.__('lang')] ?></p>
                    <div class="dateTag"><?php echo date_format($featured_news[0]['created'], 'Y/m/d H:i') ?></div>
                    <a class="readMore" href=<?= './news/view/'.$featured_news[0]['id']?>>Read more</a>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-5">
                    <div class="listNews">
                        <?php
                        for($k = 1; $k < count($featured_news); $k++){
                        if ($featured_news[$k]['image']){
                            echo $this->Html->image("/upload/News/".$featured_news[$k]['image']);
                        }
                        ?>
                        <p><?php echo $this->Html->link($featured_news[$k]['title_'.__('lang')], ['controller'=> 'News', 'action' => 'view', $featured_news[$k]['id']]); ?></p>
                        <span><?php echo date_format($featured_news[$k]['created'], 'Y/m/d H:i') ?></span>
                        <div class="clearfix"></div>
                        <?php }?>
                    </div>
                </div>
            </div>

            <div class="iconSection">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <a href="<?= $settings->toArray()[0]['icon1_link']?>"><img src="<?=$this->Url->build('/images')?>/icon1.png"></a>
                        <p><a href="<?= $settings->toArray()[0]['icon1_link']?>"> Economic and finance News</a> </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <a href="<?= $settings->toArray()[0]['icon2_link']?>"><img src="<?=$this->Url->build('/images')?>/icon2.png"></a>
                        <p><a href="<?= $settings->toArray()[0]['icon2_link']?>"> Stock news</a> </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <a href="<?= $settings->toArray()[0]['icon3_link']?>"><img src="<?=$this->Url->build('/images')?>/icon3.png"></a>
                        <p><a href="<?= $settings->toArray()[0]['icon3_link']?>"> Market news</a> </p>
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <a href="<?= $settings->toArray()[0]['icon4_link']?>"><img src="<?=$this->Url->build('/images')?>/icon4.png"></a>
                        <p><a href="<?= $settings->toArray()[0]['icon4_link']?>"> WSS news</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--block news-->

    <!--bottom news-->
    <div class="bottomNews">
        <div class="container">
            <div class="row">
                <div class="col-md-5 ">
                    <div class="blockSub ">
                        <div class="news1">
                            <?php
                            $news_list1 = $news_list1->toArray();
                            $news_list2 = $news_list2->toArray();
                            ?>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li onClick="showactive()" role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?= $news_list1[0]->category['title_'.__('lang')]?></a></li>
                                <li onClick="hideactive()" role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?=$news_list2[0]->category['title_'.__('lang')]?></a></li>
                            </ul>
                            <!-- Tab panes -->

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <h3>
                                        <?php echo $this->Html->link($news_list1[0]['title_'.__('lang')], ['controller'=>'News', 'action' => 'view', $news_list1[0]['id']])?>
                                        <span>(<?= date_format($news_list1[0]['created'], 'Y/m/d H:i') ?>)</span>
                                    </h3>
                                    <?php if($news_list1[0]['image']) {
                                        echo $this->Core->image('News/'.$news_list1[0]['image'],200,200);
                                    }?>
                                    <?php echo $news_list1[0]['description_'.__('lang')];?>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <h3>
                                        <?php echo $this->Html->link($news_list2[0]['title_'.__('lang')], ['controller'=>'News', 'action' => 'view', $news_list2[0]['id']])?>
                                        <span>(<?= date_format($news_list2[0]['created'], 'Y/m/d H:i') ?>)</span>
                                    </h3>
                                    <?php if($news_list2[0]['image']) {
                                        echo $this->Core->image('News/'.$news_list2[0]['image'],200,200);
                                    }?>
                                    <?php echo $news_list2[0]['description_'.__('lang')];?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="blockSub1">
                        <div class="blockSub">
                            <div class="news2">
                                <ul>
                                    <?php
                                        for($k = 1; $k < count($news_list1); $k++){
                                        ?>
                                        <li>
                                            <a href='<?= './news/view/'.$news_list1[$k]['id']?>'><?= $news_list1[$k]['title_'.__('lang')] ?></a>
                                            <p><a href="#"><?= date_format($news_list1[$k]['created'], 'Y/m/d H:i')?></a><a href='<?='./news/category/'.$news_list1[0]->category['id']?>'><?= $news_list1[0]->category['title_'.__('lang')]?></a> </p>
                                        </li>
                                        <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="blockSub2" style="display:none">
                        <div class="blockSub">
                            <div class="news2">
                                <ul>
                                    <?php
                                    for($k = 1; $k < count($news_list2); $k++){
                                        ?>
                                        <li>
                                            <a href='<?= './news/view/'.$news_list2[$k]['id']?>'><?= $news_list2[$k]['title_'.__('lang')] ?></a>
                                            <p><a href="#"><?= date_format($news_list2[$k]['created'], 'Y/m/d H:i')?></a><a href='<?='./news/category/'.$news_list2[0]->category['id']?>'><?= $news_list2[0]->category['title_'.__('lang')]?></a> </p>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 news3">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        VN-INDEX
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <img src="http://chart.vietstock.vn/finance/FinanceMain/Vn-Index-realtime-250x160-NoTitle.png?rnd=-1363795888"/>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        HNX-INDEX
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <img src="http://chart.vietstock.vn/finance/FinanceMain/HNX-Index-realtime-250x160-NoTitle.png?rnd=0.14062869505958686"/>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        VS-100
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <img src="http://chart.vietstock.vn/finance/FinanceMain/VS100-realtime-250x160-NoTitle.png?rnd=0.7771379344116217"/>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        VS-Large Cap
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <img src="http://chart.vietstock.vn/finance/FinanceMain/vS-Large-Cap-realtime-250x160-NoTitle.png?rnd=0.9142159833059357"/>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        VS-Mid Cap
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <img src="http://chart.vietstock.vn/finance/FinanceMain/VS-Mid-Cap-realtime-250x160-NoTitle.png?rnd=0.22181926099482463"/>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--bottom news-->

    <!--guide-->
    <div class="guide">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <p><?=__('Please joint with our, you with have best services, best safe and best invest')?></p>
                </div>

                <div class="col-md-3 col-md-offset-1 col-sm-3">
                    <div class="goToGuide"><a href="<?= $settings->toArray()[0]['guide_link']?>"> <?=__('Go to Guide')?></a></div>
                </div>

            </div>
        </div>
    </div>
    <!--guide-->
    <!--service-->
    <div class="service">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#"><?=__('Services')?></a> </h1>
            </div>
            <div class="row">
                <?php for($k=0; $k < count($service_list); $k++){ ?>
                <div class="col-md-6 col-sm-6">
                    <div class="listService">
                        <a href="<?= './news/category/'.$service_list[$k]->toArray()[0]->category['id'] ?>"><img src="<?=$this->Url->build('/upload/Categories/').$service_list[$k]->toArray()[0]->category['image']?>"></a>
                        <h4><a href="<?= './news/category/'.$service_list[$k]->toArray()[0]->category['id'] ?>"><?= $service_list[$k]->toArray()[0]->category['title_'.__('lang')]  ?></a></h4>
                        <ul>
                            <?php
                            foreach($service_list[$k]->toArray() as $news){
                              ?>
                                <li><a href="<?='./news/view/'.$news['id'] ?>"><?= $news['title_'.__('lang')] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!--service-->

    <!--mobile-->
    <div class="mobility">
        <div class="container">
            <div class="row">
                <div class="col-md-3 logo"><img src="<?=$this->Url->build('/images')?>/logoMobile.png"></div>
                <div class="col-md-3 text">
                    <h3><?=__('Mobility')?></h3>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer interdum sem ac magna. Integer in lectus
                </div>
                <div class="col-md-5 col-md-offset-1 "><img src="<?=$this->Url->build('/images')?>/mobile.png"></div>
            </div>
        </div>
    </div>
    <!--mobile-->

    <!--client-->
    <div class="client">
        <div class="container">

            <div class="blockTitle">
                <h1><a href="#"><?=__('Clients')?></a> </h1>
            </div>
            <div class="row">
                <?php foreach($clients->toArray() as $row){?>
                <div class="col-md-4 col-sm-4 listComment">
                    <div class="arrow_box">
                        <h3>"</h3>
                        <p><?= $row['comment_'.__('lang')] ?></p>
                        <h3 align="right">"</h3>
                    </div>
                    <div class="content">
                        <img src="<?= $this->Url->build('/upload/CeoInfo/').$row['image'] ?>">
                        <h5><?= $row['name'] ?></h5>
                        <p><?= $row['position_'.__('lang')] ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php } ?>

            </div>

            <div class="row">
                <div class="listClient">
                    <?php foreach($partnerships->toArray() as $row){?>
                    <a href="<?= $row['link']?>"><img src="<?= $this->Url->build('/upload/CeoInfo/').$row['image']?>">
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--client-->

    <!--bom-->
    <?= $this->element('bom')?>
</div>
<script>
    function showactive(){
        $('#blockSub1').show();
        $('#blockSub2').hide();
    }
    function hideactive(){
        $('#blockSub1').hide();
        $('#blockSub2').show();
    }
</script>