<?php
namespace Common\Normal;

class ActionResult
{
    public $state, $message;
    
    
    public function __construct($state, $message){
        $this->message = $message;
        $this->state = $state;
    }


    
    
}

