<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 9:54 AM
 * To change this template use File | Settings | File Templates.
 */

class Post implements Controller{

   protected function redirect($action, $params = false){
       $url = 'index.php?route=post/' . $action;
       if($params){
            $url .= '&' . http_build_query($params);
       }
       header("Location: {$url}");
   }

    protected function render($view){

        include(dirname(__FILE__).'/../views/post/'.$view.'.php');
    }

    public function index(){
        $aPosts = PostModel::model()->getList();
        $GLOBALS['aPosts'] = $aPosts;
        $this->render('index');
    }

    public function update(){
        if(!isset($_GET['id'])){
            die("Please, specify id");
        }
        $id = $_GET['id'];
        $model = PostModel::model()->getById($id);
        if($model->isNewRecord()){
            die("Post with id {$id} is not found");
        }
        if(isset($_POST['PostModel'])){
            $model->setAttributes($_POST['PostModel']);
            $model->setUser_email($_POST['PostModel']['user_email']);
            $model->save();
            $this->redirect('index');
        }
        $GLOBALS['model'] = $model;
        $this->render('form');
    }

    public function create(){
        $model = new PostModel();
        if(isset($_POST['PostModel'])){
            $model->setAttributes($_POST['PostModel']);
            $model->setUser_email($_POST['PostModel']['user_email']);
            $model->save();
            $this->redirect('index');
        }
        $GLOBALS['model'] = $model;
        $this->render('form');
    }

    public function delete(){
        if(!isset($_GET['id'])){
            die("Please, specify id");
        }
        $id = $_GET['id'];
        $model = PostModel::model()->getById($id);
        if($model->isNewRecord()){
            die("Post with id {$id} is not found!");
        }
        $model->delete();
        $this->redirect('index');
    }

}