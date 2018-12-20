<?php
namespace  ticket;
use think\facade\Request;
class Jsapi {
    
    public $access_token = '';
    function __construct(){
        $this->access_token = getToken();
    }
    //获取文件里面的ticket
    function getTicket()
    {
        $ticket_info = file_get_contents('jsapi_ticket.php');
        if($ticket_info)
        {
            $ticket_info = json_decode(substr($ticket_info,15),1);
            if($ticket_info['expire_time'] <= time())
            {
                $new_ticket = $this->getLineTicket();
                $new_tickets = $this->putFile($new_ticket);
                return $new_tickets['ticket'];
            }else{
                return $ticket_info['ticket'];
            }
        }else{
            $new_ticket = $this->getLineTicket();
            $new_tickets = $this->putFile($new_ticket);
            return $new_tickets['ticket'];
        }
    }
    //写入文件
    function putFile($new_ticket)
    {
        $new_tickets = json_decode($new_ticket,1);
        $json['expire_time'] = 7100+time();
        $json['ticket'] = $new_tickets['ticket'];
        $jsons = json_encode($json);
        $json = '<?php exit();?>'.$jsons;
        file_put_contents('jsapi_ticket.php', $json);
        return $new_tickets;
    }
    //重新请求微信获取ticket
    function getLineTicket()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->access_token.'&type=jsapi';
        $ticket_info = wx_curl($url);
        return $ticket_info;
    }
    //随机字符串
    function getNonestr($len = 16)
    {
        $strs = 'abcdefghijklmnopqrstuvwxyzABCDEFGHILKLMNOPQRSTUVWXYZ';
        $str = '';
        $lens = strlen($strs);
        for($i = 0;$i<$len;$i++)
        {
            $rand = mt_rand(0,$lens-1);
            $str .= $strs{$rand};
        }
        return $str;
    }
    //获取签名和所有jssdk需要用到的参数
    function getSign()
    {
        $param['noncestr'] = $this->getNonestr();
        $param['timestamp'] = time();
        $param['jsapi_ticket'] = $this->getTicket();
        $param['url'] = $this->getCurUrl();
        ksort($param);
        //$paramStr = $this->getParamStr($param);
        //
        //$paramStr = "jsapi_ticket={$param['jsapi_ticket']}&noncestr={$param['noncestr']}&timestamp={$param['timestamp']}&url={$param['url']}";
        $paramStr = $this->getParamStr($param);
        $sign = sha1($paramStr);
        return array('sign'=>$sign,'param'=>$param);
    }
    //获取生成签名生成的字符串
    function getParamStr($param)
    {
        $str = '';
        foreach($param as $k=>$v)
        {
            if($str)
            {
                $str .= '&'.$k.'='.$v;
            }else{
                $str = $k.'='.$v;
            }
        }
        return $str;
    }
    //当前地址
    function getCurUrl()
    {
       return Request::baseUrl(true);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}