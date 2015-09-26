<!DOCTYPE HTML>
<html>
<body>
<div class="wrapper">
    <!--top-->
    <?= $this->element('top');?>
    <!--top-->
    <!--banner-->
    <?= $this->element('banner')?>
    <!--banner-->
    <!--block news-->
    <div class="block blockNews">
        <div class="container">
            <div class="blockTitle">
                <h1><a href="#">Contact</a> </h1>
            </div>
            <div class="row">
                <div class="col-sm-8  contact">
                    <?php echo $this->Form->create($message, ['url' => ['controller' => 'Pages', 'action' => 'contact']]);?>
                        <table class="contactPC">
                            <tr>
                                <th></th>
                                <td><h3><?=__('Contact with us')?> !</h3>
                                    <h6><?=__('Please insert content on my form.')?> </h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <?= $this->Flash->render() ?>
                                </td>
                            </tr>
                            <tr>
                                <th><?=__('Name')?></th>
                                <td><?=$this->Form->input('name',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Email')?></th>
                                <td><?=$this->Form->input('email',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Phone')?></th>
                                <td><?=$this->Form->input('phone',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Content')?></th>
                                <td><?=$this->Form->input('content',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td><input type="submit" value="Send"></td>
                            </tr>
                        </table>
                    <?php
                    echo $this->Form->end();
                    ?>
                    <?php echo $this->Form->create($message, ['url' => ['controller' => 'Pages', 'action' => 'contact']]);?>
                        <table class="contactMobile">
                            <tr>
                                <td>
                                    <h3><?=__('Contact with us')?> !</h3>
                                    <h6><?=__('Please insert content on my form.')?> </h6>
                                </td>

                            </tr>
                            <tr>
                                <th><?=__('Name')?></th>
                            </tr>
                            <tr>
                                <td><?=$this->Form->input('name',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Email')?></th>
                            </tr>
                            <tr>
                                <td><?=$this->Form->input('email',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Phone')?></th>
                            </tr>
                            <tr>
                                <td><?=$this->Form->input('phone',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <th><?=__('Content')?></th>
                            </tr>
                            <tr>
                                <td><?=$this->Form->input('content',['label'=>false])?></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="Send"></td>
                            </tr>
                        </table>
                    <?php
                        echo $this->Form->end();
                    ?>
                </div>

                <div class="col-sm-4 mainRight">
                    <div class="rightBlock rightContact">
                        <h5><img src="<?=$this->Url->build('/images')?>/icon4.png"><p><span><?=__('Hãy liên hệ với WSS')?></span></p></h5>

                        <?php foreach($contacts->toArray() as $row){?>

                        <div class="branchBlock">
                            <h4><?= $row['title']?></h4>
                            <ul>
                                <li><span><?=__('Address')?>:</span><?= $row['address'] ?></li>
                                <li><span><?=__('Tel')?>:</span><?= $row['tel']?></li>
                                <li><span><?=__('Fax')?>:</span><?= $row['fax']?></li>
                                <li><a href="<?= 'mailto'.$row['email']?>"><span>Email:</span> <?= $row['email']?></a> </li>
                                <li><a href="<?= $row['website']?>"><span>Website:</span><?= $row['website']?></a> </li>
                            </ul>
                        </div>
                        <?php } ?>

                        <div class="hotLine">
                            <span><?=__('Đặt lệnh')?></span>
                            <h3>043.8248686</h3>
                            <span><?=__('Chăm sóc khách hàng')?></span>
                            <h3> 043.8248686</h3>
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

    <!--footer-->

    <!--footer-->

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
