<?php

$aComponents = array(
    dirname(__FILE__).'/components/App.php',
    dirname(__FILE__).'/components/Html.php',
    dirname(__FILE__).'/components/Db.php',
    dirname(__FILE__).'/components/Controller.php',
    dirname(__FILE__).'/components/Model.php',
    dirname(__FILE__).'/controllers/Post.php',
    dirname(__FILE__).'/models/PostModel.php',
    dirname(__FILE__).'/models/UserModel.php'
);

$aComponents = $aComponents + glob(dirname(__FILE__)."/models/*.php");

foreach($aComponents as $comp){
    require_once($comp);
}

$app = App::getInst();
$app->route();