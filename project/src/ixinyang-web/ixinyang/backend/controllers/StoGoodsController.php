<?php

namespace backend\controllers;

use Yii;
use backend\models\StoGoods;
use backend\models\StoGoodsSearch;
use backend\models\ComCategoryMaintain;
use backend\models\GoodsPicture;
use backend\models\FileUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\StoGoodsStore;
use yii\data\ActiveDataProvider;
use common\hycommon\tool\PictureTool;

/**
 * StoGoodsController implements the CRUD actions for StoGoods model.
 */
class StoGoodsController extends BackendController
{

    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }


    /**
     * Lists all StoGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
       /* $searchModel = new StoGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);*/

        //商品对应店铺信息实体类
        $model=new StoGoodsStore();
        //当前登陆店铺id  暂时写死  应该从session中读取
        $storeId=1;
         $dataProvider=new ActiveDataProvider([
                'query'=>$model->find()->where('storeId='.$storeId)->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoGoods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        //商品信息实体类
        $model = new StoGoods();
        //商品对应店铺信息表实体类
        $goodsStoreModel=new StoGoodsStore();
        //商品类别维护
        $categoryModel=new ComCategoryMaintain();


        if ($model->load(Yii::$app->request->post()) && $goodsStoreModel->load(Yii::$app->request->post())) {
            $transaction=\Yii::$app->db->beginTransaction(); 
            try{

<<<<<<< HEAD
                $files = UploadedFile::getInstances($model, 'file');  //»ñÈ¡ÉÏ´«ÎÄ¼þ

                //创建时间
                $model->createDate=date('Y-m-d H:m:i');
                //创建人id
                $model->createID=111;
                //创建人姓名
                $model->createName='111';
                //商品类别
                if($categoryModel->load(Yii::$app->request->post())){

                    $model->subClass=(int)$categoryModel->categoryName;

                }
                
                $model->save();  //ÉÌÆ·ÐÅÏ¢±£´æ

                $this->stoGoodsStoreModelSave($model->id,$goodsStoreModel);//ÉÌÆ·¶ÔÓ¦µêÆÌÐÅÏ¢±í±£´æ
=======
                $files = UploadedFile::getInstances($model, 'file');  //获取上传文件

                $model->save();  //商品信息保存

                $this->stoGoodsStoreModelSave($model->id);//��Ʒ��Ӧ������Ϣ�?��
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e

                $pictureToolModel=new PictureTool();
                foreach ($files as $file) {

<<<<<<< HEAD
                    $path=$pictureToolModel->uploads($file,2); //ÎÄ¼þÉÏ´«

                    $goodsPicture=new GoodsPicture();
                    $goodsPicture->goodsId=$model->id; //ÉÌÆ·ÐÅÏ¢ID
                    $goodsPicture->path=$path; //Í¼Æ¬Â·¾¶
=======
                    $path=$this->uploads($file); //文件上传

                    $goodsPicture=new GoodsPicture();
                    $goodsPicture->goodsId=$model->id; //商品信息ID
                    $goodsPicture->path=$path; //图片路径
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e
                    $goodsPicture->renewTime=date("Y-m-d H:i:s");
                    $goodsPicture->uploadPersonnel="admin";

                    $goodsPicture->save();
                }

<<<<<<< HEAD
                $transaction->commit(); //ÊÂÎñ½áÊø
=======
                $transaction->commit(); //事务结束
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e

                // $message=$model->getErrors();
                // $message['success']=true;
                

            } catch (Exception $e) {
                $transaction->rollBack();
                $message['success']=false;
            }

            //return json_encode($message);
            return $this->redirect(['index']);
        } else {
<<<<<<< HEAD
            //»ñÈ¡ÉÌÆ·Àà±ð
=======
            //获取商品类别
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();

            
            $model->validity=1;
            return $this->renderAjax('create', [
                'model' => $model,
                'categoryModel'=>$categoryModel,
                'categoryList'=>$categoryList,
                'goodsStoreModel'=>$goodsStoreModel,
            ]);
        }
    }

    /**
     * Updates an existing StoGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($sgsId,$goodsId)
    {
        //查询当前商品model
        $model = $this->findModel($goodsId);
        //查询当前商品对应店铺信息表 model
        $goodsStoreModel=$this->findGoodsStoreModel($sgsId);
        //商品类别维护
        $categoryModel=new ComCategoryMaintain();

        if ($model->load(Yii::$app->request->post()) && $goodsStoreModel->load(Yii::$app->request->post()) && $categoryModel->load(Yii::$app->request->post())) {
         
            $transaction=\Yii::$app->db->beginTransaction(); 
            try
            {

                $model->subClass=(int)$categoryModel->categoryName;
                //商品保存
                $model->save();
                //商品对应店铺信息表保存
                $goodsStoreModel->save();

                //图片的处理
                $files=UploadedFile::getInstances($model,'file'); //获取上传文件

                //如果重新选择了其他图片  则重新保存图片
                if (count($files)>0) 
                {

                     //查询该商品下的所有图片
                     $oldPhotoUrlArrays=GoodsPicture::find()->where(['goodsId'=>$goodsId])->asArray()->all();
                     //标记保存成功的次数
                     $flag=0;
                     $pictureToolModel=new PictureTool();

                     foreach ($files as $file) 
                     {

                        $path=$pictureToolModel->uploads($file,2); //图片上传

                        $goodsPicture=new GoodsPicture();
                        $goodsPicture->goodsId=$goodsId; //商品ID
                        $goodsPicture->path=$path; //图片路径
                        $goodsPicture->renewTime=date("Y-m-d H:i:s");
                        $goodsPicture->uploadPersonnel="admin";

                       if ($goodsPicture->save()) {
                            //标记保存成功的次数  成功累加1次
                            $flag=$flag+1;
                        }
                        else{
                            break;
                            //回滚
                            $transaction->rollBack();
                        } 
                     }

                     //保存成功  删除原来的图片
                     if($flag==count($files)){

                        //如果重新选择了其他图片  删除原来的图片
                        foreach ($oldPhotoUrlArrays as $oldPhotoUrlArray) {
                          GoodsPicture::deleteAll('path = "'.$oldPhotoUrlArray['path'].'"');
                          $pictureToolModel->delfile($oldPhotoUrlArray['path']);
                        }

                     }
                    
                }
                 //提交
                 $transaction->commit();

<<<<<<< HEAD
            } 
            catch (Exception $e) {
                //回滚
                $transaction->rollBack();
            }
             return $this->redirect(['index']);

        } 
        else {
           
=======
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
                $message=$model->getErrors();
                $message['success']=true;
                return json_encode($message);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //获取商品类别
            $categoryModel=new ComCategoryMaintain();
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();
            
            return $this->renderAjax('update', [
                'model' => $model,'categoryModel'=>$categoryModel,'categoryList'=>$categoryList,
                'goodsStoreModel'=>$goodsStoreModel,
            ]);
        }
    }

    /**
     * Deletes an existing StoGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $goodsId
     * @return mixed
     */
    public function actionDelete($sgsId,$goodsState,$goodsId)
    {
         $transaction=\Yii::$app->db->beginTransaction(); 
        try{
            //商品状态：0：待发布、1已发布、2已下架   0->商品表、商品对应店铺信息表、以及商品图片信息都是物理删除 以及保存的图片也要删除
            if ($goodsState==0) {
                //商品表
                $this->findModel($goodsId)->delete();
                //商品图片model获取
                $goodsPicModel=GoodsPicture::find()->where(['goodsId'=>$goodsId])->one();
                //保存的图片删除
                $pictureToolModel=new PictureTool();
                $pictureToolModel->delfile($goodsPicModel->path);
                //商品图片表的删除
                $goodsPicModel->delete();
                //商品对应店铺信息表删除
                $this->findGoodsStoreModel($sgsId)->delete();
                
            }
            else{//已发布或已下架仅仅修改图片的状态
                //该商品无效
                StoGoods::updateBySql('sto_goods',['validity'=>0],['id'=>$goodsId]);
            }

            //提交
            $transaction->commit(); 
        } catch (Exception $e) {
            //回滚
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the StoGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
<<<<<<< HEAD
     * Finds the StoGoodsStore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findGoodsStoreModel($sgsId)
    {
        if (($model = StoGoodsStore::findOne($sgsId)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * [stoGoodsStoreModelSave ÉÌÆ·¶ÔÓ¦µêÆÌÐÅÏ¢±íÐÅÏ¢Ìí¼Ó]
     * @param  [type] $goodsId [ÉÌÆ·id]
     * @return [type]          [description]
     */
    protected function stoGoodsStoreModelSave($goodsId,$stoGoodsStoreModel){
        //ÉÌÆ·id
        $stoGoodsStoreModel->goodsId=$goodsId;
        //µêÆÌid    ´Ósession¶ÁÈ¡   ÔÝÊ±Ð´Ä¬ÈÏÖµ
        $stoGoodsStoreModel->storeId=1;
        //ÉÌ¼Òid    ´Ósession¶ÁÈ¡   ÔÝÊ±Ð´Ä¬ÈÏÖµ
        $stoGoodsStoreModel->sellerId=1;
        //´´½¨Ê±¼ä  µ±Ç°Ê±¼ä
        $stoGoodsStoreModel->createDate=date("Y-m-d H:i:s");
        //´´½¨ÈË    ´Ósession¶ÁÈ¡
        $stoGoodsStoreModel->crreteUserID='111';
        //商品状态
        $stoGoodsStoreModel->goodsState=$_POST['hiddenGoodsState'];
        //±£´æ
=======
     * 文件上传
     * @param  [type] $files [文件集合]
     * @return [type]        [description]
     */
    protected function uploads($file){

        $filePath = "uploads/goodsPic/";
        
        $ext = $file->getExtension(); //获取文件后缀 如: ".jpg"
        
        $randName = time() . rand(1000, 9999) . "." . $ext; //生成新文件名称

        if(!file_exists($filePath)){
            mkdir($filePath,0777,true);
        }

        $file->saveAs($filePath.$randName); //保存文件

        return $filePath.$randName;
    }

    /**
     * [stoGoodsStoreModelSave ��Ʒ��Ӧ������Ϣ����Ϣ���]
     * @param  [type] $goodsId [��Ʒid]
     * @return [type]          [description]
     */
    protected function stoGoodsStoreModelSave($goodsId){
        $stoGoodsStoreModel=new StoGoodsStore();
        //��Ʒid
        $stoGoodsStoreModel->goodsId=$goodsId;
        //����id    ��session��ȡ   ��ʱдĬ��ֵ
        $stoGoodsStoreModel->storeId=1;
        //�̼�id    ��session��ȡ   ��ʱдĬ��ֵ
        $stoGoodsStoreModel->sellerId=1;
        //��Ʒ���  ��дĬ��ֵ ֮��ᴦ��
        $stoGoodsStoreModel->inventory=1000;
        //����ʱ��  ��ǰʱ��
        $stoGoodsStoreModel->createDate=date("Y-m-d H:i:s");
        //������    ��session��ȡ
        $stoGoodsStoreModel->crreteUserID='111';
        //����
>>>>>>> fffb70330574f07ed2f70bda0ea99b896f512d5e
        $stoGoodsStoreModel->save();

    }

    /**
     * [actionGoodsshelves 商品下架]
     * @param  [type] $sgsId [商品对应店铺信息表 主键id]
     * @return [type]        [description]
     */
    public function actionGoodsshelves($sgsId){

        $transaction=\Yii::$app->db->beginTransaction(); 

        try{
            //该商品已经下架
            StoGoodsStore::updateBySql('sto_goods_store',['goodsState'=>2],['sgsId'=>$sgsId]);
            //提交
            $transaction->commit(); 
        } catch (Exception $e) {
            //回滚
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
    }

    /**
     * [actionListpublish 列表页 商品的发布]
     * @param  [type] $sgsId [商品对应店铺信息表 主键Id]
     * @return [type]        [description]
     */
    public function actionListpublish($sgsId){

        $transaction=\Yii::$app->db->beginTransaction(); 

        try{
            StoGoodsStore::updateBySql('sto_goods_store',['goodsState'=>1],['sgsId'=>$sgsId]);
             //提交
            $transaction->commit(); 
        } catch (Exception $e) {
            //回滚
            $transaction->rollBack();
        }

      return $this->redirect(['index']);
    }

    /**
     * [actionOtherstoregoodslist 同一个商家 其他店铺已经发布的商品的列表显示  商品状态：0：待发布、1已发布、2已下架]
     * @return [type] [description]
     */
    public function actionOtherstoregoodslist(){
         //商品对应店铺信息实体类
        $model=new StoGoodsStore();
        //当前登陆店铺id  暂时写死  应该从session中读取
        $storeId=1;
        //当前登陆商家id  暂时写死  应该从session中读取
        $sellerId=1;

        $dataProvider=new ActiveDataProvider([
                'query'=>$model->find()->where('storeId!='.$storeId.' and sellerId='.$sellerId.' and goodsState=1 AND goodsId NOT IN(SELECT goodsId FROM sto_goods_store WHERE storeId='.$storeId.' AND goodsState=1)')->asArray(),
                'pagination' => ['pagesize' => '10'],
                ]);

        return $this->renderAjax('otherstoregoodslist', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * [actionOtherstoregoodscopy 复制同一个商家其他店铺的商品]
     * @return [type] [description]
     */
    public function actionOtherstoregoodscopy(){
       if (Yii::$app->request->post()) {
            //商品对应店铺信息表 主键id
            $sgsId=$_POST["sgsId"];
            //商品库存
            $inventory=$_POST["inventory"];
            //是否享受会员折扣  1 是  0否
            $enjoyRebate=$_POST["enjoyRebate"];
            //商品id
            $goodsId=$_POST["goodsId"];
            //商家id
            $sellerId=$_POST["sellerId"];

            //实体类
            $stoGoodsStoreModel=new StoGoodsStore();
            //商品id
            $stoGoodsStoreModel->goodsId=$goodsId;
            //店铺id   当前登陆店铺id  暂时先写死
            $stoGoodsStoreModel->storeId=1;
            //商家id
            $stoGoodsStoreModel->sellerId=$sellerId;
            //商品库存
            $stoGoodsStoreModel->inventory=$inventory;
            //创建时间
            $stoGoodsStoreModel->createDate=date("Y-m-d H:i:s");
             //创建人  当前登陆人id  暂时先写死
            $stoGoodsStoreModel->crreteUserID=111;
            //商品状态：0：待发布、1已发布、2已下架
            $stoGoodsStoreModel->goodsState=1;
            //是否享受会员折扣  1 是  0否
            $stoGoodsStoreModel->enjoyRebate=$enjoyRebate;
            
            $message=$stoGoodsStoreModel->getErrors();
            //保存成功
            if ($stoGoodsStoreModel->save()) {
                
                $message['success']=true;
            }
            else{//保存失败
                $message['success']=false;
            }
            return json_encode($message);
        } 
    }
}
