<?php

namespace app\controllers;

use yii\web\Response;
use app\models\Files;
use yii\web\NotFoundHttpException;

class ApiController extends BaseController
{
    public function actionImages()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        
        $images = Files::find()->all();

        $imageData = [];
        foreach ($images as $image) {
            $imageData[] = [
                'id' => $image->id,
                'file_name' => $image->file_name,
                'created_at' => $image->created_at,
            ];
        }

        return $imageData;
    }
    
    public function actionImage($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $image = Files::findOne($id);

        if ($image === null) {
            throw new NotFoundHttpException("Image with id $id not found");
        }

        return [
            'id' => $image->id,
            'file_name' => $image->file_name,
            'created_at' => $image->created_at,
        ];
    }
}
