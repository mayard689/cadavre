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
            'text' => 'Une forme floue flotte et se déforme. Allongée ou arrondie, orange ou bleue, elle ondule dans un brouillard. 
            Un rayon de Soleil... un oiseau qui chante..., le réveil qui sonne...qui sonne ! L\'école !. C\'est aprés un réveil tourmenté que Lewis prenait son petit déjeuner.',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'A l\'école, toujours troublé par la Carotarêve, Lewis décide d\'en parler à son amie Rebecca. C\'est alors que sous une feuille surgit...un lapin...un minuscule lapin...rose...tout rose.',
            'chapter' => 'chapter_1',
        ],
        2 => [
            'text' => 'Les couleurs de tout ce qui l\'entourait devenaient psychedeliques.',
            'chapter' => 'chapter_2',
        ],

        3 => [
            'text' => 'Revenant à la réalité, Lewis dit au Lapin : "Je veux savoir ce qu\'est la Carotarêve.". 
            Ce à quoi la lapin répondit "Tu veux savoir ce qu\'est la Carotarêve, je ne peux te le dire. Mais je peux te 
            montrer le chemin vers la forêt multicolore". C\'est alors que les nuages se mirents à onduler, parfois orange 
            ou bleu, parfois allongés ou arrondis. Quand Lewis et Rebecca comprirent ce qui leur arrivait, ils étaient dans une forêt peu banale.',
            'chapter' => 'chapter_3',
        ],
        4 => [
            'text' => 'Rebecca marcha sur un oeuf ! Loin de sa casser, il se mit à rouler et Rebacca de glisser. Apres plusieurs tours sur elle même, elle fini sa cascade dans la rivière. Lewis sauta pour aller l\'aider.',
            'chapter' => 'chapter_4',
        ],
        5 => [
            'text' => 'Mais l\'horreur guettait.... Une grosse dame en cycliste vint à passer par là l\'œil mesquin]',
            'chapter' => 'chapter_5',
        ],
        6 => [
            'text' => 'puis dans un nuage violet elle disparut. Pop !',
            'chapter' => 'chapter_6',
        ],
        7 => [
            'text' => 'Cette mégère en sandale se mit à crier si fort que les oreilles de Lewis en tomberent',
            'chapter' => 'chapter_7',
        ],
        8 => [
            'text' => 'Lewis pense...',
            'chapter' => 'chapter_0',
        ],

        9 => [
            'text' => 'C\'est ici que commençait le premier chapitre, entre le vert des feuilles de charmes et le chocolaté 
            des troncs de chênes. Cette balade en forêt aurait dû être normale, mais en y prêtant attention, on devinait ça 
            et là des boules multicolores. Encore et encore, plus on y regardait plus on en voyait...partout.',
            'chapter' => 'chapter_0',
        ],

        10 => [
            'text' => 'C\'est alors que sous une feuille surgit Lewis...un lapin...un minuscule lapin...rose...tout rose. 
            Lewis croqua dans un champignon puis se mit à grandir.',
            'chapter' => 'chapter_0',
        ],
        11 => [
            'text' => 'Les couleurs de tout ce qui l\'entourait devenaient psychedeliques.',
            'chapter' => 'chapter_0',
        ],

        12 => [
            'text' => 'Puis, tiraillé entre l\'audace et la curiosité, je décidais d\'attraper un champignon multicolore 
            et de l\'éplucher. C\'est bien ce que je pensais, sous ses couleurs métalliques le champignon était fait de chocolat. 
            Le plus onctueux chocolat que j\'ai jamais mangé.',
            'chapter' => 'chapter_0',
        ],
        13 => [
            'text' => 'Après une bouchée, je senti un picotement dans les pieds. Puis le picotement gagna les jambes le 
            ventre et la tête. C\'est alors que dans un soudain nuage violet je rétrécit, brusquement, en faisant un petit \'pop\'.',
            'chapter' => 'chapter_0',
        ],
        14 => [
            'text' => 'Mais l\'horreur guettait.... Une grosse dame en cycliste vint à passer par là l\'œil mesquin]',
            'chapter' => 'chapter_1',
        ],
        15 => [
            'text' => 'puis dans un nuage violet elle disparut. Pop !',
            'chapter' => 'chapter_1',
        ],
        16 => [
            'text' => 'Cette mégère en sandale se mit à crier si fort que les oreilles de Lewis en tomberent',
            'chapter' => 'chapter_2',
        ],
        17 => [
            'text' => 'T\'inquiètes, j\'ai du scotch, je vais te rabouter. En revanche je comment faire rapetisser ce rouleaux ?',
            'chapter' => 'chapter_2',
        ],
        18 => [
            'text' => 'Un gros chat de Cheshire vit la scène... Bien malin il se décida à se transformer en idiot du 
            village pour faire croire à la mégère qu\'e\'fin elle trouve un amoureux',
            'chapter' => 'chapter_3',
        ],
        19 => [
            'text' => '',
            'chapter' => 'chapter_4',
        ],
        20 => [
            'text' => '',
            'chapter' => 'chapter_5',
        ],
        21 => [
            'text' => '',
            'chapter' => 'chapter_6',
        ],
        22 => [
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
