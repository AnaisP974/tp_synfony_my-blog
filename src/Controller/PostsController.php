<?php

namespace App\Controller;

use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostsController extends AbstractController
{
    #[Route('/posts', name: 'app_posts')]
    public function index(PostRepository $postRepo): Response
    {
        $posts = $postRepo->findBy(['is_public' => true]);
        
        return $this->render('posts/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    // #[Route('/n/{slug}', name: 'app_note_show', methods: ['GET'])]
    // public function show(string $slug, NoteRepository $nr): Response
    // {
    //     $note = $nr->findOneBySlug($slug);

    //     if (!$note) {
    //         throw $this->createNotFoundException('Note not found');
    //     }

    //     return $this->render('note/show.html.twig', [
    //         'note' => $note,
    //         'creatorNotes' => $nr->findByCreator($note->getCreator()->getId()),
    //     ]);
    // }

    #[Route('/post/{id}', name: 'app_post')]
    public function show(PostRepository $postRepo, $id, UserRepository $ur): Response
    {
        $post = $postRepo->find($id);
        
        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }
        // / Récupérer l'auteur du post
        $author = $ur->find($post->getSignature());

        return $this->render('posts/show.html.twig', [
            'post' => $post,
            'author' => $author
        ]);
    }
}
