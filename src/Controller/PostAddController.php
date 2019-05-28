<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class PostAddController extends AbstractController
{
    /**
     * @Route("/post/add", name="post_add")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class,  $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $post->setPublicationAt(new \DateTime("now"));
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_add_success');
        }

        return $this->render('post_add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post_add/success", name="post_add_success")
     */
    public function success()
    {
        return $this->render('post_add/success.html.twig');
    }
}
