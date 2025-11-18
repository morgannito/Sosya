<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Follow;
use App\Repository\FollowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/social/user/page/{id}', name: 'user_page')]
    public function index(User $utilisateur, UserInterface $user = null, EntityManagerInterface $manager)
    {   
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
        return $this->redirectToRoute('civility');
        }

        return $this->render('user/user.html.twig', [
            'controller_name' => 'Page de profil de',
            'utilisateur' => $utilisateur,
            'user' => $user,
        ]);
    }

    #[Route('/social/user/profil', name: 'user_page_profil')]
    public function profil(UserInterface $user, EntityManagerInterface $manager)
    {
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
        return $this->redirectToRoute('civility');
        }

        return $this->render('user/profil.html.twig', [
            'controller_name' => 'Votre page de profil',
            'utilisateur' => $user,
        ]);
    }

    /**
     * Gestion des abonnements (follow / unfollow)
     *
     * @param User $utilisateur
     * @param EntityManagerInterface $manager
     * @param UserInterface $user
     * @return Response
     */
    #[Route('/jquery/follow/{id}', name: 'follow_this')]
    public function follow(User $utilisateur, EntityManagerInterface $manager, UserInterface $user) : Response
    {   
        if($user != $utilisateur) {
            if($utilisateur->isFollowByUser($user)) {
                $idFollowed = $utilisateur->getId();
                $idUser = $user->getId();
                $rawSql = "DELETE FROM follow WHERE follower_id = ? AND following_id = ?";
                $stmt = $manager->getConnection()->prepare($rawSql);
                $stmt->executeQuery([$idUser, $idFollowed]);

                return $this->json([
                    'code' => 200, 
                    'message' => 'Désabonné'
                    ], 200);
            }

            $follow = new Follow();
            $follow->setFollowing($utilisateur)
                ->setFollower($user);
            
            $manager->persist($follow);
            $manager->flush();
            return $this->json([
                'code' => 200, 
                'message' => 'Abonné']
                , 200);
        }
        return $this->json([
            'code' => 400, 
            'message' => 'Vous ne pouvez pas vous abonné à votre compte']
            , 400);
    }

#[Route('/user/postUser', name: 'postUser')]
public function postUser(User $utilisateur, UserInterface $user, EntityManagerInterface $manager)
 {
    $civility = $user->getCivility();
    if($civility == null){
        return $this->redirectToRoute('civility');
    }

    // Récupération des utilisateurs suivis
    $following = $user->getFollowing();

    return $this->render('default/index.html.twig', [
        'controller_name' => 'Social',
        'followings' => $following,
    ]);

 }


}
