<div class="slideMain" >
    <ul id="demo2">
        <?php foreach ($slides->toArray() as $slide): ?>
            <li>
                <?= $this->Core->image('Slides/'.$slide->image,1300,450); ?>
                <div class="slide-desc">
                    <div class="container">
                        <h5><?= $slide['name_'.__('lang')] ?></h5>
                        <h3><?= $slide['description_'.__('lang')] ?></h3>
                        <h4><?= $slide['content_'.__('lang')] ?></h4>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>