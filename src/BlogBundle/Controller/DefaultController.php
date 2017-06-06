<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comment;
use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $listPosts = $repository->findAll();

        return $this->render('BlogBundle:Default:index.html.twig', array(
            "listPosts" => $listPosts,
        ));
    }

    public function addAction(Request $request)
    {
        $post = new Post();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $post);
        $formBuilder
            ->add('title',     TextType::class)
            ->add('content',   TextareaType::class)
            ->add('save',      SubmitType::class)
        ;
        $form = $formBuilder->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirectToRoute('blog_homepage');
        }
        return $this->render('BlogBundle:Default:add.html.twig', array(
            'form' =>$form->createview(),
        ));
    }

    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $Post = $repository->find($id);
        $Comments = $Post->getComments();

        $commentToAdd = new Comment();
        $commentToAdd->setPost($Post);
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $commentToAdd);
        $formBuilder
            ->add('author',     TextType::class)
            ->add('content',   TextareaType::class)
            ->add('save',      SubmitType::class)
        ;
        $form = $formBuilder->getForm();

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentToAdd);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Commentaire ajouté');

            return $this->redirectToRoute('blog_show', array('id'=>$id));
        }
        return $this->render('BlogBundle:Default:show.html.twig', array(
            'Post' => $Post,
            'Comments' => $Comments,
            'form' =>$form->createview()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $Post = $repository->find($id);
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $Post);
        $formBuilder
            ->add('content', TextareaType::class)
            ->add('save', SubmitType::class);
        $form = $formBuilder->getForm();
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            // On vérifie que les valeurs entrées sont correctes
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $Post->setEdited(true);
            $Post->setModifiedat();
            $em->persist($Post);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Votre annonce a bien été édité.');
            return $this->redirectToRoute('blog_show', array('id' => $id));
        }

        else {
            return $this->render('BlogBundle:Default:edit.html.twig', array(
                'form' => $form->createview(),
                'Post' => $Post,
            ));
        }
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BlogBundle:Post');
        $Post = $repository->find($id);
        $em->remove($Post);
        $em->flush();
        $request->getSession()->getFlashBag()->add('danger', 'Votre annonce a bien été supprimée.');
        return $this->redirectToRoute('blog_homepage');
    }
}
