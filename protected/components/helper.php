<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helper
 *
 * @author aafetsrom
 */
class helper {
    //put your code here
    public static function showFlash($cssClass='')
    {
    foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            echo '<div class="alert alert-' . $key . ' '.$cssClass.'"><a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . "</div>\n";
        }
    }
    
    public static function showGlobalMsg()
    {
    foreach(Yii::app()->user->getFlashes() as $key => $message) 
        {
            if($key=='global')
            {
                echo '<div class="alert alert-error"><a href="#" class="close" data-dismiss="alert">&times;</a>' . $message . "</div>\n";
            }
            
        }
    }
    
    public static function showPageTitle($title)
    {
        $test = ucfirst($title);
        echo "<div class=\"page-header page-title\">$title</div>";
    }
    
    function simpleXMLToArray(SimpleXMLElement $xml,$attributesKey=false,$childrenKey=false,$valueKey=false){

    if($childrenKey && !is_string($childrenKey)){$childrenKey = '@children';}
    if($attributesKey && !is_string($attributesKey)){$attributesKey = '@attributes';}
    if($valueKey && !is_string($valueKey)){$valueKey = '@values';}

    $return = array();
    $name = $xml->getName();
    $_value = trim((string)$xml);
    if(!strlen($_value)){$_value = null;};

    if($_value!==null){
        if($valueKey){$return[$valueKey] = $_value;}
        else{$return = $_value;}
    }

    $children = array();
    $first = true;
    foreach($xml->children() as $elementName => $child){
        $value = simpleXMLToArray($child,$attributesKey, $childrenKey,$valueKey);
        if(isset($children[$elementName])){
            if(is_array($children[$elementName])){
                if($first){
                    $temp = $children[$elementName];
                    unset($children[$elementName]);
                    $children[$elementName][] = $temp;
                    $first=false;
                }
                $children[$elementName][] = $value;
            }else{
                $children[$elementName] = array($children[$elementName],$value);
            }
        }
        else{
            $children[$elementName] = $value;
        }
    }
    if($children){
        if($childrenKey){$return[$childrenKey] = $children;}
        else{$return = array_merge($return,$children);}
    }

    $attributes = array();
    foreach($xml->attributes() as $name=>$value){
        $attributes[$name] = trim($value);
    }
    if($attributes){
        if($attributesKey){$return[$attributesKey] = $attributes;}
        else{$return = array_merge($return, $attributes);}
    }

    return $return;
} 
}

?>
