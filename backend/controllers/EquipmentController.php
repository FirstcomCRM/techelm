<?php
use Yii;
 * EquipmentController implements the CRUD actions for Equipments model.
 */
class EquipmentController extends Controller
    const STATUS_ACTIVE = 1;
     * @inheritdoc
     */

       foreach ( $userGroupArray as $uGId => $uGName ){
           $permission = UserPermission::find()->where(['controller' => 'Equipment'])->andWhere(['user_group_id' => $uGId ] )->all();
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

    /**
    public function actionIndex()
        return $this->render('index', [

    /**
    public function actionView($id)

    /**
    public function actionCreate()
        } else {

    /**
                   return $this->redirect(['view', 'id' => $model->id]);
        } else {
    /**
    public function actionDelete($id)
          //  Yii::$app->session->setFlash('success', $id .' HAS BEEN DELETED!');
    /**
    protected function findModel($id)
    }
}