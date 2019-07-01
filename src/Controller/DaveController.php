<?php

namespace App\Controller;

use App\Entity\Dave;
use App\Form\DaveType;
use App\Repository\DaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dave")
 */
class DaveController extends AbstractController
{
    /**
     * @Route("/", name="dave_index", methods={"GET"})
     */
    public function index(DaveRepository $daveRepository): Response
    {
        return $this->render('dave/index.html.twig', [
            'daves' => $daveRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dave_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dave = new Dave();
        $form = $this->createForm(DaveType::class, $dave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dave);
            $entityManager->flush();

            return $this->redirectToRoute('dave_index');
        }

        return $this->render('dave/new.html.twig', [
            'dave' => $dave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dave_show", methods={"GET"})
     */
    public function show(Dave $dave): Response
    {
        return $this->render('dave/show.html.twig', [
            'dave' => $dave,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dave_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dave $dave): Response
    {
        $form = $this->createForm(DaveType::class, $dave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dave_index', [
                'id' => $dave->getId(),
            ]);
        }

        return $this->render('dave/edit.html.twig', [
            'dave' => $dave,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dave_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dave $dave): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dave->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dave);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dave_index');
    }
}
