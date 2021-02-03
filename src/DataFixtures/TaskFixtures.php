<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('apéro'));
        $task->setDay('Monday');
        $task->setContent('Apéro Skype avec Charlotte et Laure');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('loisir'));
        $task->setDay('Tuesday');
        $task->setContent('Match de Tennis / tournois');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('maison'));
        $task->setDay('Wednesday');
        $task->setContent('Emmener les enfants à la piscine');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('maison'));
        $task->setDay('');
        $task->setContent('Passer le contrôle technique de la Polo');
        $task->setIsOfTheWeek(false);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('maison'));
        $task->setDay('');
        $task->setContent('Passer mon diplôme de plongée...plus tard !');
        $task->setIsOfTheWeek(false);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('urgent'));
        $task->setDay('Thursday');
        $task->setContent('Rendre le rapport TN12 !');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('loisir'));
        $task->setDay('Friday');
        $task->setContent('Escalade');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('urgent'));
        $task->setDay('Friday');
        $task->setContent('Payer le loyer!');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('maison'));
        $task->setDay('Saturday');
        $task->setContent('Week-end à la campagne');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('maison'));
        $task->setDay('Sunday');
        $task->setContent('Week-end à la campagne');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $task = new Task();
        $task->setAuthor($this->getReference('bonjour'));
        $task->setCategory($this->getReference('apéro'));
        $task->setDay('Sunday');
        $task->setContent('Apéro à la maison avec les potes');
        $task->setIsOfTheWeek(true);
        $manager->persist($task);

        $manager->flush();


    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            CategoryFixtures::class,
        );
    }
}
