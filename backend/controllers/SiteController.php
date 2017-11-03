<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Service;
use common\models\User;
use common\models\Customer;
use common\models\SearchCustomer;
use common\models\SearchServicejob;
use common\models\SearchProjectJob;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        $serviceCount = new Service();
        $searchModel = new SearchServicejob();
        $searchProject = new SearchProjectJob();
        $dataProvider = $searchModel->dashBoard();
        $projectJob = $searchProject->dashBoard();
        //print_r($dataProvider->getModels());die();
        $data = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if ($data->role == 0) {

            return $this->render('index',[
              'dataProvider'=>$dataProvider,
              'projectJob'=>$projectJob,
            ]);
        }else{

          return $this->redirect(['customer/c-view', 'id'=>$data->role]);

        }


    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = false;

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('UserCredenstials', $model->getUserCredentials($_POST['LoginForm']['username'], $_POST['LoginForm']['password']));
            $test = $model->getUserCredentials($_POST['LoginForm']['username'], $_POST['LoginForm']['password']);

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
