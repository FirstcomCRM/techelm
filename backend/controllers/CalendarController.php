<?php
namespace backend\controllers;
use Yii;use yii\web\Controller;use yii\web\NotFoundHttpException;use common\models\ProjectJob;
use common\components\Helper;
use common\models\Servicejob;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\helpers\ArrayHelper;use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CalendarController extends Controller{

	public function behaviors()
    {

		$userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

      foreach ( $userGroupArray as $uGId => $uGName ){
          $permission = UserPermission::find()->where(['controller' => 'calendar'])->andWhere(['user_group_id' => $uGId ] )->all();
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

	public function actionIndex(){		return $this->render('index');	}
	public function actionTasks(){		$data = ProjectJob::getEvents();		foreach ($data as $key => $value) {			$data[$key]['status_flag'] = Helper::createStatusFlag($data[$key]['status_flag']);			$data[$key]['textColor'] = "#ffffff !important";			$data[$key]['backgroundColor'] = "#999999 !important";		}		echo json_encode($data);	}

	public function actionService(){		$data = Servicejob::getServiceJob();		foreach ($data as $key => $value) {			$data[$key]['start'] = date('Y-m-d', strtotime($data[$key]['start']));			$data[$key]['status_flag'] = Helper::createStatusFlag($data[$key]['status_flag']);			$data[$key]['textColor'] = "#ffffff !important";			$data[$key]['backgroundColor'] = "#2fa4e7 !important";		}		echo json_encode($data);	}
}


















 ?>
