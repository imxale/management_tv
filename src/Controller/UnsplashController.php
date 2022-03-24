<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnsplashController extends AbstractController
{
    /**
     * @Route("/unsplash", name="app_unsplash")
     */
    public function index(): Response
    {
        return $this->render('unsplash/index.html.twig', [
            'controller_name' => 'UnsplashController',
        ]);
    }
}
