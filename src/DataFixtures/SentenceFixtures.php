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
            'text' => 'C\'est ici que commençait le premier chapitre, entre le vert des feuilles de charmes et le chocolaté 
            des troncs de chênes. Cette balade en forêt aurait dû être normale, mais en y prêtant attention, on devinait ça 
            et là des boules multicolores. Encore et encore, plus on y regardait plus on en voyait...partout.',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'C\'est alors que sous une feuille surgit Lewis...un lapin...un minuscule lapin...rose...tout rose. 
            Lewis croqua dans un champignon puis se mit à grandir.',
            'chapter' => 'chapter_0',
        ],
        2 => [
            'text' => 'Les couleurs de tout ce qui l\'entourait devenaient psychedeliques.',
            'chapter' => 'chapter_0',
        ],

        3 => [
            'text' => 'Puis, tiraillé entre l\'audace et la curiosité, je décidais d\'attraper un champignon multicolore 
            et de l\'éplucher. C\'est bien ce que je pensais, sous les couleurs métallique le champignon était fait de chocolat. 
            Le plus onctueux chocolat que j\'ai jamais mangé.',
            'chapter' => 'chapter_0',
        ],
        4 => [
            'text' => 'Après une bouchée, je senti un pivotement dans les pieds. Puis le pivotement gagna les jambes le 
            ventre et la tête. C\'est alors que dans un soudain nuage violet, je rétrécit.brusquement en faisant un petit \'pop.',
            'chapter' => 'chapter_0',
        ],
        5 => [
            'text' => 'Mais l\'horreur guettait.... Une grosse dame en cycliste vint à passer par la l\'œil mesquin]',
            'chapter' => 'chapter_1',
        ],
        6 => [
            'text' => 'puis dans un nuage violet elle disparut. Pop !',
            'chapter' => 'chapter_1',
        ],
        7 => [
            'text' => 'Cette mégère en sandale se mit à crier si fort que les oreilles de Lewis en tomberent',
            'chapter' => 'chapter_2',
        ],
        8 => [
            'text' => 'T\'inquiètes, j\'ai du scotch, je vais te rabouter. En revanche je comment faire ralentisse ce rouleaux ?',
            'chapter' => 'chapter_2',
        ],
        9 => [
            'text' => 'Un gros chat de Cheshire vit la scène... Bien malin il se décida à se transformer en idiot du 
            village pour faire croire à la mégère qu\'e\'fin elle trouve un amoureux',
            'chapter' => 'chapter_3',
        ],
        10 => [
            'text' => '',
            'chapter' => 'chapter_4',
        ],
        11 => [
            'text' => '',
            'chapter' => 'chapter_5',
        ],
        12 => [
            'text' => '',
            'chapter' => 'chapter_6',
        ],
        13 => [
            'text' => '',
            'chapter' => 'chapter_7',
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
