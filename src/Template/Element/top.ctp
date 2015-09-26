<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <ul >
                    <li><a href="#"><img src="<?=$this->Url->build('/images')?>/topLocationIcon.png"></a><?= ' '.$settings->toArray()[0]['address_'.__('lang')]?></li>
                    <li><a href="#"><img src="<?=$this->Url->build('/images')?>/topEmailIcon.png"></a>  <a href="mailto:<?= $settings->toArray()[0]['email']?>"><?= $settings->toArray()[0]['email']?></a></li>
                    <li><a href="#"><img src="<?=$this->Url->build('/images')?>/topMobileIcon.png"></a><?= ' '.$settings->toArray()[0]['phone_number']?></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-4">
                <?= $this->element('search');?>
            </div>
        </div>

    </div>
</div>