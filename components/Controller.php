<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrey
 * Date: 7/13/15
 * Time: 9:58 AM
 * To change this template use File | Settings | File Templates.
 */

interface Controller
{
    public function index();
    public function update();
    public function create();
    public function delete();
}