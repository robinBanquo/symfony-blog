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

class LoadComment extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2; // number in which order to load fixtures
    }

    public function load(ObjectManager $manager)
    {


        for ( $i =0 ; $i < 20; $i++ ){
            $repository = $manager->getRepository('BlogBundle:Post');
            $Post = $repository->find($i%8);
            $comment = new Comment();
            $comment->setPost( $Post );
            $comment->setAuthor('commentateur num '.$i);
            $comment->setContent('Le passage de Lorem Ipsum standard, utilisé depuis 1500"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."');
            $manager->persist($comment);
        }
        $manager->flush();
    }
}