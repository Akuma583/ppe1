<?php

namespace App\Controller;

use App\Entity\Vetement;
use App\Form\VetementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** )
 * @Route("/vetement")
 */
class VetementController extends AbstractController
{
    /**
     * @Route("/", name="vetement_index", methods={"GET"})
     */
    public function index(): Response
    {
        $vetements = $this->getDoctrine()
            ->getRepository(Vetement::class)
            ->findAll();

        return $this->render('vetement/index.html.twig', [
            'vetements' => $vetements,
        ]);
    }

    /**
     * @Route("/new", name="vetement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vetement = new Vetement();
        $form = $this->createForm(VetementType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vetement);
            $entityManager->flush();

            return $this->redirectToRoute('vetement_index');
        }

        return $this->render('vetement/new.html.twig', [
            'vetement' => $vetement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVet}", name="vetement_show", methods={"GET"})
     */
    public function show(Vetement $vetement): Response
    {
        return $this->render('vetement/show.html.twig', [
            'vetement' => $vetement,
        ]);
    }

    /**
     * @Route("/{idVet}/edit", name="vetement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vetement $vetement): Response
    {
        $form = $this->createForm(VetementType::class, $vetement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vetement_index');
        }

        return $this->render('vetement/edit.html.twig', [
            'vetement' => $vetement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idVet}", name="vetement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vetement $vetement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vetement->getIdVet(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vetement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vetement_index');
    }
}
