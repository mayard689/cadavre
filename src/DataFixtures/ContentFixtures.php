<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ContentFixtures extends Fixture implements DependentFixtureInterface
{
    const CONTENT_NUMBER=3;

    const CONTENT = [
        0 => [
            'title' => 'Marche de pa-Paques.',
            'text' => 'Une marche de Pâques reportée n\'est certainement pas une marche de Pâques, c\'est une marche de pas...Pâques.
            
            Venez nous retrouver sur ce parcours de 4 ou 8km pour découvrir la nature des environs de Villereau. Ce parcours mini est idéal pour une bouffée d\'oxygène avec les plus petits.
            Sur le parcours, quelques indices sur les insectes et culture locales, c\'est une marche instructive !
            ',
            'picture' => 'godasse.jpg',
        ],
        1 => [
            'title' => 'Etrange oeuf.',
            'text' => 'En sortant de l\'école ce jeudi premier avril, les enfants de l\'école de Villereau ont fait la découverte d\'un 
            étrange oeuf. 
            Une partie du décor prévu pour la marche de Pâques (annulée par précautions sanitaires) a été installé devant l\école ! 
            Et donc nos enfants ont découvert avec un lapin sortant de terre, cet oeuf géant emballé dans un ruban
            Il faut coire que la paille sur laquelle il est installé était bien chaude car ses proportions ne sont pas communes !',
            'picture' => 'oeuf.jpg',
        ],
        2 => [
            'title' => 'La mystérieuse carotarêve.',
            'text' => '
##Chapitre 1 - Une impression de déjà vu

    Une forme floue flottait et se déformait. Allongée ou arrondie, orange ou bleue, elle ondulait dans un brouillard. Un rayon de Soleil... le chant d\'un oiseau..., le réveil qui sonnait...qui sonnait ! L\'école !. Un bond hors du lit, un saut dans des vêtements. Mais au fait, il n\'y a pas d\'école le lundi de Pâques. Aprés ce réveil tourmenté qu\'Alice prenait son petit déjeuner en repensant à son rêve. Abeilles en As de pique, Oeuf géant violet et bleu... Carotarêve. La Carotarêve. Le nom restait mais impossible de se souvenir de ce qu\'était... une Carotarêve
    Le soleil transperçait les fenêtres, il semblait faire doux dehors... et puisqu\'il n\'y avait pas école aujourd\'hui Alice décida d\'aller enquêter dans le jardin au sujet de cette fameuse Carotarêve... Quelle ne fût pas sa surprise quand elle ouvrit la porte et découvrit que la couleur et la forme des arbres, de l\'herbe, de la nature semblait bien plus étincelante qu\'habituellement... Elle s\'avança toute éblouie par tant de beauté.. elle se dirigea vers un curieux personnage qui se tenait là, assis sur un banc, les jambes croisées et qui la regardait... Il était extravagant mais semblait porter en lui un savoir ancestral...
    Après avoir fait la connaissance du curieux personnage assis sur le banc Alice lui proposa de faire le chemin ensemble jusqu\'à l\'école pour retrouver son amie Rebecca... Il s\'agissait de Monsieur Elmer Waterfall, un instituteur, bien malicieux... qui devait remplacer l\'enseignante alors en arrêt maladie à cause d\'un satané virus... Il savait beaucoup de choses sur les rêves, les carottes, les lapins...
    Et même sur les virus ! Il expliqua à Alice que contrairement aux pangolins, les lapins ne peuvent pas être contaminés, car ils bondissent si vite que le virus n\'a pas le temps de s\'y accrocher. On raconte que quelque part se trouvait un pays peuplé de lapins ayant le pouvoir de faire pousser des carottes aux vertues extraordinaires... Waterfall était convaincu de leur existence, et rêvait de les découvrir.
    Comme il rêvait de rencontrer ce peuple de lapins fantastiques, Alice et Rebecca eurent une idée. Elles firent des recherches sur internet pour en découvrir un peu plus sur ces lapins. Il fallait voyager loin, très loin, trop loin pour les rencontrer.... "mais... si on les faisaient venir à nous !" s\'exlama Alice. "Papa a du grillage à la maison, on peut faire des lapins en grillage, le recouvrir de papier mâché, et faire une exposition de lapins dans la cour de l\'ecole"
    Cinq minutes plus tard, elles avaient fabriqué 3 lapins en papier mâché : Norbert, qui mesurait 35cm était de loin le plus grand et était d\'un rose flamboyant. Roberta, avec ses 12cm était coloré d\'un vert violet. Charly, ne mesurait que 5cm et était bleu, le plus beau des bleus. "Allons les porter à l\'école". Alice, Rebecca et Waterfall prirent chacun un lapin pour les emmener. En chemin Waterfall leur demanda : "Vous pouvez m\'expliquer comment ces lapins en papier vont nous permettre d\'aller à la rencontre des lapins fantastiques ? je n\'ai pas bien compris".

##Chapitre 2 - Le Lapin parlant de l\'école

    Toujours troublée par la Carotarêve, Alice a donné rendez-vous à son amie Rebecca devant l\'oeuf géant préparé par le comité des fêtes, devant l\'école. Alors qu\'elle lui parlait de son rêve bizarre, le lapin planté devant l\'oeuf s\'est animé et se mit à parler. Un lapin...un minuscule lapin...blanc...tout blanc...qui parle. C\'etait peu commun.
    Et ce lapin, il bondissait partout, comme un ressort ! "Mais qu\'est ce qui te fais tant bondir ?" Demanda alors Alice. Le lapin lui repondit toujours en bondissant : "c\'est l\'excès de chocolat, mais attention pas n\'importe lequel, le chocolat au lait !" Plus il mangeait du chocolat, plus il sautait haut ! Si haut qu\'il etait arrivé sur le toit de l\'école ! Alice et Rebecca étaient stupefaites ! Comment allait-il descendre de là haut ? C\'est alors que le lapin sorti de son oreille une carotte. Il la frotta très et dit : abracarotte : donne moi un parachute !" Comme par magie, un sac à dos poussa sur le dos du lapin"
    Éberlués, Alice Rebecca et Waterfall posèrent leur lapin en papier mâché par terre. Waterfall se gratta le front en disant "Ça alors, vous aviez raison. Je n\'aurai jamais cru rencontrer un lapin magique en apportant du papier mâché ici." Le lapin sauta alors du toit de l\'école, il ouvrit son parachute d’où s\'échappaient des fleurs qui formaient une traînée derrière lui. Alice était stupéfaite. Un peu embarrassé par le regard étonné des passants, Waterfall s’éclipsa en lançant un bref "hum hum, je revient tout de suite, j\'ai un truc à faire".

##Chapitre 3 - La forêt multicolore

    Revenant à la réalité, Alice dit au Lapin : "Je veux savoir ce qu\'est la Carotarêve.". Ce à quoi la lapin répondit "Tu veux savoir ce qu\'est la Carotarêve, je ne peux te le dire. Mais je peux te montrer le chemin vers la forêt multicolore". C\'est alors que les nuages se mirents à onduler, parfois oranges ou bleus, parfois allongés ou arrondis. Le lapin ajoutait d\'une voix déformée en regardant sa montre à gousset "Le moment venu, faites attention à ne pas être en retard". Quand Alice et Rebecca comprirent ce qui leur arrivait, ils étaient dans une forêt peu banale... comment dire ? Multicolore.
    Rebecca et Alice se mirent alors en route dans la forêt multicolore, elles y rencontrèrent d\'innombrables insectes et autres animaux tous plus filous et drôles les uns que les autres, jusqu\'au moment où
    Ils rencontrèrent une vieille dame habillée tout de rouge. Alice et Rebecca décidèrent de lui parler afin d\'en savoir plus sur cette mystérieuse forêt. La dame les invita à boire le thé car c’était une histoire beaucoup trop longue à raconter, cependant elle commença en chemin le début de son récit : A l\'époque, elle rendait souvent visite à sa grand mère et adorait croiser tout ces animaux multicolores sur son chemin mais il faillait se méfier car tous n\'étaient pas gentils et inoffensifs ils allaient d’ailleurs en faire l’expérience.....
    « Vous savez, leur dit elle, alors que j\'étais jeune, belle et svelte, j\'étais moi aussi l\'héroïne d\'un conte. Je sortais malgré les interdictions de mes parents et me promenais bien souvent dans ces bois avec cette tenue rouge assez voyante. Il est vrai qu\'à l\'époque elle me mettait un peu plus en valeur… » Elle continua ainsi des heures sans s\'arrêter...Après bien des anecdotes inutiles, elle fini par dire : « Au fait, si un jour vous trouvez la Carotarêve, prenez garde. Quoi qu’il arrive, quoi qu’il se passe, vous ne devez pas… » Elle fut interrompue par l’arrivée musicale d’une grenouille qui faisait des claquettes tenant son chapeau d’une main et jouant avec une canne de l’autre. La vielle Dame s’arrêta net, en étendant les bras pour empêcher nos amis d’avancer. « Pourquoi fait tu des claquettes ? » demanda-t-elle. « C’est pour mieux t’amuser » répondit la grenouille qui masquait son regard en reposant lentement son chapeau sur sa tête. Sans quitter la grenouille des yeux, la vielle Dame sortait une fiole de sa cape rouge... elle la débouchait lentement... et en avala le contenu d’un coup. Un flash lumineux se produisit.
    La grenouille se transforma alors en loup, un tout petit loup qui faisait des claquettes avec un chapeau et une canne. On entendit alors un air de jazz. Brusquement le loup sauta sur Alice. Il la mordait au bras. Elle gesticulait. Il ne lâchait pas. Le pauvre carnivore était propulsé dans tous les sens accroché au bras d\'Alice mais il ne lâchait pas. La dame en rouge sorti un sac à main (un Prada de très bon goût) de sa cape et se mit à frapper le loup pour tenter de le décrocher. Évidemment, ce n\'était pas sans conséquences pour Alice. Pendant ce temps, Rebecca se demandait d’où pouvait venir cette musique de jazz. Alice souffrait plus des coups de sac que des morsures du loup et ne savait plus quoi faire. Elle tenta le tout pour le tout et mordit le loup. Il lâcha et s\'enfuit. La vielle dame parti à sa poursuite et disparut. La musique aussi.

##Chapitre 4 - Cascades à répétition et poissons d\'avril

    Rebecca marcha sur un oeuf ! Une oeuf aussi dur devait être fait de béton ! sans se casser, il se mit à rouler et Rebacca de glisser. Apres plusieurs tours sur elle même, elle fini sa cascade dans la rivière. Alice sauta pour aller l\'aider. Poissons volants, bulles géantes, algues écarlates et pêcheurs fous, cette rivière fourmillait d\'étrangetés.
    Alice voulant attraper la main de Rebecca se sentit partir et se retrouva elle même les fesses dans l\'eau et c\'est qu\'un tourbillon d\'eau, de bulles, de mousse les fit tourner tourner tourner jusqu\'à en perdre la tête
    Un pêcheur était assis au fond de l\'eau et tentait d\'attraper les poissons qui volaient à la surface avec une épuisette. Alice lui demanda ce qu\'il savait sur la Carotarêve. Le pêcheur lui répondit "Sur la Carotarêve ? Je sais tout, c\'est moi qui l\'ai cachée". Alice et Rebecca étaient aussi soulagées qu\'heureuse, elle allaient enfin tout savoir. C\'est alors que les deux amis et leur compagnon lapin furent absorbés par une bulle géante qui les emporta dans le courant. De l’intérieur, ils n\'entendaient plus ce que disait le pêcheur. Alors que la bulle s\'éloignait, ils eurent juste le temps de remarquer, inscrit sur le sac du pêcheur, le nom de "Waterfall"...qui signifiait...qui signifiait..."Cascade"!

##Chapitre 5 - L\'embarras du choix

    Sortis de la rivière on ne sait trop comment, nos amis furent séchés en un rien de temps par des papillons-seches-cheveux venus leur prêter main forte. Reprenant leur calme peu à peu, Alice, rebecca et le lapin blanc remarquèrent les 3 portes devant eux avec ce petit panneaux "Préférez vous avoir le choix ou l\'embarras ?". Rebecca s\'écria alors : "Il faut passer par cette porte ci !"
    Les 3 compères n\'étaient pas d\'accord sur le choix de la porte... Une porte en bois, ancienne, gravée, magnifique pouvait laisser penser que derrière se trouvait un lieu chargé d\'histoire et de magie... La porte en fer quant à elle inspirait plutôt la froideur et les ténèbres... La porte en PVC donnait à penser à ... rien d\'autre la neutralité... la normalité... et c\'est vers celle-là que Rebecca voulait aller.... Alice et le lapin eux préféraient de loin la belle porte en bois

##Chapitre 6 - La Carotarêve

    Reprenant leur chemin, les 3 explorateurs avancaient dans la forêt. Le chemin etait tortueux et chaque virage leur faisait découvrir, entre feuilles et branches, des créatures peu communes : un champ de cartes de trèfle, des abeilles en as de pique, ou des singes qui se tiennent à carreau. Mais finalement, alors que la foret semblait interminable, tout disparut soudainement. Le lapin blanc haussa un sourcil et leur dit "Nous y voilà. Nous sommes dans la clairière chocolatée". Il regarda sa montre puis la secoua. Un peu plus loin se trouvait un nid et dans le nid, aucun doute, la Carotarêve était là. Bizarre, obscure et sombre.
    Et voilà... aucun d\'eux n\'ayant eu raison sur le choix de la porte, bernés par les apparences, ils se trouvèrent bien stupéfaits ... devaient ils approcher, devaient ils la manger, la toucher? Rebecca toujours sur ses gardes ne pensait qu\'à une chose... s\'enfuir...

##Chapitre 7 - Contre la montre magique

    Mais Alice qui était beaucoup trop curieuse et surtout affamée, décida de croquer une feuille chocolatée alors que ses 2 compères lui déconseillaient fortement. Et crac la voilà qui croque cette feuille puis une deuxième, quand soudain le sol se mis à trembler et tout trois se regardèrent sans comprendre ce qu\'il se passait. Rebecca se mis à hurler avant de prendre ses jambes à son cou en direction du carotarêve qui étais encore là quelques instants plutôt, enfin c\'est ce qu\'elle croyais car plus elle courait et plus le carotarêve s\'éloignait. Était-ce le fruit de son imagination ou était-ce bien réel ? Pendant qu\'elle courait elle ne se rendit pas compte qu elle s\'éloignait elle aussi de ses amis qui cherchaient encore une solution pour fuir ce monde chocolaté qui se dérobait sous leurs pieds. Lapin prit les choses en main et guida Alice, et les voilà bondissant de souches en souches en suivant tant bien que mal Rebecca, et à chaque souche passée, celle-ci fondait dans le chocolat. "Il faut aller plus vite Alice !!!" ...
    La montre du lapin de mit à sonner dans un "dring" qui rappelait le réveil d\'Alice. "Vite, je vous avais prévenu, il est l\'heure de ne pas être en retard. Partons avant que tous ça ne se termine en fondue au chocolat". Alice attrapa la Carotarêve et se mit à courir. Le "dring" se faisait de plus en plus fort, de plus en plus sourd pour devenir le son assourdissant d\'une cloche.
    Tous ensemble il essayaient d\'aller vers le son de la cloche, mais le sol tremblait et le clocher de l\'église se fendait, penchait, comme s\'il allait s\'écrouler... ce n\'est pas le moment d\'être en retard hurlait le lapin, ses yeux le devançait, ses oreilles couchées en arrière il allait tellement vite qu\'on ne lui voyait plus les pattes!!!

##Chapitre 8 - Et ensuite

    C\'est alors que les nuages se mirents à onduler, parfois oranges ou bleus, parfois allongés ou arrondis. Une voix déformée leur dit, "Faites attention à ne pas être en retard". Alice et Rebecca étaient revenues à l\'école. Ne sachant que faire de la Carotarêve, elle décidèrent de la cacher parmi les plantations. Les maîtresses ayant remarqué des choses étranges passèrent par là. Sans remarquer la Carotarêve, elles leur dirent :
    "Il était temps mesdemoiselles.... Vous avez failli être en retard... dans quel état êtes vous? à peine débarbouillées du petit déjeuner, des tâches plein vos vêtements... " alice demanda où est Monsieur Waterfall, le remplaçant.. "Quel remplaçant, tu vois bien que toutes les enseignantes sont là..." Alice ne comprenait pas.... et demanda: "mais Madame Urluberlu.... elle est malade... le virus...?!" La directrice de l\'école lui répondit sèchement: "quoi? de quel virus me parles-tu? files en classe!"
    "Mais, dit Alice interloquée, nous sommes le lundi de Pâques, c\'est férié, il n\'y a pas classe aujourd\'hui". Alors qu\'elle s\'éloignait pour rentrer chez elle, elle remarqua l\'étiquette sur le sac de la directrice, une étiquette sur laquelle était inscrit le nom de ... "Waterfall".

            ',
            'picture' => 'carotareve.jpg',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for($i=0; $i<self::CONTENT_NUMBER; $i++){

            $content = new Content();

            if ($i < count(self::CONTENT)) {
                $content->setTitle(self::CONTENT[$i]['title']);
                $content->setText(self::CONTENT[$i]['text']);
                $content->setWriter('Anonym');
                $content->setPicture(self::CONTENT[$i]['picture']);
                $category = $this->getReference('category_1');
                $content->setCategory($category);
            } else {
                $content->setTitle($faker->sentence);
                $content->setText($faker->text(1000));
                $content->setWriter('Anonym');
                $content->setPicture('fixture_content-'.rand(1,6).'.jpg');

                $categoryIndex = rand(0 , CategoryFixtures::CATEGORY_NUMBER-1);
                $category = $this->getReference('category_'.$categoryIndex);
                $content->setCategory($category);
            }

            $content->setDate($faker->dateTimeBetween('-3 months', '2021/06/31'));

            $this->addReference('content_' .$i, $content);
            $manager->persist($content);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }


}
