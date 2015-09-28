<?php
// Turn off all error reporting
error_reporting(0);
?>
<div class="wrapper">
    <!--top-->
    <?= $this->element('top')?>
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
                <h1><a href="#"><?= $title['title_'.__('lang')]?></a> </h1>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <?= $this->element('menu_left')?>
                </div>
                <div class="col-md-9 news">

                    <div class="titleNews">
                        <?php
                        echo $news['title_'.__('lang')];
                        echo '<span>('.date_format($news['created'], 'Y/m/d H:i').')</span>';
                        ?>
                    </div>
                    <?php
                    if ($news['image']){
                        echo $this->Html->image("/upload/News/".$news['image']);
                    }?>
                    <?php echo $news['content_'.__('lang')]?>
                    <div class="clearfix"></div>
                    <br>
                    <?php
                    if ($news['file']){
                        $info = new SplFileInfo($news['file']);
                        if(strtolower($info->getExtension()) == 'pdf') {
                            $link_file = $news['file'];
                            if (substr($link_file, 0, 4 ) != "http"){
                                $link_file = $this->Url->build('/upload/News/').$news['file'];
                            }
                            ?>
                            <div>
                                <object style="border:solid 1px #ccc;width:100%;height:600px" data="<?=$link_file?>" type="application/pdf" >
                                    <embed src="<?=$link_file?>" type="application/pdf" >&nbsp;
                                </object>
                            </div>
                        <?php
                        }
                        else {
                            $outputFileType = 'HTML';
                            $outputFileName = 'php://output';
                            $objPHPExcel = PHPExcel_IOFactory::load(WWW_ROOT.'upload/News/'.$news['file']);
                            $objPHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,$outputFileType);
                            ?>
                            <div class="col-md-12 news" style="overflow:scroll; height: 400px">
                                <?php
                                $objPHPExcelWriter->save($outputFileName);
                                ?>
                            </div>
                    <?php
                        }
                    }

                    ?>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="recentNews">
                        <div class="titleRecent">Recent</div>
                        <ul>
                            <?php
                            foreach($recentlist as $row){
                                $url = Core::generateUrl([
                                    'controller'=>'News',
                                    'action'=>'view',
                                    'name' => $row['title_'.__('lang')],
                                    'id' => $row['id']
                                ]);
                                echo '<li>';
                                echo '<a href="'.$url.'">'.$row['title_'.__('lang')].' ('.date_format($row['created'], 'Y-m-d H:i').')'.'</a>' ;// $this->Html->link($row['title_'.__('lang')].' ('.date_format($row['created'], 'Y-m-d H:i').')', ['controller'=> 'News', 'action' => 'view', $row['id']]);
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?= $this->element('iconsection');?>
        </div>
    </div>
    <!--block news-->
    <?= $this->element('bom');?>
    <!--bom-->
</div>