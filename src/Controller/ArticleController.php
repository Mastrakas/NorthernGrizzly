<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController{

    /**
     * @Route("", name="home")
     * @param ArticleRepository $articleRepository
     * @return Response
     */

    public function articlelist (ArticleRepository $articleRepository){
        $articlesActu = $articleRepository->findBy(
            ['type_article' => '1'], ['date' => 'DESC'], 2);

        $articlesTraining = $articleRepository->findBy(
            ['type_article' => '2'], ['date' => 'DESC'], 2);

        return $this->render('home.html.twig',
            [
                'articlesActu'=>$articlesActu,
                'articlesTraining'=>$articlesTraining
            ]);
    }
}