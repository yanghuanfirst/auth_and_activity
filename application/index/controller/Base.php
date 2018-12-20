<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller{
    
    function initialize(){
          parent::initialize();
          $user = session('userinfo');
          if(!$user)
          {
              $appid = config('param.appid');
              $redirect = urlencode('http://www.auth.com/index/Getuser/getUser');
              //$redirect_url = 'http://www.activity.com/index/index/index';//这里应该需要获取用户上一个页面
              $redirect_url = $_SERVER['REQUEST_URI'];
              //print_r($_SERVER);die();
              $code_get_http = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect}&response_type=code&scope=snsapi_userinfo&state={$redirect_url}#wechat_redirect";
              header("Location:".$code_get_http);
              die();
          }
    }
}