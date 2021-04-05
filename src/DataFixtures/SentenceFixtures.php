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
            'text' => 'Une forme floue flottait et se déformait. Allongée ou arrondie, orange ou bleue, elle ondulait dans un brouillard. 
            Un rayon de Soleil... le chant d\'un oiseau..., le réveil qui sonnait...qui sonnait ! L\'école !. Un bond hors du lit, un saut dans des vêtements. 
            Mais au fait, il n\'y a pas d\'école le lundi de Pâques. Aprés ce réveil tourmenté qu\'Alice prenait son petit déjeuner en repensant à son rêve. Abeilles en As de pique, Oeuf géant violet et bleu...
            Carotarêve. La Carotarêve. Le nom restait mais impossible de se souvenir de ce qu\'était... une Carotarêve',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'Toujours troublée par la Carotarêve, Alice a donné rendez-vous à son amie Rebecca devant l\'oeuf géant 
            préparé par le comité des fêtes, devant l\'école. Alors qu\'elle lui parlait de son rêve bizarre, le lapin planté devant l\'oeuf s\'est animé et se mit à parler.
            Un lapin...un minuscule lapin...blanc...tout blanc...qui parle. C\'etait peu commun.',
            'chapter' => 'chapter_1',
        ],

        2 => [
            'text' => 'Revenant à la réalité, Alice dit au Lapin : "Je veux savoir ce qu\'est la Carotarêve.". 
            Ce à quoi la lapin répondit "Tu veux savoir ce qu\'est la Carotarêve, je ne peux te le dire. Mais je peux te 
            montrer le chemin vers la forêt multicolore". C\'est alors que les nuages se mirents à onduler, parfois oranges 
            ou bleus, parfois allongés ou arrondis. Le lapin ajoutait d\'une voix déformée en regardant sa montre à gousset 
            "Le moment venu, faites attention à ne pas être en retard". 
            Quand Alice et Rebecca comprirent ce qui leur arrivait, ils étaient dans une forêt peu banale... comment dire ? Multicolore.',
            'chapter' => 'chapter_2',
        ],
        3 => [
            'text' => 'Rebecca marcha sur un oeuf ! Une oeuf aussi dur devait être fait de béton ! sans se casser, il se 
            mit à rouler et Rebacca de glisser. Apres plusieurs tours sur elle même, elle fini sa cascade dans la rivière. Alice sauta pour aller l\'aider.
            Poissons volants, bulles géantes, algues écarlates et pêcheurs fous, cette rivière fourmillait d\'étrangetés.',
            'chapter' => 'chapter_3',
        ],
        4 => [
            'text' => 'Sortis de la rivière on ne sait trop comment, nos amis furent séchés en un rien de temps par des 
            papillons-seches-cheveux venus leur prêter main forte. 
            Reprenant leur calme peu à peu, Alice, rebecca et le lapin blanc remarquèrent les 3 portes devant eux avec ce petit panneaux 
            "Préférez vous avoir le choix ou l\'embarras ?".
            Rebecca s\'écria alors : "Il faut passer par cette porte ci !"',
            'chapter' => 'chapter_4',
        ],
        5 => [
            'text' => 'Reprenant leur chemin, les 3 explorateurs avancaient dans la forêt. Le chemin etait tortueux et chaque 
            virage leur faisait découvrir, entre feuilles et branches, des créatures peu communes : un champ de cartes de trèfle, 
            des abeilles en as de pique, ou des singes qui se tiennent à carreau. Mais finalement, alors que la foret semblait interminable, tout disparut soudainement.
            Le lapin blanc haussa un sourcil et leur dit "Nous y voilà. Nous sommes dans la clairière chocolatée". Il regarda sa montre puis la secoua. Un peu plus 
            loin se trouvait un nid et dans le nid, aucun doute, la Carotarêve était là. Bizarre, obscure et sombre.',
            'chapter' => 'chapter_5',
        ],
        6 => [
            'text' => 'Satisfaite de sa découverte tant convoitée mais quand même bien fatiguée, Alice ramassa un champignon 
            métallique par terre. Elle l\'éplucha puis croqua dedans, profitant de cette exquise saveur chocolatée. 
            Au moment même où résonna le croquement chocolaté, le sol se mit à trembler. Les champignons de la 
            clairière se mirent à gonfler lentement. La montre du lapin de mit à sonner dans un "dring" qui rappelait le 
            réveil d\'Alice. "Vite, je vous avais prévenu, il est l\'heure de ne pas être en retard. Partons avant que tous 
            ça ne se termine en fondue au chocolat". Alice attrappa la Carotarêve et se mit à courir. Le "dring" se faisait 
            de plus en plus fort, de plus en plus sourd pour devenir le son assourdissant d\'une cloche.',
            'chapter' => 'chapter_6',
        ],
        7 => [
            'text' => 'C\'est alors que les nuages se mirents à onduler, parfois oranges 
            ou bleus, parfois allongés ou arrondis. Une voix déformée leur dit, "Faites attention à ne pas être en retard". 
            Alice et Rebecca étaient revenues à l\'école. Ne sachant que faire de la Carotarêve, elle décidèrent de la cacher parmi les plantations. 
            Les maîtresses ayant remarqué des choses étranges passèrent par là. Sans remarquer la Carotarêve, elles leur dirent :',
            'chapter' => 'chapter_7',
        ],

        //additionnal chapters for children
        8 => [
            'text' => 'L\'école de Villereau cache une étrange créature : la Carotarêve. Alice, Rebecca et le Lapin Blanc 
            (qui sait parler) l\'ont caché dans la cour avant que l\'école ne s\'arrête il y a trois semaines. Aujourd\'hui c\'est 
            la rentrée des classes et les trois amis se dépêchent d\'aller voir la Carotarêve. Il sont étonnés de découvrir que la 
            Carotarêve n\'est plus seule : elle est accompagnée d\'une mini Carotarêve. 
            A quoi ressemble la mini Carotarêve ? C\'est simple, je vais vous le dire.
            ',
            'chapter' => 'chapter_8',
        ],
        9 => [
            'text' => 'Alice aime beaucoup cette mini Carotarêve. Elle la chatouille pour l\'amuser. Tout à coup, des champignons en 
            chocolat se mettent à pousser dans la cour. \'pop!\' \'pop!\' \'pop!\' Partout \'pop!\' ils apparaissent \'pop!\'.
            Un petit garçon arrive à coté d\'Alice, il ramasse un champignon, il lui fait un sourire et le croque. 
            Alice sait qu\'un champignon en chocolat ce n\'est pas normal? Elle a peut, elle devient toute bleue. 
            Mais cette fois le chocolat ne se met pas à grossir. 
            Il se passe quelque chose de trés différent mais trés bizarre quand même. Vous savez quoi ?
            ',
            'chapter' => 'chapter_9',
        ],
        10 => [
            'text' => 'Vite, il faut faire quelque chose ! Devant tout ce bazarre, le lapin sort sa montre magique. Il change l\'heure.
             Instantanément, tout redevient normal...Tout ? Non, tout n\est pas completement normal :  Il y a toujours plein de champignons 
             en chocolat dans la cour. Les maîtresses arrivent. Rebecca dit à Alice : "Alice, où allons nous cacher tout ce chocolat ?"
            ',
            'chapter' => 'chapter_10',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        for($k=0; $k<count(self::SENTENCES); $k++){

            $sentence = new Sentence();
            $sentence->setText(self::SENTENCES[$k]['text']);
            $chapter = $this->getReference(self::SENTENCES[$k]['chapter']);
            $sentence->setChapter($chapter);
            for ($secret = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != 10; $x = rand(0,$z), $secret .= $a{$x}, $i++);
            $sentence->setSecret($secret);

            $this->addReference('sentence_' .$k, $sentence);
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
