<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Competition;
use App\Entity\Duel;
use App\Form\GroupeType;
use App\Form\DuelType;
use App\Repository\GroupeRepository;
use App\Repository\DuelRepository;
use App\Repository\TypeDuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/competition/{competition}/groupe")
 */
class GroupeController extends Controller
{
    /**
     * @Route("/", name="groupe_index", methods="GET")
     */
    public function index(GroupeRepository $groupeRepository, DuelRepository $duelRepository, Competition $competition): Response
    {
        $groupes = $groupeRepository->findBy(array("competition" => $competition));
        $tableau = array();
        
        foreach ($groupes as $groupe) {
            $tab = array();
            $tab['groupe'] = $groupe;
            $tab['duels'] = $duelRepository->findDuelByGroupe($groupe, $competition);
            $tab['equipes'] = array();
            foreach ($groupe->getEquipes() as $equipe) {
                $tab_equ = array();
                $tab_equ['equipe'] = $equipe;
                $nbMatchGagne = $duelRepository->nbMatchGagne($equipe, $competition)[0]['nbMatchGagne'];
                $nbMatchNul = $duelRepository->nbMatchNul($equipe, $competition)[0]['nbMatchNul'];
                $nbMatchPerdu = $duelRepository->nbMatchPerdu($equipe, $competition)[0]['nbMatchPerdu'];
                $nbMatchJoue = $duelRepository->nbMatchJoue($equipe, $competition)[0]['nbMatch'];
                $nbButPour = $duelRepository->nbButPour($equipe, $competition)[0]['nbButPour'];
                $nbButContre = $duelRepository->nbButContre($equipe, $competition)[0]['nbButContre'];
                $tab_equ['points'] = intval($nbMatchGagne) * 2 + $nbMatchNul;
                $tab_equ['match_g'] = $nbMatchGagne;
                $tab_equ['match_n'] = $nbMatchNul;
                $tab_equ['match_p'] = $nbMatchPerdu;
                $tab_equ['match_j'] = $nbMatchJoue;
                $tab_equ['but_pour'] = $nbButPour;
                $tab_equ['but_contre'] = $nbButContre;
                $tab_equ['diff'] = intval($nbButPour) - intval($nbButContre);
                array_push($tab['equipes'], $tab_equ);
            }            
            array_push($tableau, $tab);
        }
        
        //Tri par points
        for($i=0;$i<count($tableau);$i++)
        {
            for($j=0;$j<count($tableau[$i]['equipes'])-1;$j++)
            {
                for($k=$j+1;$k<count($tableau[$i]['equipes']);$k++)
                {
                    if(intval($tableau[$i]['equipes'][$j]['points']) < intval($tableau[$i]['equipes'][$k]['points']))
                    {
                        $temp = $tableau[$i]['equipes'][$k];
                        $tableau[$i]['equipes'][$k] = $tableau[$i]['equipes'][$j];
                        $tableau[$i]['equipes'][$j] = $temp;
                    }
                }
            }
        }
        
        return $this->render('groupe/index.html.twig', ['groupes' => $tableau, 'competition' => $competition]);
    }

    /**
     * @Route("/new", name="groupe_new", methods="GET|POST")
     */
    public function new(Request $request, Competition $competition): Response
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $groupe->setCompetition($competition);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();

            return $this->redirectToRoute('groupe_index', array("competition" => $competition->getId()));
        }

        return $this->render('groupe/new.html.twig', [
            'groupe' => $groupe,
            'competition' => $competition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="groupe_show", methods="GET")
     */
    public function show(Groupe $groupe, Competition $competition): Response
    {
        return $this->render('groupe/show.html.twig', ['groupe' => $groupe, 'competition' => $competition]);
    }

    /**
     * @Route("/{id}/edit", name="groupe_edit", methods="GET|POST")
     */
    public function edit(Request $request, Groupe $groupe): Response
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('groupe_edit', ['id' => $groupe->getId(), 'competition' => $groupe->getCompetition()->getId()]);
        }

        return $this->render('groupe/edit.html.twig', [
            'groupe' => $groupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="groupe_delete", methods="DELETE")
     */
    public function delete(Request $request, Groupe $groupe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupe->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($groupe);
            $em->flush();
        }

        return $this->redirectToRoute('groupe_index', array("competition" => $competition->getId()));
    }
    
    /**
     * @Route("/generate/duels", name="groupe_genDuels", methods="GET")
     */
    public function generateDuels(GroupeRepository $groupeRepository, TypeDuelRepository
            $typeDuelRepository, Competition $competition): Response
    {
        $groupes = $groupeRepository->findBy(array("competition" => $competition));
        
        foreach ($groupes as $groupe) {
            $equipes = $groupe->getEquipes();
            for($i=0;$i<count($equipes);$i++)
            {
                for($j=$i+1;$j<count($equipes);$j++)
                {
                    $duel = new Duel();
                    $duel->setCompetition($competition);
                    $duel->setEquipe1($equipes[$i]);
                    $duel->setEquipe2($equipes[$j]);
                    $type_duel = $typeDuelRepository->findOneBy(array("code_type_duel" => Duel::DUEL_POULE));
                    $duel->setTypeDuel($type_duel);
                                       
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($duel);
                    $em->flush();
                }
            }
        }
        
        return $this->redirectToRoute('groupe_index', array("competition" => $competition->getId()));
    }
    
    /**
     * @Route("/ajax/test_duels", name="groupe_testDuel", methods="POST")
     */
    public function testDuels(): Response{
        
        $retour = array();
        $retour["testDuels"]["result"] = true;
        
        return new Response(json_encode($retour));
    }
}
