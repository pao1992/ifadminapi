<?php
/**
 * Created by 七月.
 * Author: 七月
 * 微信公号：小楼昨夜又秋风
 * 知乎ID: 七月在夏天
 * Date: 2017/2/19
 * Time: 11:28
 */

namespace app\api\controller\v2;


use app\api\controller\BaseController;
use app\api\model\Coupon as CouponModel;
use app\api\model\UserCoupon as UserCouponModel;
use app\api\validate\CouponNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\BaseException;
use app\api\validate\IDMustBePositiveInt;
use app\lib\exception\MissException;
use think\Controller;
use app\api\validate\PagingParameter;

class Coupon extends BaseController
{
    Public function createOne()
    {
        $validate = new CouponNew();
        $validate->goCheck();
        // 根据规则取字段是很有必要的，防止恶意更新非客户端字段
//        $data = $validate->getDataByRule(input('post.'));
        $model = new CouponModel();
        $res = $model->save(input('post.'));
        if (!$res) {
            throw new BaseException();
        }
        return new SuccessMessage();
    }

    public function getAllCoupons()
    {
        $res = CouponModel::all([]);
        return $res;
    }

    public function deleteOne($id)
    {
        (new IDMustBePositiveInt())->check($id);
        $res = CouponModel::destroy($id);
        if ($res) {
            return new SuccessMessage([
                'code' => 204
            ]);
        } else {
            throw new BaseException();
        }
    }

    public function getCouponsByDate($date)
    {
        $date = strtotime($date);
        $res = CouponModel::getCouponsByDate($date);
        return $res;
    }

    public function getCouponsByReceive($page = 1, $size = 20, $param = '', $content = '')
    {
        (new PagingParameter())->goCheck();
        $res = UserCouponModel::getCouponsByReceive($page, $size, $param, $content);
        return $res;
    }
}