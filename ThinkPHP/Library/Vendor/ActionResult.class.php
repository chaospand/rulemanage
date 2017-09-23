<?php
namespace normalClass\Model;

class ActionResult
{
    private $_state, $_message;
    
    public function __construct(){
        
    }
    
    public function __construct($state, $message){
        $this->_message = $message;
        $this->_state = $state;
    }
    /**
     * @return the $_state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @return the $_message
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * @param field_type $_state
     */
    public function setState($_state)
    {
        $this->_state = $_state;
    }

    /**
     * @param field_type $_message
     */
    public function setMessage($_message)
    {
        $this->_message = $_message;
    }

    
    
}

