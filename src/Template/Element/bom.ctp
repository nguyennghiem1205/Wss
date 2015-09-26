<div class="bom">
    <div class="container">
        <div class="row">
            <?php foreach($boms->toArray() as $row){?>
            <div class="col-md-6 col-sm-6 listBom">
                <img src="<?= $this->Url->build('/upload/CeoInfo/').$row['image'] ?>"></a>
                <h3><?= $row['name'] ?></h3>
                <p><?= $row['position_'.__('lang')] ?></p>
                <div class="clearfix"></div>
            </div>
            <?php }?>

        </div>
    </div>
</div>