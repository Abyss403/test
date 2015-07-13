<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
$aPosts = $GLOBALS['aPosts'];
?>
<h1>Posts</h1>
    <a href="/test/index.php?route=post/create">Create post</a>
    <table>
        <tr>
            <th>Title</th><th>Description</th><th>Date</th><th>Author email</th><th colspan="2">Actions</th>
        </tr>
        <?php foreach($aPosts as $post): ?>
        <tr>
            <td><?php echo $post->getAttributeValue('title')?></td>
            <td><?php echo $post->getAttributeValue('title')?></td>
            <td><?php echo $post->getAttributeValue('date')?></td>
            <td><?php echo $post->getAttributeValue('user_email')?></td>
            <td>
                <a href='/test/index.php?route=post/update&id=<?php echo $post->getAttributeValue('id'); ?>'>Edit</a> /
                <a href='/test/index.php?route=post/delete&id=<?php echo $post->getAttributeValue('id'); ?>'>Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>