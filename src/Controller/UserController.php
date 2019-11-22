<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Follow;
use App\Repository\FollowRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/social/user/page/{id}", name="user_page")
     */
    public function index(User $utilisateur, UserInterface $user = null, ObjectManager $manager)
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

    /**
     * @Route("/social/user/profil", name="user_page_profil")
     */
    public function profil(UserInterface $user, ObjectManager $manager)
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
     * @Route("/jquery/follow/{id}", name="follow_this")
     * @param User $utilisateur
     * @param ObjectManager $manager
     * @param UserInterface $user
     * @return Response
     */
    public function follow(User $utilisateur, ObjectManager $manager, UserInterface $user) : Response
    {   
        if($user != $utilisateur) {
            if($utilisateur->isFollowByUser($user)) {
                $idFollowed = $utilisateur->getId();
                $idUser = $user->getId();
                $rawSql ="DELETE FROM follow WHERE follower_id = " .$idUser. " and following_id = " .$idFollowed. "";
                $stmt = $manager->getConnection()->prepare($rawSql);
                $stmt->execute();

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

/**
* @Route("/user/postUser", name="postUser")
*/
public function postUser(User $utilisateur, UserInterface $user, ObjectManager $manager)
 {
    $civility = $user->getCivility();
    if($civility == null){
        return $this->redirectToRoute('civility');        
    }



    return $this->render('default/index.html.twig', [
        'controller_name' => 'Social',
        'followings' => $following ,
    ]);

 }


}
