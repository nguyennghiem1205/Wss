<div class="search">
    <?php
        echo $this->Form->create(null, ['url' => ['controller' => 'Pages', 'action' => 'search']]);
        echo $this->Form->input('key');
    ?>
        <span>
            <?=$this->Form->button('',['class'=>'btn'])?>
        </span>
    <?php
        echo $this->Form->end();
    ?>
</div>