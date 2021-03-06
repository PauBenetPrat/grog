<?php namespace BadChoice\Grog\FormBuilder;

use Html;

class FormBuilder{

    public static function build($object, $config)
    {
        if(is_array($config[0])){
            foreach ($config as $list){
                static::printList($object,$list);
            }
        }
        else{
            static::printList($object, $config);
        }
    }

    public static function printList($object, $list){
        echo '<div class="configForm">';
        foreach ($list as $formItem) {
            $type       = isset($formItem["type"])      ?$formItem["type"]      : "text";
            $showDesc   = isset($formItem["showDesc"])  ?$formItem["showDesc"]  : false;
            $field      = isset($formItem["field"])     ?$formItem["field"]     : $formItem;
            $select     = isset($formItem["select"])    ?$formItem["select"]    : null;
            $multiple   = isset($formItem["multiple"])  ?$formItem["multiple"]    : null;
            $extraAttributes   = isset($formItem["extraAttributes"])  ?$formItem["extraAttributes"]   : [];

            if($select  )       { echo Html::configForm('select', $object, $field, $showDesc, $select);         }
            else if($multiple)  { echo Html::configForm('select', $object, $field, $showDesc, $multiple, true);   }
            else                { echo Html::configForm($type, $object, $field, $showDesc, null, false, true, $extraAttributes);                     }
        }
        echo '</div>';
    }
}