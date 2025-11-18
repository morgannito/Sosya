<?php

namespace App\Controller;

use App\Entity\Content;
use App\Entity\LikeContent;
use App\Repository\LikeContentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * Gestion des likes (like / unlike)
     *
     * @param Content $post
     * @param EntityManagerInterface $manager
     * @param UserInterface $user
     * @param LikeContentRepository $likeRepo
     * @return Response
     */
    #[Route('/jquery/like/{id}', name: 'like_this')]
    public function like(Content $post, LikeContentRepository $likeRepo, EntityManagerInterface $manager, UserInterface $user) : Response
    {
        if($post->isLikedByUser($user)) {
            // Utiliser Doctrine ORM au lieu de SQL brut
            $like = $likeRepo->findOneBy([
                'user' => $user,
                'content' => $post
            ]);

            if ($like) {
                $manager->remove($like);
                $manager->flush();
            }

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
