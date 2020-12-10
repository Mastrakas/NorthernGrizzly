<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController{

    /**
     * @Route("/home", name="home")
     */

    public function articlelist (ArticleRepository $articleRepository){
        $articlesActu = $articleRepository->findBy(
            ['type_article' => '1']);

        $articlesTraining = $articleRepository->findBy(
            ['type_article' => '2']);

        return $this->render('home.html.twig',
            [
                'articlesActu'=>$articlesActu,
                'articlesTraining'=>$articlesTraining
            ]);
    }
}