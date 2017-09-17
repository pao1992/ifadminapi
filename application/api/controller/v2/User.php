<?php
/**
 * Created by 七月
 * User: 七月
 * Date: 2017/2/15
 * Time: 13:40
 */

namespace app\api\controller\v2;


use app\api\controller\BaseController;
use app\api\validate\IDMustBePositiveInt;
use app\api\model\User as UserModel;
use app\lib\exception\MissException;

/**
 * Banner资源
 */ 
class User extends BaseController
{
    public function getUserById($id){
        (new IDMustBePositiveInt())->check($id);
        $res = UserModel::getUserById($id);
        return $res;
    }
    public function getAllUsers(){
        $res = UserModel::getAllUsers();
        return $res;
    }
}