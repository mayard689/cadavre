<?php

namespace App\DataFixtures;

use App\Entity\Sentence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SentenceFixtures extends Fixture implements DependentFixtureInterface
{
    const SENTENCES = [
        0 => [
            'text' => 'C\'est ici que commençait le premier chapitre, entre le vert des feuilles de charmes et le chocolaté des troncs de chênes. Cette balade en forêt aurait dû être normale, mais en y prêtant attention, on devinait ça et là des boules multicolores. Encore et encore, plus on y regardait plus on en voyait...partout.',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'C\'est alors que sous une feuille surgit Lewis...un lapin...un minuscule lapin...rose...tout rose. Lewis croqua dans un champignon puis se mit à grandir.',
            'chapter' => 'chapter_0',
        ],

        2 => [
            'text' => '[debut chap 2]',
            'chapter' => 'chapter_1',
        ],
    ];


    public function load(ObjectManager $manager)
    {
        for($i=0; $i<count(self::SENTENCES); $i++){

            $sentence = new Sentence();
            $sentence->setText(self::SENTENCES[$i]['text']);
            $chapter = $this->getReference(self::SENTENCES[$i]['chapter']);
            $sentence->setChapter($chapter);

            $this->addReference('sentence_' .$i, $sentence);
            $manager->persist($sentence);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [ChapterFixtures::class];
    }
}
