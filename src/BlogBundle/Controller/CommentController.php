<?php
/**
 * Created by PhpStorm.
 * User: banquo
 * Date: 06/06/17
 * Time: 16:20
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class CommentController extends Controller
{
    public function addAction(Request $request){
        $comment = new Comment();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $comment);
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
            $em->persist($comment);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            return $this->redirectToRoute('blog_homepage');
        }
        return $this->render('BlogBundle:Default:add.html.twig', array(
            'form' =>$form->createview(),
        ));

    }
}