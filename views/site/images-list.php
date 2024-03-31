<?php

use yii\helpers\Html;
?>

<?php if ($images) { ?>
    <?php foreach ($images as $image) { ?>
        <div class="col-md-3 col-sm-4 col-xs-6 mb-3">
            <a href="<?= $image->getUrl() ?>" data-lightbox="image-gallery">
                <?= Html::img($image->getUrl(), ['class' => 'img-thumbnail']) ?>
            </a>
            <div class="name"><?= $image->file_name ?></div>
            <div class="created_at"><?= $image->created_at ?></div>

            <?= Html::beginForm(['site/save-image-as-zip'], 'post') ?>
                <?= Html::hiddenInput('imageUrl', $image->getUrl()) ?>
                <?= Html::submitButton('Save image as ZIP', ['class' => 'btn btn-dark']) ?>
            <?= Html::endForm() ?>
        </div>
    <?php } ?>
<?php } ?>
