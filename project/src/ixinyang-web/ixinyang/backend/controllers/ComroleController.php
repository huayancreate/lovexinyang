<?php

namespace backend\controllers; 

use Yii; 
use backend\models\com_role; 
use backend\models\Com_Menu;
use backend\models\Com_MenuRolerelation;
use yii\data\ActiveDataProvider; 
use yii\web\Controller; 
use yii\web\NotFoundHttpException; 
use yii\filters\VerbFilter; 





/** 
 * ComroleController implements the CRUD actions for com_role model. 
 */ 
class ComroleController extends Controller
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
     * Lists all com_role models. 
     * @return mixed 
     */ 
    public function actionIndex() 
    { 
        $dataProvider = new ActiveDataProvider([ 
            'query' => com_role::find(), 
        ]); 

        return $this->render('index', [ 
            'dataProvider' => $dataProvider, 
        ]); 
    } 

    /** 
     * Displays a single com_role model. 
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
     * Creates a new com_role model. 
     * If creation is successful, the browser will be redirected to the 'view' page. 
     * @return mixed 
     */ 
    public function actionCreate() 
    { 
        $model = new com_role(); 

        if ($model->load(Yii::$app->request->post())) { 

            if(!$model->validate()){ //校验是否存在与重复
                $message=$model->getErrors();
                $message["success"]=False;
                return json_encode($message);
            }else{

                $transaction=\Yii::$app->db->beginTransaction(); //事务开始

                $model->creater="administrator";
                $model->updateTime=date("Y-m-d H:i:s");
                $model->updatePerson="administrator";

                $model->save(); //新增角色

                $strId=$_POST['menuId'];

                $menuIdArray=$this->stringInArray($strId);  //获菜单ID集合

                $this->menuRolereationModel($menuIdArray,$model->id); //角色、菜单关联插入操作

                $transaction->commit(); //事务结束

                $message=$model->getErrors();
                $message["success"]=True;
                return json_encode($message);
            }
            //return $this->redirect(['view', 'id' => $model->id]); 
        } else { 
            //获取全部菜单信息
            $treeData=$this->getMenuall();

            return $this->renderPartial('create', [ 
                'model' => $model,'treeData'=>$treeData,
            ]); 
        } 
    } 

    /**
     * 字符串转换数组
     * @param  [type] $str [字符串 1,2,3,4,5,]
     * @return [type]      [description]
     */
    protected function stringInArray($str){
        $str=substr($str,0,-1);//截取字符串最后一个‘,’字符
        return explode(",",$str); //将字符转换成数组
    }

    /**
     * [角色、菜单中间关联插入]
     * @param  [type] $menuIdArray [菜单ID数据集合]
     * @return [type] $roleId  [权限ID]
     */
    protected function menuRolereationModel($menuIdArray,$roleId){

        foreach ($menuIdArray as $menuId) {

            $comMenuRole=new Com_MenuRolerelation();
            
            $comMenuRole->roleId=$roleId;
            $comMenuRole->menuId=$menuId;

            $this->innertMenuRolereation($comMenuRole);
            
        }
    }

    /**
     * [角色、菜单中间关联插入]
     * @param  [type] $model [单个实体]
     */
    protected function innertMenuRolereation($model){
        $model->creater="administrator";
        $model->updateTime=date("Y-m-d H:i:s");
        $model->isValid="1";

        $model->save();
    }

    /** 
     * Updates an existing com_role model. 
     * If update is successful, the browser will be redirected to the 'view' page. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionUpdate($id) 
    { 
        $model = $this->findModel($id);

        $model->updateTime=date('Y-m-d H:i:s',time());
        $model->creater="adminstror";
        $model->updatePerson="adminstror";

        if ($model->load(Yii::$app->request->post()) && $model->save()) { 

            //事务开始
            $transaction=\Yii::$app->db->beginTransaction();

            $strId=$_POST['menuId'];
            $menuIdArray=$this->stringInArray($strId);  //获菜单ID集合

            $comMenuRole=new Com_MenuRolerelation();
            $comMenuRole->del('roleId',$id);

            $this->menuRolereationModel($menuIdArray,$id);

            //事务结束
            $transaction->commit();

            $message["success"]=True;
            return json_encode($message);

        } else { 

            $treeData=$this->getMenuall($id);//获取全部菜单信息
            
            return $this->renderPartial('update', [ 
                'model' => $model,'treeData'=>$treeData,
            ]); 
        } 
    }

    /** 
     * Deletes an existing com_role model. 
     * If deletion is successful, the browser will be redirected to the 'index' page. 
     * @param integer $id
     * @return mixed 
     */ 
    public function actionDelete($id) 
    { 
        //事务开始
        $transaction=\Yii::$app->db->beginTransaction();
        
        $this->findModel($id)->delete();

        $comMenuRole=new Com_MenuRolerelation();
        $comMenuRole->Del("roleId",$id);
        //事务结束
        $transaction->commit();

        return $this->redirect(['index']);
    } 

    /** 
     * Finds the com_role model based on its primary key value. 
     * If the model is not found, a 404 HTTP exception will be thrown. 
     * @param integer $id
     * @return com_role the loaded model 
     * @throws NotFoundHttpException if the model cannot be found 
     */ 
    protected function findModel($id) 
    { 
        if (($model = com_role::findOne($id)) !== null) { 
            return $model; 
        } else { 
            throw new NotFoundHttpException('The requested page does not exist.'); 
        } 
    } 




    //角色授权加载菜单ajax
    protected function getMenuall($id=0)
    {
        $sql = "SELECT t2.id,t2.menuName AS name,t2.parentMenuId AS pId,(CASE WHEN menuId>=1 THEN 'True' END)AS checked FROM(SELECT * FROM com_menu_rolerelation WHERE roleId=".$id.") AS t1
                RIGHT JOIN com_menu t2 ON t2.id=t1.menuId";

        $objData=Com_Menu::findBySql($sql)->asArray()->all();

        return json_encode($objData);
    }
} 