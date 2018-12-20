<?php
namespace app\admin\controller;
class Index extends Error{
    
    function index(){
        
        return $this->fetch();
    }
    function blank()
    {
        
        return 111;
    }
    
}