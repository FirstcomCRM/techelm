<?phpnamespace backend\controllers;
use Yii;use common\models\Equipments;use common\models\SearchEquipments;use common\models\UserGroup;use common\models\UserPermission;use common\models\User;use yii\web\Controller;use yii\web\NotFoundHttpException;use yii\filters\VerbFilter;use yii\filters\AccessControl;use yii\helpers\ArrayHelper;/**
 * EquipmentController implements the CRUD actions for Equipments model.
 */
class EquipmentController extends Controller{
    const STATUS_ACTIVE = 1;    const STATUS_INACTIVE = 0;    /**
     * @inheritdoc
     */    public function behaviors()    {      $userGroupArray = ArrayHelper::map(UserGroup::find()->all(), 'id', 'name');

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
    }
    /**     * Lists all Equipments models.     * @return mixed     */
    public function actionIndex()    {        $searchModel = new SearchEquipments();        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [            'searchModel' => $searchModel,            'dataProvider' => $dataProvider,        ]);    }

    /**     * Displays a single Equipments model.     * @param integer $id     * @return mixed     */
    public function actionView($id)    {        return $this->render('view', [            'model' => $this->findModel($id),        ]);    }

    /**     * Creates a new Equipments model.     * If creation is successful, the browser will be redirected to the 'view' page.     * @return mixed     */
    public function actionCreate()    {        $model = new Equipments();        if ($model->load(Yii::$app->request->post())) {            if($model->save()){                $model->equipment_code = sprintf('EQUIP%05d', $model->id);                $model->active = self::STATUS_ACTIVE;                if($model->save()){                    Yii::$app->session->setFlash('success', 'New Equipment has been created!');                   return $this->redirect(['view', 'id' => $model->id]);                }            }else{                return $this->render('create', [                    'model' => $model,                ]);            }
        } else {            return $this->render('create', [                'model' => $model,            ]);        }    }

    /**     * Updates an existing Equipments model.     * If update is successful, the browser will be redirected to the 'view' page.     * @param integer $id     * @return mixed     */    public function actionUpdate($id)    {        $model = $this->findModel($id);        if ($model->load(Yii::$app->request->post())) {            if($model->save()){                $model->equipment_code = sprintf('EQUIP%05d', $model->id);                if($model->save()){                  Yii::$app->session->setFlash('success', 'Equipment has been updated!');
                   return $this->redirect(['view', 'id' => $model->id]);                }            }else{                return $this->render('create', [                    'model' => $model,                ]);            }
        } else {            return $this->render('create', [                'model' => $model,            ]);        }    }
    /**     * Deletes an existing Equipments model.     * If deletion is successful, the browser will be redirected to the 'index' page.     * @param integer $id     * @return mixed     */
    public function actionDelete($id)    {        $model = $this->findModel($id);        $model->active = self::STATUS_INACTIVE;        if($model->update()){            Yii::$app->session->setFlash('success', 'Equipment has been deleted!');
          //  Yii::$app->session->setFlash('success', $id .' HAS BEEN DELETED!');        }        return $this->redirect(['index']);    }
    /**     * Finds the Equipments model based on its primary key value.     * If the model is not found, a 404 HTTP exception will be thrown.     * @param integer $id     * @return Equipments the loaded model     * @throws NotFoundHttpException if the model cannot be found     */
    protected function findModel($id)    {        if (($model = Equipments::findOne($id)) !== null) {            return $model;        } else {            throw new NotFoundHttpException('The requested page does not exist.');        }
    }
}