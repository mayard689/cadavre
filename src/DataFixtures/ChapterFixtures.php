<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChapterFixtures extends Fixture
{
    const CHAPTERS = [
        0 => [
            'introduction' => 'intro chapitre 1',
            'conclusion' => 'conclu chapitre 1',
            'title' => 'Un levé de soleil multicolore',
            'code' => 'code1'
        ],

        1 => [
            'introduction' => 'intro chapitre 2',
            'conclusion' => 'conclu chapitre 2',
            'title' => 'sucré, cacaoté ,gonflé',
            'code' => 'code2'
        ],

        2 => [
            'introduction' => 'intro chapitre 3',
            'conclusion' => 'conclu chapitre 3',
            'title' => 'Un océan de senteurs',
            'code' => 'code3'
        ],

        3 => [
            'introduction' => 'intro chapitre 4',
            'conclusion' => 'conclu chapitre 4',
            'title' => 'Touché !',
            'code' => 'code4'
        ],

        4 => [
            'introduction' => 'intro chapitre 5',
            'conclusion' => 'conclu chapitre 5',
            'title' => 'Le silencieux vacarme',
            'code' => 'code5'
        ],
    ];


    public function load(ObjectManager $manager)
    {
        for($i=0; $i<count(self::CHAPTERS); $i++){

            $chapter = new Chapter();
            $chapter->setIntroduction(self::CHAPTERS[$i]['introduction']);
            $chapter->setConclusion(self::CHAPTERS[$i]['conclusion']);
            $chapter->setTitle(self::CHAPTERS[$i]['title']);
            $chapter->setCode(self::CHAPTERS[$i]['code']);

            $this->addReference('chapter_' .$i, $chapter);
            $manager->persist($chapter);
        }

        $manager->flush();
    }
}
