<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

abstract class Model
{
    protected $table;
    protected $aAttributes;
    protected $isNewRecord = true;

    public function isNewRecord(){
        return $this->isNewRecord;
    }

    public function setAttributes($aAttributes){
        foreach($aAttributes as $name=>$value){
            if(isset($this->aAttributes[$name])){
                $this->aAttributes[$name] = $value;
            }
        }
    }

    public function getAttributeValue($attr){
        $value = '';
        if(isset($this->aAttributes[$attr])){
            $value = $this->aAttributes[$attr];
        }
        $getFuncName = 'get'. ucfirst($attr);

        if(empty($value) && method_exists($this, $getFuncName)){
            $value = $this->$getFuncName();
        }
        return $value;
    }

    public function getAttributes(){
        return $this->aAttributes;
    }

    public function save(){
        $last = count($this->aAttributes) - 2;
        if($this->isNewRecord){
            $sql = "INSERT INTO {$this->table} ";
            $i = 0;
            $columns = '';
            $values = '';
            foreach($this->aAttributes as $name=>$value){
                if($name == 'id'){
                    continue;
                }
                if($name =='date'){
                    $last -= 1;
                    continue;
                }
                $columns .= $name;
                $values .= App::getInst()->db()->escape($value);
                if($i != $last){
                    $columns .= ',';
                    $values .= ',';
                }
                $i++;
            }
            $sql .= " ($columns) VALUES({$values})";
        }else{
            $sql = "UPDATE {$this->table} SET ";
            $id = $this->aAttributes['id'];
            $i = 0;
            foreach($this->aAttributes as $name=>$value){
                if($name == 'id'){
                    continue;
                }
                if($name =='date'){
                    $last -= 1;
                    continue;
                }
                $sql .= "{$name}=" . App::getInst()->db()->escape($value);
                if($i != $last){
                    $sql .= ',';
                }
                $i++;
            }
            $sql .= " WHERE id={$id}";
        }
        return App::getInst()->db()->query($sql);
    }

    public function getById($id){

        $result = App::getInst()->db()->query("SELECT * FROM {$this->table} WHERE id=" . App::getInst()->db()->escape($id));
        $row = mysql_fetch_array($result);
        if(!empty($row)){
            $this->isNewRecord = false;
            foreach($this->aAttributes as $name=>$value){
                if(isset($row[$name])){
                    $this->aAttributes[$name] = $row[$name];
                }
            }
        }
        return clone $this;
    }

    public function delete(){
        $id = $this->aAttributes['id'];
        App::getInst()->db()->query("DELETE FROM {$this->table} WHERE id={$id}");
        $this->isNewRecord = true;
        foreach($this->aAttributes as $name=>$value){
            $this->aAttributes[$name] = null;
        }
    }

    public function getList(){
        $result = App::getInst()->db()->query("SELECT id FROM {$this->table}");
        $aList = array();
        while ($row = mysql_fetch_array($result)) {
            $aList[] = $this->getById($row['id']);
        }
        return $aList;
    }
}