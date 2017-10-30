<?php
namespace backend\controllers;
use Yii;
use common\components\Helper;
use common\models\Servicejob;
use common\models\UserGroup;
use common\models\UserPermission;
use common\models\User;
use yii\helpers\ArrayHelper;
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

	public function actionIndex(){
	public function actionTasks(){

	public function actionService(){
}


















 ?>