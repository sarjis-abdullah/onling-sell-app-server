<?php
/**
 * Created by PhpStorm.
 * User: Sarjis Abdullah
 * Date: 11/01/2020
 * Time: 03:43 PM
 */

namespace App\Http\Repositories\Post;


interface PostRepositoryInterface
{
    public function search($request);
}