<?php

namespace App\Controller;

use App\Entity\Panieruser;
use App\Form\PanieruserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panieruser")
 */
class PanieruserController extends AbstractController
{
    /**
     * @Route("/", name="panieruser_index", methods={"GET"})
     */
    public function index(): Response
    {
        $panierusers = $this->getDoctrine()
            ->getRepository(Panieruser::class)
            ->findAll();

        return $this->render('panieruser/index.html.twig', [
            'panierusers' => $panierusers,
        ]);
    }

    /**
     * @Route("/new", name="panieruser_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panieruser = new Panieruser();
        $form = $this->createForm(PanieruserType::class, $panieruser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panieruser);
            $entityManager->flush();

            return $this->redirectToRoute('panieruser_index');
        }

        return $this->render('panieruser/new.html.twig', [
            'panieruser' => $panieruser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idPanieruser}", name="panieruser_show", methods={"GET"})
     */
    public function show(Panieruser $panieruser): Response
    {
        return $this->render('panieruser/show.html.twig', [
            'panieruser' => $panieruser,
        ]);
    }

    /**
     * @Route("/{idPanieruser}/edit", name="panieruser_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Panieruser $panieruser): Response
    {
        $form = $this->createForm(PanieruserType::class, $panieruser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panieruser_index');
        }

        return $this->render('panieruser/edit.html.twig', [
            'panieruser' => $panieruser,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idPanieruser}", name="panieruser_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Panieruser $panieruser): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panieruser->getIdPanieruser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panieruser);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panieruser_index');
    }
}
