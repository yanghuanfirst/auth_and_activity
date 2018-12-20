<?php
namespace app\index\controller;
use think\Controller;
class Getuser extends Controller{
    
    //获取用户信息
    function getUser()
    {
        $code = input('code/s','');
        $redirect_url = input('state/s','');
        $appid = config('param.appid');
        $appsecret = config('param.appsecret');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
        $open_info = wx_curl($url);
        $open_info = json_decode($open_info,1);
        if($open_info['openid'])
        {
            $user_access_token = $open_info['access_token'];
            $check_user_reg = db('user')->where(array('openid'=>$open_info['openid']))->find();
            if(!$check_user_reg){
                //没有注册则根据openid 获取微信用户信息并且插入数据库
                $http = "https://api.weixin.qq.com/sns/userinfo?access_token={$user_access_token}&openid={$open_info['openid']}&lang=zh_CN";
                $userinfo = json_decode(wx_curl($http),1);
                $userinfo['addtime'] = time();
                $userinfo['is_fans'] = 0;
                db('user')->field('openid,nickname,sex,city,province,country,headimgurl,addtime,status,is_fans')->insert($userinfo);
            }else{
                $userinfo = $check_user_reg;
            }
            session('userinfo',$userinfo);
            //header('Location:'.$redirect_url);
            $this->redirect($redirect_url);
        }
    
    }
    
}