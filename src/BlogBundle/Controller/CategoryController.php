<?php
/**
 * Created by PhpStorm.
 * User: audric
 * Date: 13/06/17
 * Time: 11:05
 */

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
class CategoryController extends Controller
{
public function indexByCategoryAction($id, Request $request)
{
    $em = $this->getDoctrine()->getManager();
    $categoryRepository = $em->getRepository('BlogBundle:Category');
    $Category = $categoryRepository->find($id);


    return $this->render('BlogBundle:Category:index_by_category.html.twig', array(
        "title" => $Category->getName(),
        "listPosts" => $Category->getPosts()
    ));
}

}