<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.04.17
 * Time: 10:32
 */

namespace App;


use Illuminate\View\Compilers\BladeCompiler;

class MyBladeCompiler extends BladeCompiler
{
    public function isExpired($path)
    {
        //if ( ! \Config::get('view.cache'))
        //{
        //    return true;
        //}

        return parent::isExpired($path);
    }
}