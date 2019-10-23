<?php

namespace App\Controller;

use App\Entity\Taillevet;
use App\Form\TaillevetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taillevet")
 */
class TaillevetController extends AbstractController
{
    /**
     * @Route("/", name="taillevet_index", methods={"GET"})
     */
    public function index(): Response
    {
        $taillevets = $this->getDoctrine()
            ->getRepository(Taillevet::class)
            ->findAll();

        return $this->render('taillevet/index.html.twig', [
            'taillevets' => $taillevets,
        ]);
    }

    /**
     * @Route("/new", name="taillevet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taillevet = new Taillevet();
        $form = $this->createForm(TaillevetType::class, $taillevet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taillevet);
            $entityManager->flush();

            return $this->redirectToRoute('taillevet_index');
        }

        return $this->render('taillevet/new.html.twig', [
            'taillevet' => $taillevet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTaillevet}", name="taillevet_show", methods={"GET"})
     */
    public function show(Taillevet $taillevet): Response
    {
        return $this->render('taillevet/show.html.twig', [
            'taillevet' => $taillevet,
        ]);
    }

    /**
     * @Route("/{idTaillevet}/edit", name="taillevet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Taillevet $taillevet): Response
    {
        $form = $this->createForm(TaillevetType::class, $taillevet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taillevet_index');
        }

        return $this->render('taillevet/edit.html.twig', [
            'taillevet' => $taillevet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idTaillevet}", name="taillevet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Taillevet $taillevet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taillevet->getIdTaillevet(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taillevet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('taillevet_index');
    }
}
