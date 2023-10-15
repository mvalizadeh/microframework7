<?php


namespace App\Controller;

class ArticleController
{
    public function index()
    {
        $data = [
            'articles' => [
                'ar1' => 'lorem ipsum dolor sit amet, consect1',
                'ar2' => 'lorem ipsum dolor sit amet, consect2'
            ]
        ];
        view('/articles/index', $data);
    }

    public function create()
    {
        echo "from create page";
    }
}
