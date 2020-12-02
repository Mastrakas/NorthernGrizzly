<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController{

    /**
     * @Route ("admin/article/list", name="article_list")
     */
    public function articlelist (ArticleRepository $articleRepository){
        $articlesActu = $articleRepository->findBy(
            ['type_article' => 'actu']);

        return $this->render('articlelist.html.twig',
        [
            'articlesActu'=>$articlesActu
        ]);
    }
}