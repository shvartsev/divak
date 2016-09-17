<?php

/**
* Controller class
*
* @author  Igor Shvartsev (igor.shvartsev@gmail.com)
* @package Divak
* @version 1.0
*/
class Controller
{
    /** @var \View */
    protected $view; 
   
    /** @var string */
    protected $baseUrl = '';

    /** @var boolean */
    protected $buffering = true;

    /**
    * Set options
    *
    * @param array $options 
    */
    public function setOptions( $options = array() )
    {
        while (list($name, $value) = each($options)) {
            if (isset($this->$name) && is_string($name)) {
                $this->$name = $value;
            }
        }
    }

    /**
    * Sets view object
    * 
    * @param View $view
    */
    public function setView(\View $view = null)
    {
        $this->view = $view; 
    }
   
    /**
    * Gets view object
    * 
    * @return \View
    */
    public function getView()
    {
        return $this->view;   
    }
   
    /**
    *  Renders view
    * 
    *  @param array $data - template data
    *  @param string $template - template name
    *  @param bool $noController
    *  @param bool $return  - print or return  rendered result
    */
    public function render($data = null, $template = null, $noController = false, $return = false) 
    {
        if (is_array($data)) {
            $this->view->setData($data);
        }
        $out = $this->view->render($template, $noController);
        if ($return) {
            return $out;
        } else {
            if ($this->buffering) {
                \Response::setBody($out);
            } else {
                echo $out;
            }
        }
    }
   
    /**
    * Magic get
    * 
    * @param string $var
    */
    public function __get($var)
    {
        return $this->$var;   
    }
}
