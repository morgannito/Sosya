<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AffiniteController extends AbstractController
{
    /**
     * @Route("/rencontre", name="affinite")
     */
    public function affinite(UserInterface $user, ObjectManager $manager, Request $reques)
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
        $idPremier = $this->getDoctrine()->getRepository(User::class)
                        ->createQueryBuilder('u')
                        ->select('u.id')
                        ->orderBy('u.id', 'ASC')
                        ->setMaxResults(1)->getQuery()->getSingleResult();
        $idDernier = $this->getDoctrine()->getRepository(User::class)
                        ->createQueryBuilder('u')
                        ->select('u.id')
                        ->orderBy('u.id', 'DESC')
                        ->setMaxResults(1)->getQuery()->getSingleResult();

        // recup le max / min du rdm
        foreach($idPremier as $prem) {
            $min = $prem;
        }
        foreach($idDernier as $der) {
            $max = $der;
        }
        
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
        // peut être modifier ligne : $rdm[$i] = $random; et $i = 0; 
        $rdm = array();
        for ($i=0; $i < $tirage; $i++) { 
            $random = random_int($min, $max);
            foreach($rdm as $keyRDM) {
                if($keyRDM == $random){
                    $i = 0;
                }
            }
            $rdm[$i] = $random;
        }

        // boucle recuperant les user et testant leur affinité
        // $rank = array();
        // $un = 0;
        // $deux = 0;
        // $trois = 0;
        $userTested = array();
        $a = 0;
        foreach($rdm as $id){
            // recup l'user
            $userSelected = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $id));
            // $userSelected = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => '25'));
            // recup les hobbies de cet user
            foreach($userSelected as $utilisateur){
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

                // si plus de point commun, 2->3 puis 1->2 et user->1
            }
        }


        return $this->render('affinite/index.html.twig', [
            'controller_name' => 'AffiniteController',
            'userTested' => $userTested,
        ]);
    }
}
