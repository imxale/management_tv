<?php

namespace App\Controller;

use App\Entity\Diffusion;
use App\Form\DiffusionType;
use App\Repository\DiffusionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/diffusion")
 */
class DiffusionController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     * @Route("/", name="app_diffusion_index", methods={"GET"})
     */
    public function index(DiffusionRepository $diffusionRepository): Response
    {
        return $this->render('diffusion/index.html.twig', [
            'diffusions' => $diffusionRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/new", name="app_diffusion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DiffusionRepository $diffusionRepository): Response
    {
        $diffusion = new Diffusion();
        $form = $this->createForm(DiffusionType::class, $diffusion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diffusionRepository->add($diffusion);
            return $this->redirectToRoute('app_diffusion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diffusion/new.html.twig', [
            'diffusion' => $diffusion,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="app_diffusion_show", methods={"GET"})
     */
    public function show(Diffusion $diffusion): Response
    {
        return $this->render('diffusion/show.html.twig', [
            'diffusion' => $diffusion,
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/{id}/edit", name="app_diffusion_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Diffusion $diffusion, DiffusionRepository $diffusionRepository): Response
    {
        $form = $this->createForm(DiffusionType::class, $diffusion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $diffusionRepository->add($diffusion);
            return $this->redirectToRoute('app_diffusion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('diffusion/edit.html.twig', [
            'diffusion' => $diffusion,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_EDITOR")
     * @Route("/{id}", name="app_diffusion_delete", methods={"POST"})
     */
    public function delete(Request $request, Diffusion $diffusion, DiffusionRepository $diffusionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diffusion->getId(), $request->request->get('_token'))) {
            $diffusionRepository->remove($diffusion);
        }

        return $this->redirectToRoute('app_diffusion_index', [], Response::HTTP_SEE_OTHER);
    }
}
