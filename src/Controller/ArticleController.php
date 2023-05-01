<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use  Symfony\Bridge\Doctrine\ManagerRegistry;
use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(Request $request,ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }

    #[Route('/', name: 'app_home')]
    public function home(){
        return $this->render('article/home/html.twig');
    }
}
