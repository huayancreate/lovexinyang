<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "t_menu".
 *
 * @property integer $id
 * @property string $menuname
 * @property integer $parentid
 * @property string $route
 * @property string $menuicon
 * @property integer $level
 */
class TMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuname','route'], 'required','message' => '{attribute}不能为空.'],
            [['parentid', 'level'], 'integer'],
            [['menuname', 'route'], 'string', 'max' => 32],
            [['menuicon'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menuname' => '菜单名称',
            'parentid' => '父类',
            'route' => '路由',
            'menuicon' => '图标',
            'level' => '级别',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $auth = Yii::$app->authManager;
        if($insert)
        {
            $permission = $auth->createPermission($this->route);
            $permission->description = $this->menuname;
            $auth->add($permission);
        }else
        {
            $route = ArrayHelper::getValue($changedAttributes,'route',$this->route);
            $permission = $auth->getPermission($route);
            $permission->name = $this->route;
            $permission->description = $this->menuname;
            $auth->update($route,$permission);
        }

    }

    public function afterDelete()
    {
        parent::afterDelete();
        //删除所有权限
        $auth = Yii::$app->authManager;
        if($p = $auth->getPermission($this->route))
            $auth->remove($p);
    }
    /**
     * 获取子菜单
     * @return static
     */
    public function getSon()
    {
        return $this->hasMany(TMenu::className(),['parentid'=>'id'])->orderBy('id desc');
    }
    /**
     * 获取父菜单
     */
    public function getFather()
    {
        return $this->hasOne(TMenu::className(),['id'=>'parentid']);
    }

    /**
     * 生成菜单
     * @return string
     */
    public static function generateMenuByUser()
    {
        $list = TMenu::find()->all();
        $menu = Yii::$app->controller->renderPartial('@backend/views/layouts/_menu',[
            'list'=>$list
        ]);
        return $menu;
    }

    /**
     * 格式化树形数组
     * @param  [type] $data [description]
     * @param  [type] $pId  [description]
     * @return [type]       [description]
     */
    public function getTree($data, $pId)
    {
        $tree = '';
        foreach($data as $val)
        {
            if($val['parentid'] == $pId)
            {         //父亲找到儿子
                $val['parentid'] = $this->getTree($data, $val['id']);
                $tree[] = $val;
            }
        }

        return $tree;
    }
}
