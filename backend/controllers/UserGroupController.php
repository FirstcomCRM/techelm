<?php

namespace backend\controllers;

use Yii;
use common\models\UserGroup;
use common\models\SearchUserGroup;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserPermission;
use common\models\User;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class UserGroupController extends Controller
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    public function behaviors()
    {
        $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

        foreach ( $userGroupArray as $uGId => $uGName ){
            $permission = UserPermission::find()->where(['controller' => 'UserGroup'])->andWhere(['user_group_id' => $uGId ] )->all();
            $actionArray = [];
            foreach ( $permission as $p )  {
                $actionArray[] = $p->action;
            }

            $allow[$uGName] = false;
            $action[$uGName] = $actionArray;
            if ( ! empty( $action[$uGName] ) ) {
                $allow[$uGName] = true;
            }

        }

        $usergroup_id = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $groupname = UserGroup::find()->where(['id'=>$usergroup_id->user_group_id])->one();

        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'create', 'update', 'view', 'delete'],
            
                'rules' => [
                      [
                          'actions' => $action[$groupname->name],
                          'allow' => $allow[$groupname->name],
                          'roles' => [$groupname->name],
                      ],
                    ],

            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUserGroup();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGroup();

        if ($model->load(Yii::$app->request->post()  ) ) {

            $model->created_at = date("Y/m/d H:i:s");
            $model->created_by = Yii::$app->user->identity->id;

            if ($model->save()) {
              Yii::$app->db->createCommand()->insert('auth_item',['name'=>$model->name,'type'=>1])->execute();
              Yii::$app->session->setFlash('success', "Usergroup ".$model->name." has been added");
              return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
              return $this->render('create', [
                  'model' => $model,
              ]);
            }
            //print_r($model->errors);die();

        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldname = $model->name;
        if ($model->load(Yii::$app->request->post())   ) {

            $UserCredentials = Yii::$app->session->get('UserCredentials');
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = date("Y/m/d H:i:s");

            if ($model->save()) {
              Yii::$app->db->createCommand()->update('auth_item',['name'=>$model->name],['name'=>$oldname])->execute();
              Yii::$app->session->setFlash('success', "Usergroup ".$model->name." has been updated");
              return $this->redirect(['view', 'id' => $model->id]);
            }else{
              return $this->render('update', [
                  'model' => $model,
              ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->active = self::STATUS_INACTIVE;
        if($model->update()){
            Yii::$app->session->setFlash('success', $id. ' HAS BEEN SET TO INACTIVE!');
        }else{
             Yii::$app->session->setFlash('danger', $id. ' FAILED TO DO THE ACTION!');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
