<?php

namespace app\api\model;

use think\Model;
class UserCard extends BaseModel
{
    protected $hidden = ['delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;
    public function user(){
        return $this->belongsTo('User','user_id','id');
    }
    public static function getUserCard($card_id,$page,$size,$filter)
    {

        $model = new UserCard();
        $model->where(array('card_id'=>$card_id));
        foreach ($filter as $k=>$v){
            if($k != '' && $v !=''){
                $model->where([$k => $v]);
            }
        }
        $model->order('create_time desc')->with('user');
        $pagingData = $model->paginate($size, false, ['page' => $page]);
        return $pagingData ;
    }
    public function deleteOne($){

    }
}
