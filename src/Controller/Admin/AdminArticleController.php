<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminArticleController extends AbstractController{

    /**
     * @Route ("admin/article/list", name="admin_article_list")
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

    /**
     * @Route ("admin/article/insert", name="admin_article_insert")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse|Response
     */
    public function articleinsert (Request $request, EntityManagerInterface $entityManager){
        $article = new Article();
//récup l'id pour author id de l'article
        $user = $this->getUser()->getPseudo();
        $article->setAuthor($this->getUser());


        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'article ajouté');

            return $this->redirectToRoute('admin_article_list');
        }
        //j'utilise la fonction createView pour que le gabarit soit lisible par twig
        $formView = $form->createView();

        //je retourne sur un fichier twig, le formulaire lisible
        return $this->render("Admin/article_insert.html.twig",
            [
                //je transmets au fichier twig une version lisible de ma variable formView
                'formView' => $formView,
                'user' => $user
            ]);
    }

    /**
     * @Route ("/admin/article/update/{id}", name="admin_article_update")
     */

    public function updateArticle ($id, EntityManagerInterface $entityManager, ArticleRepository $articleRepository, Request $request) {

        $article = $articleRepository->find($id);

        $user = $this->getUser()->getPseudo();
        $article->setAuthor($this->getUser());

        if (is_null($article)){
            return $this->redirectToRoute('admin_article_list');
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success','article modifié');

            return $this->redirectToRoute('admin_article_list');
        }

        $formView = $form->createView();

        return $this->render('Admin/article_update.html.twig',
            [
                'formView' => $formView
            ]);
    }

    /**
     * @Route ("/admin/article/delete/{id}", name="admin_article_delete")
     */
    public function deleteArticle ($id, ArticleRepository $articleRepository, EntityManagerInterface $entitymanager) {
        $article = $articleRepository->find($id);

        if (!is_null($article)) {
            $entitymanager->remove($article);
            $entitymanager->flush();

            $this->addFlash(
                'success',
                "l'article a bien été supprimé"
            );
        }

        return $this->redirectToRoute('admin_article_list');
    }
}