<?php

namespace App\Controller;

use App\Entity\Emission;
use App\Form\EmissionType;
use App\Repository\EmissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/emission")
 */
class EmissionController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="app_emission_index", methods={"GET"})
     */
    public function index(EmissionRepository $emissionRepository): Response
    {
        return $this->render('emission/index.html.twig', [
            'emissions' => $emissionRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/new", name="app_emission_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EmissionRepository $emissionRepository): Response
    {
        $emission = new Emission();
        $form = $this->createForm(EmissionType::class, $emission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emissionRepository->add($emission);
            return $this->redirectToRoute('app_emission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emission/new.html.twig', [
            'emission' => $emission,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="app_emission_show", methods={"GET"})
     */
    public function show(Emission $emission): Response
    {
        return $this->render('emission/show.html.twig', [
            'emission' => $emission,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="app_emission_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Emission $emission, EmissionRepository $emissionRepository): Response
    {
        $form = $this->createForm(EmissionType::class, $emission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emissionRepository->add($emission);
            return $this->redirectToRoute('app_emission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emission/edit.html.twig', [
            'emission' => $emission,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="app_emission_delete", methods={"POST"})
     */
    public function delete(Request $request, Emission $emission, EmissionRepository $emissionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emission->getId(), $request->request->get('_token'))) {
            $emissionRepository->remove($emission);
        }

        return $this->redirectToRoute('app_emission_index', [], Response::HTTP_SEE_OTHER);
    }
}
