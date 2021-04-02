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
            Un rayon de Soleil... un oiseau qui chante..., le réveil qui sonne...qui sonne ! L\'école !. Un bond hors du lit, un saut dans des vêtements. 
            C\'est aprés un réveil tourmenté qu\'Alice prenait son petit déjeuner en repensant à son rêve.',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'A l\'école, toujours troublé par la Carotarêve, Alice croise son amie Rebecca devant l\oeuf géant 
            préparé par le comité des fêtes. Alorts qu\'il lui parle de son rêve bizarre, le lapin planté devant l\'oeuf s\'anime et se met à parler.
            Un lapin...un minuscule lapin...blanc...tout blanc...qui parle. C\'est peu commun',
            'chapter' => 'chapter_1',
        ],

        2 => [
            'text' => 'Revenant à la réalité, Alice dit au Lapin : "Je veux savoir ce qu\'est la Carotarêve.". 
            Ce à quoi la lapin répondit "Tu veux savoir ce qu\'est la Carotarêve, je ne peux te le dire. Mais je peux te 
            montrer le chemin vers la forêt multicolore". C\'est alors que les nuages se mirents à onduler, parfois orange 
            ou bleu, parfois allongés ou arrondis. Le lapin ajoutait d\'une voix déformée en regardant sa montre à gousset 
            "Le moment venu, faites attention à ne pas être en retard". 
            Quand Lewis et Rebecca comprirent ce qui leur arrivait, ils étaient dans une forêt peu banale... comment dire ? Multicolore.',
            'chapter' => 'chapter_3',
        ],
        3 => [
            'text' => 'Rebecca marcha sur un oeuf ! Une oeuf aussi dur devait être fait de béton ! sans se casser, il se 
            mit à rouler et Rebacca de glisser. Apres plusieurs tours sur elle même, elle fini sa cascade dans la rivière. Alice sauta pour aller l\'aider.
            Poissons volants, bulles géantes, algues écarlates et pêcheurs fous, cette rivière fourmillait d\'étrangetés.',
            'chapter' => 'chapter_4',
        ],
        4 => [
            'text' => 'Sortis de la rivière on ne sait trop comment, nos amis fure séché en un rien de temps par des abeilles-seches-cheveux venu leur prêter main forte. 
            Reprenant leur calme peu à peu, Alice, rebecca et le lapin blanc remarquèrent les 3 portes devant eux avec ce petit panneaux 
            "Préférez vous avoir le choix ou l\'embarras ? Peu importe si vous ne trouvez pas la Carotarêve, c\'est elle qui vous cherchera.".
            Rebecca s\'écria alors : "je sais quelle porte utiliser !"',
            'chapter' => 'chapter_5',
        ],
        5 => [
            'text' => 'Reprenant leur chemin, les 3 explorateurs avancent dans la forêt. Le chemin est sinueux et chaque 
            virage leur fait découvrir, entre feuilles et branches, des créatures peu communes : un champs de cartes de treffle, 
            des abeilles en as de pique, ou des singes qui se tiennent à carreau". Mais finalement, alors que la foret semblait interminable, tout disparut soudainement.
            Le lapin blanc aussi un sourcil et leur dit "nous y voilà. Nous sommes dans la clairière magique". Un peu plus 
            loin se trouvait un nid et dans le nid, aucun doute, la Carotarêve était là. Bizarre, obscure et sombre.',
            'chapter' => 'chapter_6',
        ],
        6 => [
            'text' => 'Satisfaite de sa découverte tant convoitée mais quand même bien fatiguée, Alice ramassa un champignon 
            métallique par terre. Elle l\'éplucha puis croqua dedans, profitant de cet exquise saveur chocolatée. 
            Au moment même ou on entendit le croquement chocolaté, le sol se mit à trembler. Les champignons de la 
            clairière se mirent à gonfler lentement. La montre du lapin de mit à sonner dans un "dring" qui rappelait le 
            réveil d\'Alice. "Vite, je vous avais prévenu, il est l\'heure de ne pas être en retard. Partons avant que tous 
            ça ne se termine en fondue au chocolat". Alice attrape la Carotarêve et se met à courir.',
            'chapter' => 'chapter_7',
        ],
        7 => [
            'text' => 'C\'est alors que les nuages se mirents à onduler, parfois oranges 
            ou bleus, parfois allongés ou arrondis. Une voix déformée leur dit, "Faites attention à ne pas être en retard". 
            Alice et Rebecca étaient revenues à l\'école. Ne sachant que faire de la Carotarêve, elle décidèrent de la cacher parmi les plantations. 
            Lucy et Honorine passèrent par là sans remarquer la Carotarêve.',
            'chapter' => 'chapter_8',
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
