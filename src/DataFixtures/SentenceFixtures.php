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
            C\'est aprés un réveil tourmenté qu\'Alice prenait son petit déjeuner en repensant à son rêve. Abeilles en As de pique, Oeuf géant violet et bleu...
            Carotarêve. La Carotarêve. Le nom reste mais impossible de se souvenir de ce que c\'est, la Carotarêve',
            'chapter' => 'chapter_0',
        ],

        1 => [
            'text' => 'A l\'école, toujours troublée par la Carotarêve, Alice croise son amie Rebecca devant l\'oeuf géant 
            préparé par le comité des fêtes. Alors qu\'elle lui parle de son rêve bizarre, le lapin planté devant l\'oeuf s\'anime et se met à parler.
            Un lapin...un minuscule lapin...blanc...tout blanc...qui parle. C\'est peu commun.',
            'chapter' => 'chapter_1',
        ],

        2 => [
            'text' => 'Revenant à la réalité, Alice dit au Lapin : "Je veux savoir ce qu\'est la Carotarêve.". 
            Ce à quoi la lapin répondit "Tu veux savoir ce qu\'est la Carotarêve, je ne peux te le dire. Mais je peux te 
            montrer le chemin vers la forêt multicolore". C\'est alors que les nuages se mirents à onduler, parfois oranges 
            ou bleus, parfois allongés ou arrondis. Le lapin ajoutait d\'une voix déformée en regardant sa montre à gousset 
            "Le moment venu, faites attention à ne pas être en retard". 
            Quand Lewis et Rebecca comprirent ce qui leur arrivait, ils étaient dans une forêt peu banale... comment dire ? Multicolore.',
            'chapter' => 'chapter_2',
        ],
        3 => [
            'text' => 'Rebecca marcha sur un oeuf ! Une oeuf aussi dur devait être fait de béton ! sans se casser, il se 
            mit à rouler et Rebacca de glisser. Apres plusieurs tours sur elle même, elle fini sa cascade dans la rivière. Alice sauta pour aller l\'aider.
            Poissons volants, bulles géantes, algues écarlates et pêcheurs fous, cette rivière fourmillait d\'étrangetés.',
            'chapter' => 'chapter_3',
        ],
        4 => [
            'text' => 'Sortis de la rivière on ne sait trop comment, nos amis furent séchés en un rien de temps par des papillons-seches-cheveux venus leur prêter main forte. 
            Reprenant leur calme peu à peu, Alice, rebecca et le lapin blanc remarquèrent les 3 portes devant eux avec ce petit panneaux 
            "Préférez vous avoir le choix ou l\'embarras ? Peu importe si vous ne trouvez pas la Carotarêve, c\'est elle qui vous cherchera.".
            Rebecca s\'écria alors : "Il faut passer par cette porte ci !"',
            'chapter' => 'chapter_4',
        ],
        5 => [
            'text' => 'Reprenant leur chemin, les 3 explorateurs avancent dans la forêt. Le chemin est tortueux et chaque 
            virage leur fait découvrir, entre feuilles et branches, des créatures peu communes : un champ de cartes de trèfle, 
            des abeilles en as de pique, ou des singes qui se tiennent à carreau. Mais finalement, alors que la foret semblait interminable, tout disparut soudainement.
            Le lapin blanc haussa un sourcil et leur dit "nous y voilà. Nous sommes dans la clairière chocolatée". Il regarda sa montre puis la secoua. Un peu plus 
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
            Lucie et Honorine passèrent par là sans remarquer la Carotarêve. Elles leur disent :',
            'chapter' => 'chapter_7',
        ],

        //additionnal chapters for children
        8 => [
            'text' => 'L\'école de Villereau cache une étrange créature : la Carotarêve. Alice, Rebecca et un lapin blanc 
            qui parle l\'ont caché dans la cour avant que l\'école ne s\'arrête il y a trois semaines. Aujourd\'hui c\'est 
            la rentrée des classes et les trois amis se dépêchent d\'aller la voir. Il sont étonnés de découvrir que la Carotarêve n\'est plus seule : elle est accompagnée
            d\'une mini Carotarêve. A quoi ressemble la mini Carotarêve ? C\'est simple, je vais vous le dire.
            ',
            'chapter' => 'chapter_8',
        ],
        9 => [
            'text' => 'Alice aime beaucoup cette mini Carotarêve. Elle la chatouille pour l\'amuser. Des champignons en 
            chocolat se mettent à pousser dans la cour. \'pop!\' \'pop!\' \'pop!\' Partout \'pop!\' ils apparaissent \'pop!\'.
            Alice se souvient que la dernière fois qu\'elle en a croqué un champignons en chocolat, ils sont tous devenus énormes. 
            Tout a failli exploser. Cette fois elle n\'y touchera pas. Un petit garçon arrive à coté d\'elle, ramasse un champignon, 
            lui fait un sourire et le croque. Alice a peur, elle devient toute bleue. Mais cette fois le chocolat ne se met pas à grossir. 
            Il se passe quelque chose de trés différent mais trés bizarre quand même.
            ',
            'chapter' => 'chapter_9',
        ],
        10 => [
            'text' => 'Vite, il faut faire quelque chose ! Devant tout ce bazarre, le lapin sort sa montre magique. Il change l\'heure.
             Instantanément, tout redevient normal...En fait tout n\est pas completement normal :  Il y a toujours plein de champignons en chocolat dans la cour. Honorine 
             et Lucie arrivent. Rebecca dit à Alice : "Alice, où allons nous cacher tout ce chocolat ?"
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
