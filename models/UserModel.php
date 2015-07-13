<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 10:10 AM
 * To change this template use File | Settings | File Templates.
 */
class UserModel extends Model{

    protected $table = 'users';
    protected $aAttributes = array(
        'id' => '',
        'email' => '',
        'pwd' => ''
    );

    public function getAttributeValue($attr){
        return parent::getAttributeValue($attr);
    }

    public function setAttributes($aAttributes){
        return parent::setAttributes($aAttributes);
    }

    public function getAttributes(){
        return parent::getAttributes();
    }

    public function save(){
        $res = false;
        if($this->isNewRecord){
            $this->aAttributes['pwd'] = md5(uniqid());
            if($res = parent::save()){
                mail($this->aAttributes['email'], 'registration', 'You have been successfully registered on the site, your pass is'. $this->aAttributes['pwd']);
            }
        }
        return $res;
    }

    public function getById($id){
        return parent::getById($id);
    }

    public function getByAttr($attr_name, $attr_value){

        $result = App::getInst()->db()->query("SELECT * FROM {$this->table} WHERE {$attr_name}=" . App::getInst()->db()->escape($attr_value));
        $row = mysql_fetch_array($result);
        if(!empty($row)){
            $this->isNewRecord = false;
            foreach($this->aAttributes as $name=>$value){
                if(isset($row[$name])){
                    $this->aAttributes[$name] = $row[$name];
                }
            }
        }
        return $this;
    }

    public function delete(){
        return parent::delete();
    }

    static function model(){
        return new self();
    }
}