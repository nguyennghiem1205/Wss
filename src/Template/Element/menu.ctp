<nav>
    <ul data-breakpoint="800" class="flexnav">
        <?php
            foreach ($lv0 as $mn) {
        ?>
                <li class="active"><a href="<?=$this->Menu->getLink($mn['link'])?>"><?=$mn['name_'.__('lang')]?></a>
                    <?php
                        if($this->Menu->checkChildren($mn['id'],$lv1)){
                    echo '<ul>';
                        foreach ($lv1 as $mn1){
                            if($mn1['parent_id']==$mn['id']){
                    ?>
                                <li><a href="<?=$this->Menu->getLink($mn1['link'])?>"><?=$mn1['name_'.__('lang')]?></a>
                                        <?php
                                        if($this->Menu->checkChildren($mn1['id'],$lv2)){
                                        echo '<ul>';
                                        foreach ($lv2 as $mn2){
                                            if($mn2['parent_id']==$mn1['id']){
                                        ?>
                                        <li><a href="<?=$this->Menu->getLink($mn2['link'])?>"><?=$mn2['name_'.__('lang')]?></a></li>
                                        <?php
                                                }
                                            }
                                        echo '</ul>';
                                        }
                                        ?>
                                </li>
                    <?php
                                }
                            }
                        echo '</ul>';
                        }
                echo '</li>';
            }
        ?>
    </ul>
</nav>