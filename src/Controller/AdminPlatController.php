<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Form\PlatType;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/plat")
 */
class AdminPlatController extends AbstractController
{
    /**
     * @Route("/", name="admin_plat_index", methods={"GET"})
     */
    public function index(PlatRepository $platRepository): Response
    {
        return $this->render('admin_plat/index.html.twig', [
            'plats' => $platRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_plat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('admin_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_plat/new.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_plat_show", methods={"GET"})
     */
    public function show(Plat $plat): Response
    {
        return $this->render('admin_plat/show.html.twig', [
            'plat' => $plat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_plat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plat $plat): Response
    {
        $form = $this->createForm(PlatType::class, $plat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_plat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_plat/edit.html.twig', [
            'plat' => $plat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_plat_delete", methods={"POST"})
     */
    public function delete(Request $request, Plat $plat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_plat_index', [], Response::HTTP_SEE_OTHER);
    }
}
