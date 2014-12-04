<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_menu_rolerelation".
 *
 * @property integer $id
 * @property integer $menuId
 * @property string $creater
 * @property string $updateTime
 * @property integer $roleId
 * @property string $isValid
 */
class Com_MenuRolerelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_menu_rolerelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuId', 'roleId'], 'integer'],
            [['updateTime'], 'safe'],
            [['creater'], 'string', 'max' => 50],
            [['isValid'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menuId' => '菜单id',
            'creater' => '创建者',
            'updateTime' => '更新时间',
            'roleId' => '角色id',
            'isValid' => '0 无效、1 有效',
        ];
    }

    //删除操作
    public function Del($field,$value){
        
        $model=new Com_MenuRolerelation();

        $condition=$field.'='.$value;

        $model->deleteAll($condition);
    }

    /**
     * [编辑授权操作]
     * @param  [type] $menuIdArray [菜单ID集合]
     * @param  [type] $roleId      [角色ID]
     * @return [type]              [description]
     */
    public function updateOrDel($menuIdArray,$roleId){

        foreach ($menuIdArray as $id) {
            if (($model = Com_MenuRolerelation::findOne($id)) !== null) { 
                print_r($model);
                $model->delete();
            }else{
                $model=new Com_MenuRolerelation();
                $model->roleId=$roleId;
                $model->creater="administrator";
                $model->updateTime=date("Y-m-d H:i:s");
                $model->isValid="1";

                $model->save();
            }
        }
    }
}
