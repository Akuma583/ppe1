<?php

namespace App\Controller;

use App\Entity\Coloris;
use App\Form\ColorisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/coloris")
 */
class ColorisController extends AbstractController
{
    /**
     * @Route("/", name="coloris_index", methods={"GET"})
     */
    public function index(): Response
    {
        $coloris = $this->getDoctrine()
            ->getRepository(Coloris::class)
            ->findAll();

        return $this->render('coloris/index.html.twig', [
            'coloris' => $coloris,
        ]);
    }

    /**
     * @Route("/new", name="coloris_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $colori = new Coloris();
        $form = $this->createForm(ColorisType::class, $colori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($colori);
            $entityManager->flush();

            return $this->redirectToRoute('coloris_index');
        }

        return $this->render('coloris/new.html.twig', [
            'colori' => $colori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idColoris}", name="coloris_show", methods={"GET"})
     */
    public function show(Coloris $colori): Response
    {
        return $this->render('coloris/show.html.twig', [
            'colori' => $colori,
        ]);
    }

    /**
     * @Route("/{idColoris}/edit", name="coloris_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Coloris $colori): Response
    {
        $form = $this->createForm(ColorisType::class, $colori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coloris_index');
        }

        return $this->render('coloris/edit.html.twig', [
            'colori' => $colori,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idColoris}", name="coloris_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Coloris $colori): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colori->getIdColoris(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($colori);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coloris_index');
    }
}
