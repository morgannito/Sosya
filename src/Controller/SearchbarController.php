<?php

namespace App\Controller;

use App\Entity\Civility;
use App\Repository\CivilityRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchbarController extends AbstractController
{
    #[Route('/search/', name: 'search')]
    public function search(Request $request, EntityManagerInterface $manager, UserInterface $user, CivilityRepository $civilityRepository)
    {
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
        return $this->redirectToRoute('civility');
        }

        $keyword = $request->query->get('word');

        $research = $civilityRepository->findByWord($keyword);

        return $this->render('searchbar/index.html.twig', [
            'controller_name' => 'search',
            'key' => $keyword,
            'research' => $research,
        ]);
    }

}
