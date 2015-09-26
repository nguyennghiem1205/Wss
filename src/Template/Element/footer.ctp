<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a href="#"><img src="<?=$this->Url->build('/images')?>/logoBottom.png"> </a>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="listBottom">
                            <?php
                            $countMn=count($lv1);
                            $d=0;
                            if($countMn%2==0){
                                $d=$countMn/2;
                            }else{
                                $d=intval($countMn/2)+1;
                            }
                            for($i=0;$i<$d;$i++){
                                echo '<li><a href="'.$this->Menu->getLink($lv1[$i]['link']).'">'.$lv1[$i]['name_'.__('lang')].'</a> </li>';

                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="listBottom">
                            <?php
                            for($i=$d;$i<$countMn;$i++){
                                echo '<li><a href="'.$this->Menu->getLink($lv1[$i]['link']).'">'.$lv1[$i]['name_'.__('lang')].'</a> </li>';

                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-md-6 address">
                        <table>
                            <tr>
                                <td><img src="<?=$this->Url->build('/images')?>/bottomLocationIcon.png"></td>
                                <td><?= $settings->toArray()[0]['address_'.__('lang')]?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->Url->build('/images')?>/bottomEmailIcon.png"></td>
                                <td><a href="mailto:<?= $settings->toArray()[0]['email']?>" style="color: #999999"><?= $settings->toArray()[0]['email']?></a></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->Url->build('/images')?>/bottomMobileIcon.png"></td>
                                <td><?= $settings->toArray()[0]['phone_number']?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <a href="<?= $settings->toArray()[0]['facebook_link']?>"><img src="<?=$this->Url->build('/images')?>/fbIcon.png"></a>
                <a href="<?= $settings->toArray()[0]['googleplus_link']?>"><img src="<?=$this->Url->build('/images')?>/ttIcon.png"></a>
                <a href="<?= $settings->toArray()[0]['twitter_link']?>"><img src="<?=$this->Url->build('/images')?>/g+Icon.png"></a>
            </div>
            <div class="col-md-4 signUp">
                <h4>SignUp newsletter</h4>
                <div>
                    <?php
                        echo $this->Form->create($mailSub, ['url' => ['controller' => 'Pages', 'action' => 'mailSub']]);
                        echo $this->Form->input('email',['placeholder'=>'Email']);
                        echo $this->Form->iput('SUBMIT',['type'=>'submit']);
                    ?>
                    copyright @wss.com.vn
                    <?php
                        echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="languages">
    <a href="<?= $this->Url->build('/pages/').'change_language/vi_VN'?>"><img src="<?=$this->Url->build('/images')?>/flat/vi-VN.gif"></a>
    <a href="<?= $this->Url->build('/pages/').'change_language/en_US'?>"><img src="<?=$this->Url->build('/images')?>/flat/en-GB.gif"></a>
    <a href="<?= $this->Url->build('/pages/').'change_language/ja_JP'?>"><img src="<?=$this->Url->build('/images')?>/flat/ja-JP.gif"></a>
</div>
