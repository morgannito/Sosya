<?php

namespace App\Controller;

use App\Entity\Civility;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchbarController extends AbstractController
{
    /**
     * @Route("/search/", name="search")
     */
    public function search(Request $request , ObjectManager $manager, UserInterFace $user)
    { 
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
        return $this->redirectToRoute('civility');
        }
        
        $keyword = $request->query->get('word');
 
        $research = $this->getDoctrine()->getRepository(Civility::class)
            ->findByWord($keyword);

        return $this->render('searchbar/index.html.twig', [
            'controller_name' => 'search',
            'key' => $keyword,
            'research' => $research,
        ]);
    }

}
