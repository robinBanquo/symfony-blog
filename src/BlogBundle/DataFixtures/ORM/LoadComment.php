<?php
/**
 * Created by PhpStorm.
 * User: banquo
 * Date: 06/06/17
 * Time: 12:38
 */

namespace BlogBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Comment;
use UserBundle\Entity\User;

class LoadComment extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 4; // number in which order to load fixtures
    }

    public function load(ObjectManager $manager)
    {


        for ( $i =0 ; $i < 20; $i++ ){
            $PostRepository = $manager->getRepository('BlogBundle:Post');
            $Posts = $PostRepository->findAll();
            shuffle($Posts);
            $UserRepository = $manager->getRepository('UserBundle:User');
            $Users= $UserRepository->findAll();
            shuffle($Users);
            $comment = new Comment();
            $comment->setPost( $Posts[0] );
            $comment->setUser( $Users[0]);
            $comment->setContent('Le passage de Lorem Ipsum standard, utilisé depuis 1500"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."');
            $manager->persist($comment);
        }
        $manager->flush();
    }
}