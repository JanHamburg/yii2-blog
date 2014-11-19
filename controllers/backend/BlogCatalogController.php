<?php

namespace funson86\blog\controllers\backend;

use Yii;
use backend\modules\blog\models\BlogCatalog;
use backend\modules\blog\models\BlogCatalogSearch;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogCatalogController implements the CRUD actions for BlogCatalog model.
 */
class BlogCatalogController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlogCatalog models.
     * @return mixed
     */
    public function actionIndex()
    {
        //'visible' => Yii::$app->user->can('readYourAuth'),

        $searchModel = new BlogCatalogSearch();
        $dataProvider = BlogCatalog::get(0, BlogCatalog::find()->all());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogCatalog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //'visible' => Yii::$app->user->can('readYourAuth'),
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlogCatalog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //'visible' => Yii::$app->user->can('createYourAuth'),

        $model = new BlogCatalog();
        $model->loadDefaultValues();

        if(isset($_GET['parent_id']) && $_GET['parent_id'] > 0)
            $model->parent_id = $_GET['parent_id'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BlogCatalog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        //'visible' => Yii::$app->user->can('updateYourAuth'),

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BlogCatalog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //'visible' => Yii::$app->user->can('deleteYourAuth'),

        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = BlogCatalog::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogCatalog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogCatalog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogCatalog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*protected function getAllTemplates()
    {
        $arrayTpl = FileHelper::findFiles(dirname(Yii::$app->BasePath).'/frontend/themes/'.Yii::$app->params['template'].'/',['fileTypes'=>['php']]);
        $arrTpl = ['page' => [], 'list' => [], 'show' =>[]];
        foreach($arrayTpl as $tpl)
        {
            $tplName = substr(pathinfo($tpl, PATHINFO_BASENAME), 0, strpos(pathinfo($tpl, PATHINFO_BASENAME), '.'));
            if(strpos($tplName, 'post') !== false)
                $arrTpl['page'][$tplName] = $tplName;
            elseif(strpos($tplName, 'list') !== false)
                $arrTpl['list'][$tplName] = $tplName;
            elseif(strpos($tplName, 'show') !== false)
                $arrTpl['show'][$tplName] = $tplName;
        }

        return $arrTpl;
    }*/

}