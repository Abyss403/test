<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
$model = $GLOBALS['model'];
?>
<h1><?php echo $model->isNewRecord()? 'Create' : 'Update'; ?> Post</h1>
<form action="" method="post">
    <h2>Title</h2>
    <p><?php echo Html::textInput($model, 'title'); ?></p>
    <h2>Description</h2>
    <p><?php echo Html::textInput($model, 'descr'); ?></p>
    <h2>Your email</h2>
    <p><?php echo Html::textInput($model, 'user_email'); ?></p>
    <input type="submit" name="post">
</form>