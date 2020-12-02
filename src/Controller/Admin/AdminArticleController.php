<?php

namespace App\Controller\Admin;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController{

    /**
     * @Route ("admin/article/list", name="article_list")
     */
    public function articlelist (ArticleRepository $articleRepository){
        $articlesActu = $articleRepository->findBy(
            ['type_article' => '1']);

        $articlesTraining = $articleRepository->findBy(
            ['type_article' => '2']);

        return $this->render('Admin/articlelist.html.twig',
        [
            'articlesActu'=>$articlesActu,
            'articlesTraining'=>$articlesTraining
        ]);
    }
}