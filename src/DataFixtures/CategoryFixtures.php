<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName('Loisir');
        $this->addReference('loisir', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('pro');
        $this->addReference('pro', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Apéro');
        $this->addReference('apéro', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Maison');
        $this->addReference('maison', $category);
        $manager->persist($category);

        $category = new Category();
        $category->setName('Urgent');
        $this->addReference('urgent', $category);
        $manager->persist($category);

        $manager->flush();
    }
}
