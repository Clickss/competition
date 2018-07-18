<?php

namespace App\Controller;

use App\Entity\TypeDuel;
use App\Form\TypeDuelType;
use App\Repository\TypeDuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/duel")
 */
class TypeDuelController extends Controller
{
    /**
     * @Route("/", name="type_duel_index", methods="GET")
     */
    public function index(TypeDuelRepository $typeDuelRepository): Response
    {
        return $this->render('type_duel/index.html.twig', ['type_duels' => $typeDuelRepository->findAll()]);
    }

    /**
     * @Route("/new", name="type_duel_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $typeDuel = new TypeDuel();
        $form = $this->createForm(TypeDuelType::class, $typeDuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeDuel);
            $em->flush();

            return $this->redirectToRoute('type_duel_index');
        }

        return $this->render('type_duel/new.html.twig', [
            'type_duel' => $typeDuel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_duel_show", methods="GET")
     */
    public function show(TypeDuel $typeDuel): Response
    {
        return $this->render('type_duel/show.html.twig', ['type_duel' => $typeDuel]);
    }

    /**
     * @Route("/{id}/edit", name="type_duel_edit", methods="GET|POST")
     */
    public function edit(Request $request, TypeDuel $typeDuel): Response
    {
        $form = $this->createForm(TypeDuelType::class, $typeDuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_duel_edit', ['id' => $typeDuel->getId()]);
        }

        return $this->render('type_duel/edit.html.twig', [
            'type_duel' => $typeDuel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_duel_delete", methods="DELETE")
     */
    public function delete(Request $request, TypeDuel $typeDuel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDuel->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeDuel);
            $em->flush();
        }

        return $this->redirectToRoute('type_duel_index');
    }
}
