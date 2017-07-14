<?php

namespace app\controllers;


use app\models\Post;
use core\base\Controller;

class MainController extends Controller
{

    public function actionIndex()
    {
        $posts = Post::findAll();
        return $this->render('home', ['posts' => $posts]);
    }

    public function actionAbout()
    {
        $post = Post::findOne(['title ', ' like ', '%First%']);
        return $this->render('about', ['post'=> $post]);
    }
}