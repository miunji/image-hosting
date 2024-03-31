<?php

use yii\helpers\Html;

$this->title = 'Image Gallery';
?>

<div class="sort-btns mb-3">
    <?= Html::input('text', 'keyword', null, ['id' => 'keyword', 'placeholder' => 'Enter name']) ?>
    <?= Html::button('Filter images', ['class' => 'btn btn-primary', 'id' => 'filter-images']) ?>
    <?= Html::a('Sort by file name', ['gallery', 'sortFileName' => true], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Sort by date', ['gallery', 'sortDate' => true], ['class' => 'btn btn-primary']) ?>
</div>

<div id="image-gallery" class="row">
    <?= $this->render('@app/views/site/images-list', compact('images')) ?>
</div>

<?php
$this->registerCssFile('@web/css/lightbox.css');
$this->registerJsFile('@web/js/lightbox.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerJs('
    $(document).on("click", "#filter-images", function() {
        var keyword = $("#keyword").val();
        $.ajax({
            url: "/site/filter-images/",
            method: "POST",
            data: {keyword: keyword},
            success: function(response) {
                $("#image-gallery").html(response);
            }
        });
    });
');
?>
