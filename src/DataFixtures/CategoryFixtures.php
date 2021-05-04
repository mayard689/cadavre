<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    const CATEGORY_NUMBER=6;

    const CATEGORIES = [
      0 => [
          'name' => 'Fêtes',
      ],
        1 => [
            'name' => 'Culture',
        ],
        2 => [
            'name' => 'Repas',
        ],
        3 => [
            'name' => 'Confinés mais pas que',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i<self::CATEGORY_NUMBER; $i++){

            $category = new Category();

            if ($i < count(self::CATEGORIES)) {
                $category->setName(self::CATEGORIES[$i]['name']);
            } else {
                $category->setName($faker->word);
            }

            $this->addReference('category_' .$i, $category);

            $manager->persist($category);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['ContentFixtures'];
    }
}
