<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 10:10 AM
 * To change this template use File | Settings | File Templates.
 */
class PostModel extends Model{

    protected $table = 'posts';
    protected $user_email;
    protected $aAttributes = array(
        'id' => '',
        'date' => '',
        'user_id' => '',
        'title' => '',
        'descr' => ''
    );

    public function setUser_email($email){
        $this->user_email = $email;
    }
    public function getUser_email(){
        if(!isset($this->user_email)){
            $this->user_email = $this->user()->getAttributeValue('email');
        }
        return $this->user_email;
    }

    protected $user;
    protected function user(){
        if(!isset($this->user)){
            $user = new UserModel();
            $this->user = $user->getById($this->aAttributes['user_id']);
        }
        return $this->user;
    }

    protected function createUserIfNotExist(){

        $user = UserModel::model()->getByAttr('email', $this->user_email);
        if($user->isNewRecord()){
            $user->setAttributes(array('email'=>$this->user_email));
            $user->save();
        }
        $this->aAttributes['user_id'] = UserModel::model()->getByAttr('email', $this->user_email)->getAttributeValue('id');
    }

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
        $this->createUserIfNotExist();
        return parent::save();
    }

    public function getById($id){
        return parent::getById($id);
    }
    public function delete(){
        return parent::delete();
    }

    static function model(){
        return new self();
    }
}