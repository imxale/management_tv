<?php

namespace App\Controller;

use App\Entity\Categoriecsa;
use App\Form\CategoriecsaType;
use App\Repository\CategoriecsaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/categoriecsa")
 */
class CategoriecsaController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="app_categoriecsa_index", methods={"GET"})
     */
    public function index(CategoriecsaRepository $categoriecsaRepository): Response
    {
        return $this->render('categoriecsa/index.html.twig', [
            'categoriecsas' => $categoriecsaRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="app_categoriecsa_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CategoriecsaRepository $categoriecsaRepository): Response
    {
        $categoriecsa = new Categoriecsa();
        $form = $this->createForm(CategoriecsaType::class, $categoriecsa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriecsaRepository->add($categoriecsa);
            return $this->redirectToRoute('app_categoriecsa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriecsa/new.html.twig', [
            'categoriecsa' => $categoriecsa,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="app_categoriecsa_show", methods={"GET"})
     */
    public function show(Categoriecsa $categoriecsa): Response
    {
        return $this->render('categoriecsa/show.html.twig', [
            'categoriecsa' => $categoriecsa,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="app_categoriecsa_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categoriecsa $categoriecsa, CategoriecsaRepository $categoriecsaRepository): Response
    {
        $form = $this->createForm(CategoriecsaType::class, $categoriecsa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoriecsaRepository->add($categoriecsa);
            return $this->redirectToRoute('app_categoriecsa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categoriecsa/edit.html.twig', [
            'categoriecsa' => $categoriecsa,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="app_categoriecsa_delete", methods={"POST"})
     */
    public function delete(Request $request, Categoriecsa $categoriecsa, CategoriecsaRepository $categoriecsaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categoriecsa->getId(), $request->request->get('_token'))) {
            $categoriecsaRepository->remove($categoriecsa);
        }

        return $this->redirectToRoute('app_categoriecsa_index', [], Response::HTTP_SEE_OTHER);
    }
}
