<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\SearchUser;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserGroup;
use yii\helpers\ArrayHelper;
use common\models\UserPermission;
use yii\filters\AccessControl;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

        foreach ( $userGroupArray as $uGId => $uGName ){
            $permission = UserPermission::find()->where(['controller' => 'User'])->andWhere(['user_group_id' => $uGId ] )->all();
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
                 'only' => ['index', 'create', 'update', 'view', 'delete'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchUser();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post()) && $model->save() ) {

            $auth = \Yii::$app->authManager;
            $usergroup = UserGroup::findOne(['id'=> $model->user_group_id]);
            $role = $auth->getRole($usergroup->name);
            $auth->assign($role, $model->id);
          //  print_r($model->role);die();
            Yii::$app->session->setFlash('success', "User created");
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usergroup = UserGroup::findOne(['id'=> $model->user_group_id]);
        $oldrole = $usergroup->name;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           $auth = \Yii::$app->authManager;
        //   die();
           $toRevoke = $auth->getRole($oldrole);
           $auth->revoke($toRevoke, $model->id);
           $usergroup = UserGroup::findOne(['id'=> $model->user_group_id]);
           $toAssign = $auth->getRole($usergroup);
           $auth->assign($toAssign,$model->id);
           Yii::$app->session->setFlash('success', "User updated");
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
        //    print_r($model->getErrors());
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $model->active = self::STATUS_INACTIVE;

        if($model->update()){
            Yii::$app->session->setFlash('success', $id." has been deleted!");
            return $this->redirect(['index']);
        }else{
          print_r($model->errors);
          die('error in delete/update');
        }

    }

    public function actionClearFcm($id){
      $model = $this->findModel($id);
      $model->fcm_registered_id = '';
      $model->save();
      Yii::$app->session->setFlash('success', "Mobile user session terminated!");
      return $this->render('view', [
          'model' => $model,
      ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
