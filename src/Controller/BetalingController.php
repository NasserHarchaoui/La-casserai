<?php

namespace App\Controller;

use App\Entity\Betaling;
use App\Form\BetalingType;
use App\Repository\BetalingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/betaling")
 */
class BetalingController extends AbstractController
{
    /**
     * @Route("/", name="betaling_index", methods={"GET"})
     */
    public function index(BetalingRepository $betalingRepository): Response
    {
        return $this->render('betaling/index.html.twig', [
            'betalings' => $betalingRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="betaling_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $betaling = new Betaling();
        $form = $this->createForm(BetalingType::class, $betaling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($betaling);
            $entityManager->flush();

            return $this->redirectToRoute('betaling_index');
        }

        return $this->render('betaling/new.html.twig', [
            'betaling' => $betaling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaling_show", methods={"GET"})
     */
    public function show(Betaling $betaling): Response
    {
        return $this->render('betaling/show.html.twig', [
            'betaling' => $betaling,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="betaling_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Betaling $betaling): Response
    {
        $form = $this->createForm(BetalingType::class, $betaling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('betaling_index', [
                'id' => $betaling->getId(),
            ]);
        }

        return $this->render('betaling/edit.html.twig', [
            'betaling' => $betaling,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaling_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Betaling $betaling): Response
    {
        if ($this->isCsrfTokenValid('delete'.$betaling->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($betaling);
            $entityManager->flush();
        }

        return $this->redirectToRoute('betaling_index');
    }
}
