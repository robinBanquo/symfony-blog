<?php


namespace BlogBundle\DataFixtures\ORM;

use BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategory extends AbstractFixture implements OrderedFixtureInterface
{
    private $categoriesTable = ["#CéCuiKiDitKiEst",
        "#PasDeViolenceCéLéVacances",
        "#PoudreDePerlinpinpin",
        "#MonterSesSeinDansLaFriendzone",
        "#RendsLesSous!",
        "#JaiDébugéLeTrucANadine"];
    public function getOrder()
    {
        return 1; // number in which order to load fixtures
    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->categoriesTable as $category_name){
            $category = new Category();
            $category->setName($category_name);
            $manager->persist($category);
        }
        $manager->flush();
    }
}