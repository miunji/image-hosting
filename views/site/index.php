<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var ImageUploadForm $imageUploadForm
 */

$this->title = 'Image Hosting';
?>

<div class="fixed">
    <a href="<?= Url::to(['site/gallery']) ?>" class="mb-4 button btn btn-primary">Open image gallery</a>

    <?php $form = ActiveForm::begin(['id' => 'download-image']); ?>
        <div class="row">
            <div class="col-12">
                <?= $form->field($imageUploadForm, 'images[]')->fileInput(['multiple' => true])->label('Upload images') ?>
            </div>
        </div>

        <?= Html::submitButton(
            'Download',
            ['class' => 'btn btn-dark']
        ) ?>
    <?php ActiveForm::end(); ?>
</div>
