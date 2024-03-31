<?php

namespace app\controllers;

use app\models\Files;
use app\models\upload\ImageUploadForm;
use yii\web\UploadedFile;
use ZipArchive;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $imageUploadForm = new ImageUploadForm();

        if (\Yii::$app->request->isPost) {
            $imageUploadForm->images = UploadedFile::getInstances($imageUploadForm, 'images');
            if ($imageUploadForm->upload()) {
                return $this->redirect(['gallery']);
            }
        }

        return $this->render('index', ['imageUploadForm' => $imageUploadForm]);
    }

    /**
     * Displays gallery page.
     *
     * @return string
     */
    public function actionGallery($sortFileName = false, $sortDate = false)
    {
        $session = \Yii::$app->session;
        $session->open();

        if ($sortDate && isset($session['sortOrder']) || $sortFileName && isset($session['sortOrder'])) {
            $session['sortOrder'] = ($session['sortOrder'] == 'asc') ? 'desc' : 'asc';
        } else {
            $session['sortOrder'] = 'asc';
        }

        $query = Files::find();

        if ($session['sortOrder'] == 'asc') {
            if ($sortFileName) {
                $query->orderBy(['file_name' => SORT_ASC]);
            } else if ($sortDate) {
                $query->orderBy(['created_at' => SORT_ASC]);
            }
        } else {
            if ($sortFileName) {
                $query->orderBy(['file_name' => SORT_DESC]);
            } else if ($sortDate) {
                $query->orderBy(['created_at' => SORT_DESC]);
            }
        }

        $images = $query->all();

        $session->close();

        return $this->render('gallery', ['images' => $images]);
    }

    /**
     * Filter images by file_name.
     */
    public function actionFilterImages() {
        $keyword = \Yii::$app->request->post('keyword');

        $images = Files::find()->where(['like', 'file_name', $keyword])->all();

        return $this->renderPartial('images-list', ['images' => $images]);
    }

    /**
     * Save Image As Zip.
     */
    public function actionSaveImageAsZip()
    {
        $imageUrl = \Yii::$app->request->post('imageUrl');

        $imageFileName = basename($imageUrl);

        $zip = new ZipArchive();
        $zipFileName = 'image.zip';

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return 'Failed to create ZIP archive';
        }

        $zip->addFromString($imageFileName, file_get_contents(\Yii::getAlias('@app/upload/images/') . basename($imageUrl)));

        $zip->close();

        \Yii::$app->response->sendFile($zipFileName);

        unlink($zipFileName);
    }
}
