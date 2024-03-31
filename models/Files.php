<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Files extends _source_Files
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class'      => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value'      => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * Return url to file.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (Yii::$app->params['domainImg'] ? '//' . Yii::$app->params['domainImg'] : '') . '/upload/images/' . $this->file_name;
    }
}
