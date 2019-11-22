<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\LikeContent;
use App\Repository\LikeContentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * Gestion des likes (like / unlike)
     *
     * @Route("/jquery/like/{id}", name="like_this")
     * @param Content $post
     * @param ObjectManager $manager
     * @param UserInterface $user
     * @param LikeContentRepository $likeRepo
     * @return Response
     */
    public function like(Content $post, LikeContentRepository $likeRepo, ObjectManager $manager, UserInterface $user) : Response
    {
        if($post->isLikedByUser($user)) {
            $idLike = $post->getId();
            $idUser = $user->getId();
            $rawSql ="DELETE FROM like_content WHERE user_id = " .$idUser. " and content_id = " .$idLike. "";
            $stmt = $manager->getConnection()->prepare($rawSql);
            $stmt->execute();

            return $this->json([
                'code' => 200, 
                'message' => 'Vous n\'aimez plus cette publication',
                'likes' => $likeRepo->count(['content' => $post]),
                ], 200);
        }
        
        $LikeContent = new LikeContent();
        $LikeContent->setContent($post)
              ->setUser($user)
              ->setCreateAt(new \DateTime());
        
        $manager->persist($LikeContent);
        $manager->flush();
        return $this->json([
            'code' => 200, 
            'message' => 'Vous aimez cette publication',
            'likes' => $likeRepo->count(['content' => $post]),
            ]
            , 200);
    }

}
