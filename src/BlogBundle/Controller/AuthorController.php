<?php
/**
 * Created by PhpStorm.
 * User: audric
 * Date: 13/06/17
 * Time: 11:05
 */

namespace BlogBundle\Controller;

use UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthorController extends Controller
{
    public function indexByAuthorAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $UserRepository = $em->getRepository('UserBundle:User');
        $User = $UserRepository->find($id);
        // TODO : Vérifier que l'User est bien un ADMIN !

        return $this->render('BlogBundle:Author:index_by_author.html.twig', array(
            "title" => $User->getUsername(),
            "listPosts" => $User->getPosts()
        ));
    }

}