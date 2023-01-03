<?php

namespace App\Controller;

use App\Entity\Clienti;
use App\Form\ClientiType;
use App\Repository\ClientiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clienti')]
class ClientiController extends AbstractController
{
    #[Route('/', name: 'app_clienti_index', methods: ['GET'])]
    public function index(ClientiRepository $clientiRepository): Response
    {
        return $this->render('clienti/index.html.twig', [
            'clientis' => $clientiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_clienti_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClientiRepository $clientiRepository): Response
    {
        $clienti = new Clienti();
        $form = $this->createForm(ClientiType::class, $clienti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientiRepository->save($clienti, true);

            return $this->redirectToRoute('app_clienti_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clienti/new.html.twig', [
            'clienti' => $clienti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clienti_show', methods: ['GET'])]
    public function show(Clienti $clienti): Response
    {
        return $this->render('clienti/show.html.twig', [
            'clienti' => $clienti,
            'animali' => $clienti->getAnimali(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_clienti_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Clienti $clienti, ClientiRepository $clientiRepository): Response
    {
        $form = $this->createForm(ClientiType::class, $clienti);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientiRepository->save($clienti, true);

            return $this->redirectToRoute('app_clienti_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clienti/edit.html.twig', [
            'clienti' => $clienti,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clienti_delete', methods: ['POST'])]
    public function delete(Request $request, Clienti $clienti, ClientiRepository $clientiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $clienti->getId(), $request->request->get('_token'))) {
            $clientiRepository->remove($clienti, true);
        }

        return $this->redirectToRoute('app_clienti_index', [], Response::HTTP_SEE_OTHER);
    }
}
