<?php

namespace app\models;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string $file_name
 * @property string|null $created_at
 *
 */
class _source_Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['created_at'], 'safe'],
            [['file_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_name' => 'File Name',
            'created_at' => 'Created At',
        ];
    }
}
