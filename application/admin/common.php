<?php
 /**
     * 递归实现无限极分类
     * @param $array 分类数据
     * @param $pid 父ID
     * @param $level 分类级别
     * @return $list 分好类的数组 直接遍历即可 $level可以用来遍历缩进
     * 适用于做下拉框
     */

    function getTreeSel($array, $pid =0, $level = 0){
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        static $list = [];
        foreach ($array as $key => $value){
             $value['controller_action_name'] = str_repeat('---',$level).$value['controller_action_name'];
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($value['pid'] == $pid){
                //父节点为根节点的节点,级别为0，也就是第一级
                $value['level'] = $level;
                //把数组放到list中
                $list[] = $value;
                //把这个节点从数组中移除,减少后续递归消耗
                unset($array[$key]);
                //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                getTreeSel($array, $value['id'], $level+1);

            }
        }
        return $list;
    }
/**无限分类递归**/
//这里适用于菜单栏
function getTree($arr,$tid=0,$level = 0)
{
    $tree = array();
    foreach ($arr as $v)
    {
       if($v['pid'] == $tid)
       {
           $v['level'] = $level;
           $v['son'] = getTree($arr,$v['id'],$level+1);
           $tree[] = $v;         
       }
    }
    return $tree;
}
function getTreeSels($array,&$yang, $pid =0, $level = 0){
    //声明静态数组,避免递归调用时,多次声明导致数组覆盖
    //static $list = [];
    $array = db('rule')->where('pid',$pid)->select();
    foreach ($array as $key => $value){
        //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
        if ($value['pid'] == $pid){
            //父节点为根节点的节点,级别为0，也就是第一级
            //把数组放到list中
            $yang[] = $value;
            //把这个节点从数组中移除,减少后续递归消耗
            unset($array[$key]);
            //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
            getTreeSels($array,$yang, $value['id'], $level+1);
        }
    }
    //return $list;
}








