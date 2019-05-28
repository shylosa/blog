<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post/add", name="post_add")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $post->setPublicationAt(new \DateTime("now"));
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_success');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/post/success", name="post_success")
     */
    public function success()
    {
        return $this->render('post/success.html.twig');
    }

    /**
     * @Route("/post/{id}/edit", name="post_edit")
     */
    public function edit(PostRepository $postRepository)
    {
        $post = $postRepository->find('id');
        $form = $this->createForm(PostType::class, $post);

        return $this->render('post/edit.html.twig', [
            'form' => $form->createView(), 'post' => $post
        ]);
    }

    /**
     * @Route("/post/edit_success", name="post_edit_success")
     */
    public function editSuccess()
    {
        return $this->render('post/edit_success.html.twig');
    }
}
