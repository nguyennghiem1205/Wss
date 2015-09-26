<ul class="menuLeft">
    <?php
        foreach($leftMenu as $lm ){
            if($lm['id']==$at_leftmenu['id']){
                ?>

                <li><a href="<?=$this->Menu->getLink($lm['link'])?>" class="active"><?=$lm['name_'.__('lang')]?></a> </li>
    <?php
            }else{
    ?>
                <li><a href="<?=$this->Menu->getLink($lm['link'])?>"><?=$lm['name_'.__('lang')]?></a> </li>
    <?php
        }
        }
    ?>
</ul>