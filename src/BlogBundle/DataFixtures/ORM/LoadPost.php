<?php
// src/AppBundle/DataFixtures/LoadUserData.php

 namespace BlogBundle\DataFixtures\ORM;

 use BlogBundle\Entity\Image;
 use Doctrine\Common\DataFixtures\AbstractFixture;
 use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
 use Doctrine\Common\Persistence\ObjectManager;
use BlogBundle\Entity\Post;
 use BlogBundle\Entity\Category;

class LoadPost extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 3; // number in which order to load fixtures
    }
    public function load(ObjectManager $manager)
    {
        for ( $i =0 ; $i < 10; $i++ ){
            $image = new Image();
            $image->setUrl('http://www.tattoo-tatouages.com/wp-content/uploads/2010/02/britney-spears40.jpg');

            $post = new Post();
            $post->setTitle('Article n°'.$i);
            $post->setContent('Le passage de Lorem Ipsum standard, utilisé depuis 1500
    
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            
            Section 1.10.32 du "De Finibus Bonorum et Malorum" de Ciceron (45 av. J.-C.)
            
            "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
            
            Traduction de H. Rackham (1914)
            
            "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"');
            $post->setImage($image);
            $user_repository = $manager->getRepository('UserBundle:User');
            $adminsNames = ["Dieu", "LaMeufADieu"];
            shuffle($adminsNames);
            $user = $user_repository->findOneBy(array('username' => $adminsNames[0]));
            $post->setUser($user);
            $cat_repository = $manager->getRepository('BlogBundle:Category');
            $category = $cat_repository->findAll();
            shuffle($category);
            $post->addCategory( $category[0]);
            $post->addCategory( $category[1]);
            $manager->persist($post);
        }
        $manager->flush();
    }

}