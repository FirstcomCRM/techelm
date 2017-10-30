<?php

namespace backend\controllers;

use Yii;
use common\models\UserGroup;
use common\models\Customer;
use common\models\SearchCustomer;
use common\models\SearchServicejob;
use common\models\SearchProjectJob;
use common\models\User;
use common\models\UserPermission;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

        foreach ( $userGroupArray as $uGId => $uGName ){
            $permission = UserPermission::find()->where(['controller' => 'Customer'])->andWhere(['user_group_id' => $uGId ] )->all();
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchCustomer();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $searchJob = new SearchServicejob();
        $searchJob->customer_id = $model->id;
        $dataProvider = $searchJob->search(Yii::$app->request->queryParams);

        $searchproject = new SearchProjectJob();
        $searchproject->customer_id = $model->id;
        $projectjob = $searchproject->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $model,
            'dataProvider'=>  $dataProvider,
            'projectjob'=>$projectjob,
        ]);
    }

    public function actionCView($id){
      $model = $this->findModel($id);

      $searchJob = new SearchServicejob();
      $searchJob->customer_id = $model->id;
      $dataProvider = $searchJob->search(Yii::$app->request->queryParams);

      $searchproject = new SearchProjectJob();
      $searchproject->customer_id = $model->id;
      $projectjob = $searchproject->search(Yii::$app->request->queryParams);

      $this->layout = 'c-main';
      return $this->render('c-view', [
          'model' => $model,
          'dataProvider'=>  $dataProvider,
          'projectjob'=>$projectjob,
      ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $model->created_by = Yii::$app->user->identity->id;
        $model->created_at = date("Y/m/d H:i:s");
        $model->updated_by = Yii::$app->user->identity->id;
        $model->updated_at = date("Y/m/d H:i:s");
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dup_user = User::find()->where(['username'=>$model->username, 'active'=>1])->one();
            $dup_email = User::find()->where(['email'=>$model->email,'active'=>1])->one();

          //  die(print_r($dup_user));
            if (!empty($dup_user)) {
              Yii::$app->session->setFlash('error', "Username already exist in User Table");
              return $this->render('create', [
                  'model' => $model,
              ]);
            }
            if (!empty($dup_email)) {
              Yii::$app->session->setFlash('error', "Email already exist in User Table");
              return $this->render('create', [
                  'model' => $model,
              ]);
            }

            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->user_group_id = $model->usergroup;
            $user->email = $model->email;
            $user->fullname = $model->fullname;
            $user->active = 1;
            $user->save(false);
            $auth = \Yii::$app->authManager;
            $usergroup = UserGroup::findOne(['id'=> $user->user_group_id]);
            $role = $auth->getRole($usergroup->name);
            $auth->assign($role, $user->id);
            // $model->save();
            // print_r($model->getErrors());exit;
            if($model->save()){
                $user->role = $model->id;
                $user->save();

                Yii::$app->session->setFlash('success', "Customer created");
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                'model' => $model,
              ]);
            }
        } else {
        //  print_r($model->getErrors()) ;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usergroup = UserGroup::findOne(['id'=> $model->usergroup]);
        if (!empty($usergroup)) {
            $oldrole = $usergroup->name;
        }else{
          $usergroup = null;
        }

        if ($model->load(Yii::$app->request->post())  ) {
            $data = User::find()->where(['role'=>$id])->one();
          /*  $dup_user = User::find()->where(['username'=>$model->username])->count();
            $dup_email = User::find()->where(['email'=>$model->email])->count();

            if ($dup_user>=1) {
              Yii::$app->session->setFlash('error', "Username already exist in User Table");
              return $this->render('update', [
                  'model' => $model,
              ]);
            }
            if ($dup_email>1) {
              Yii::$app->session->setFlash('update', "Email already exist in User Table");
              return $this->render('create', [
                  'model' => $model,
              ]);
            }*/
        //    $dup_user = User::find()->where(['username'=>$model->username])->count();
        //    die($dup_user);

            if (empty($data)) {
              $user = new User();
              $user->username = $model->username;
              $user->password = $model->password;
              $user->user_group_id = $model->usergroup;
              $user->email = $model->email;
              $user->active = 1;
              $user->fullname = $model->fullname;
              $user->save(false);
              $auth = \Yii::$app->authManager;
              $usergroup = UserGroup::findOne(['id'=> $user->user_group_id]);
              $role = $auth->getRole($usergroup->name);
              $auth->assign($role, $user->id);
              $model->save();
              $user->role = $model->id;
              $user->save(false);
            }else{
              $data->username = $model->username;
              $data->password = $model->password;
              $data->user_group_id = $model->usergroup;
              $data->email = $model->email;
              $data->save(false);
              $model->save(false);
              $auth = \Yii::$app->authManager;
              $toRevoke = $auth->getRole($oldrole);
              $auth->revoke($toRevoke, $data->id);
              $usergroup = UserGroup::findOne(['id'=> $data->user_group_id]);
            //  die(print_r($usergroup->name));
              $toAssign = $auth->getRole($usergroup->name);
              $auth->assign($toAssign,$data->id);
              //die(print_r(  $auth->revoke($toRevoke, $data->id)));
            }

            Yii::$app->session->setFlash('success', "Customer updated");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Customer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Customer deleted");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
