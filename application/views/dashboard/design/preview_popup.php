<div class="bts">
    <div class="bts-popup-container">
        <?php if ($datapopup->popupType == "Image Only") { ?>
            <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
        <?php } elseif ($datapopup->popupType == "Text Only") { ?>
            <p><?php echo $datapopup->popupText; ?></p>
        <?php } elseif ($datapopup->popupType == "Header Image And Bottom Text") { ?>
            <img class="image-replace" src="<?php echo base_url('asset/img/uploads/popup/' . $datapopup->popupImage . ''); ?>" alt="" width="100%" height="100%" />
            <p><?php echo $datapopup->popupText; ?></p>
        <?php } ?>
        <?php if ($datapopup->statusButton == "show") { ?>
            <div class="bts-popup-button">
                <a href="<?php echo base_url('pages/product/search?category=0&price=asc&group='); ?>">Shop Now</a>
            </div>
        <?php } ?>
        <a href="" class="bts-popup-close img-replace">Close</a>
    </div>
</div>