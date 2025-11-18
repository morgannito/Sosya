<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AffiniteController extends AbstractController
{
    #[Route('/rencontre', name: 'affinite')]
    public function affinite(UserInterface $user, EntityManagerInterface $manager, Request $request, UserRepository $userRepository)
    {
        // Recup les activité de l'utilisateur
        $hobbies = $user->getHobbies();
        $i = 0;
        // si l'user n'a pas de hobbies
        $nameHobbiesUser = array();
        foreach ($hobbies as $keyHobbies) {
            $nameHobbiesUser[$i] = $keyHobbies->getActivity()->getName();
            $i++;
        }

        // recup le premier et le dernier utilisateur
        $idPremier = $userRepository
                        ->createQueryBuilder('u')
                        ->select('u.id')
                        ->orderBy('u.id', 'ASC')
                        ->setMaxResults(1)->getQuery()->getSingleResult();
        $idDernier = $userRepository
                        ->createQueryBuilder('u')
                        ->select('u.id')
                        ->orderBy('u.id', 'DESC')
                        ->setMaxResults(1)->getQuery()->getSingleResult();

        // recup le max / min du rdm
        $min = $idPremier['id'];
        $max = $idDernier['id'];
        
        // créer le nb de tirage 
        $total = $max - $min;
        if($total <= 15){
            $tirage = 3;
        } else if($total <= 45){
            $tirage = 15;
        } else {
            $tirage = 30;
        }

        // boucle de tirage nb aléa et pas identique
        $rdm = array();
        for ($i=0; $i < $tirage; $i++) {
            do {
                $random = random_int($min, $max);
            } while (in_array($random, $rdm));
            $rdm[] = $random;
        }

        // boucle recuperant les user et testant leur affinité
        $userTested = array();
        $a = 0;
        foreach($rdm as $id){
            // recup l'user
            $utilisateur = $userRepository->find($id);
            // recup les hobbies de cet user
            if($utilisateur){
                $hobbiesCompare = $utilisateur->getHobbies();
                $userTested[$a] = array('user' => $utilisateur);
                // hobbies name
                $i = 0;
                // si l'user n'a pas de hobbie
                $nameHobbiesUTilisateurSelected = array();
                foreach ($hobbiesCompare as $keyHobbies) {
                    $nameHobbiesUTilisateurSelected[$i] = $keyHobbies->getActivity()->getName();
                    $i++;
                }
            
                // comparer les deux utilisateurs
                $nbAffi = 0;
                foreach($nameHobbiesUser as $keyHobbiesName){
                    foreach($nameHobbiesUTilisateurSelected as $tested){
                        if($keyHobbiesName == $tested){
                            $nbAffi++;
                        }
                    }
                }
                $userTested[$a] = $userTested[$a] + array('affinité' => $nbAffi);

                $a++;
            }
            // si plus de point commun, 2->3 puis 1->2 et user->1
        }


        return $this->render('affinite/index.html.twig', [
            'controller_name' => 'AffiniteController',
            'userTested' => $userTested,
        ]);
    }
}
