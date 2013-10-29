<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * This class enables you to place a side bootstrap powered sidebar on your pages
 *
 * @author aafetsrom
 */
class sideBar {
   private $content;
   private $isAjaxList;
   private $ajaxScript;
   /**
    * 
    * @param boolean $isAjaxList Whether the menu should load using ajax or not
    */
   public function __construct() {
      
       $this->content = '<div class="row">
                <div class="bs-docs-sidebar">
                <ul class="nav nav-list bs-docs-sidenav">';
   }
   /**
    * Add a new html li item to the sidebar object
    * @param text $label Text to be displayed
    * @param urlObject $url Url of the li item
    * @param text $id Unique html ID for the li item
    * @param array $htmlOptions Optional html options for the li item
    */
   public function addList($label, $url,$id, $htmlOptions=array(),$isAjax=false)
   {
       $this->isAjaxList = $isAjax;
       if($this->isAjaxList ===FALSE)
       {
           $this->content .= '<li id="'.$id.'"><a href="'.$url.'"><i class="icon-chevron-right"></i>'.$label.'</a></li>';
       }
       elseif ($this->isAjaxList === TRUE)
       {
           $baseUrl = Yii::app()->baseUrl;
           $this->content .= '<li '.'id="'.$id.'"'.'><a href="'.'#'.$url.'"><i class="icon-chevron-right"></i>'.$label.'</a></li>';
           $this->ajaxScript .= "$('#$id').on('click','a',function(event){event.preventDefault();loadAjaxContent('$baseUrl','$url')});";
       }
       return $this;
   }
   
   public function getSideBar()
   {
       if($this->isAjaxList ===FALSE)
       {
           return $this->content.'</ul></div></div>';
       }
       elseif($this->isAjaxList ===TRUE)
       {
           Yii::app()->clientScript->registerScript('loadMainBodyContentViaAjax', $this->ajaxScript, CClientScript::POS_READY);
           return $this->content.'</ul></div></div>';           
       }
       
   }
}

?>
