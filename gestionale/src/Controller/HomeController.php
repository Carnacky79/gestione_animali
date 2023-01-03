<?php

namespace App\Controller;

use App\Repository\ClientiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ClientiRepository $clientiRepo): Response
    {

        $clienti = $clientiRepo->findAll();


        return $this->render('home/index.html.twig', [
            'clienti' => $clienti,
        ]);
    }
}
