<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Follow;
use App\Entity\Report;
use App\Form\DataType;
use App\Form\PostType;
use App\Entity\Content;
use App\Entity\Civility;
use App\Entity\DataUser;
use App\Form\ReportsType;
use App\Entity\ImgContent;
use App\Form\CivilityType;
use App\Form\ImgContentType;
use App\Repository\ContentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/social", name="social")
     */
    public function social(UserInterface $user, ObjectManager $manager, Request $request)
    {   
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
            return $this->redirectToRoute('civility');        
        }

        // Publication
        $post = new Content();    
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // test si il y a au moins une valeur remplie (n'est pas vide)
            dump($request);
            $image = $request->files->get('post')['my_files'];
            $text = $request->request->get('post')['text'];
            if ($image != null OR $text != null) {
                $post->setUser($user)
                    ->setCreateAt(new \DateTime())
                    ->setEnable('1');
                
                $manager->persist($post);
                $manager->flush();

                // Les images

                // upload
                $files = $request->files->get('post')['my_files'];
                foreach ($files as $file) {
                    $upload_directory = $this->getParameter('upload_directory_post');
                    $filename = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move(
                        $upload_directory,
                        $filename
                    );
                    // associé l'image au post
                    $images = new ImgContent(); 
                    $images->setImg("assets/images/resources/post/$filename")
                        ->setContent($post);
                    $manager->persist($images);
                    $manager->flush();
                }
            }
            
        }
           
        $following = $user->getFollowers();
        $follower = $user->getFollowings();

        $i = 0;
        foreach ($following as $follow) {
            $IDtoSend[$i] = $follow->getFollowing();
            $i = $i + 1;
        }
        $limit = 50;

        $publication = $this->getDoctrine()->getRepository(Content::class)
                ->findPublication($IDtoSend, $limit);


        return $this->render('default/index.html.twig', [
            'controller_name' => 'Social',
            'followings' => $following ,
            'form' => $form->createView(),
            'followers' => $follower,
            'publications' => $publication,
        ]);
    }

    /**
     * @Route("/user/info/civilite", name="civility")
     */
    public function civility(UserInterface $user, ObjectManager $manager, Request $request)
    {
        // form
        // voir si l' entité existe
        $civil = $user->getCivility();
        if($civil == null){
            // si il est inexistant, créer le form
            $civil = new Civility();
        }
        $form = $this->createForm(CivilityType::class, $civil);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ajouter les photos de profil de base et background
                // fait quand le form est rempli pour obliger l'utilisateur a rentré son nom
            $userPP = $user->getDataUser();
            if($userPP == null){
                $userPP = new DataUser;
                $userPP->setLink("assets/images/resources/pf-img4.jpg")
                        ->setBgLink("assets/images/resources/cover-img.jpg")
                        ->setUser($user);
                $manager->persist($userPP);
                $manager->flush();
            }
            $civil->setUser($user);
            $manager->persist($civil);
            $manager->flush();
            $this->addFlash('success', 'Vos informations ont bien été enregistré !');
            return $this->redirectToRoute('social');
        }

        return $this->render('default/civility.html.twig', [
            'controller_name' => 'Civilité',
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/user/info/data", name="data")
     */
    public function data(UserInterface $user, ObjectManager $manager, Request $request)
    {
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
            return $this->redirectToRoute('civility');        
        }
       
        // voir si l' entité existe
        $data = $user->getDataUser();

        $form = $this->createForm(DataType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // upload PP 
            $file = $request->files->get('post')['link'];
                $upload_directory = $this->getParameter('upload_directory_pp');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $upload_directory,
                    $filename
                );
                $data->setLink("assets/images/resources/pp/$filename")
                    ->setContent($post);

            // // upload BG
            // $file = $request->files->get('post')['bgLink'];
            // $upload_directory = $this->getParameter('upload_directory_bg');
            // $filename = md5(uniqid()) . '.' . $file->guessExtension();
            // $file->move(
            //     $upload_directory,
            //     $filename
            // );
            // $data->setBgLink("assets/images/resources/bg/$filename");
              
            $manager->persist($data);
            $manager->flush();
            $this->addFlash('success', 'Vos informations ont bien été enregistré !');
            return $this->redirectToRoute('social');
        }

        return $this->render('default/data.html.twig', [
            'controller_name' => 'Utilisateur',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/Conditions", name="conditions")
     */
    public function conditions()
    {
        return $this->render('default/conditions.html.twig', [
            'controller_name' => 'Conditions',
        ]);
    }

    /**
     * @Route("/social/reports/{type}/{id}", name="reports")
     */
    public function reports(UserInterFace $user = null, ObjectManager $manager, Request $request)
    {
        // Test si la civilité est config - Add in all controller fnct
        $civility = $user->getCivility();
        if($civility == null){
            return $this->redirectToRoute('civility');
        }
        $type = $request->attributes->get('type');
        $id = $request->attributes->get('id');

        if($type == 1){
            $contentReported = $this->getDoctrine()->getRepository(Content::class)->findBy(array('id' => $id));
        }else if ($type == 2){
            $userReported = $this->getDoctrine()->getRepository(User::class)->findBy(array('id' => $id));
        }else{
            $commentReported = $this->getDoctrine()->getRepository(CommentContent::class)->findBy(array('id' => $id));
        }

        $report = new Report();
        $form = $this->createForm(ReportsType::class, $report);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $report->setCreateAt(new \DateTime());
            if($type == 1){
                $report->content($contentReported);
            }else if ($type == 2){
                $report->user($userReported);
            }else{
                $report->comment($commentReported);
            }
            if($user != null){
                $report->reportedBy($user);
            }
            if($user != null){
                $report->reportedBy($user);
            }
            $manager->persist($report);
            $manager->flush();
            $this->addFlash('success', 'L\'élément a bien était signalé');
            return $this->redirectToRoute('social');
            }
        

        return $this->render('default/reports.html.twig', [
            'controller_name' => 'Reports',
            'form' => $form->createView(),
            'type' => $type,
            'id' => $id,
        ]);
    }

}
