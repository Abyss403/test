<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 11:15 AM
 * To change this template use File | Settings | File Templates.
 */
class Html{

    static function textInput($model, $attribute){
        $class_name = get_class($model);
        $value = $model->getAttributeValue($attribute);
        echo "<input type='text' name='{$class_name}[{$attribute}]' value='{$value}'>";
    }
}