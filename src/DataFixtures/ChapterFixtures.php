<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChapterFixtures extends Fixture
{
    const CHAPTERS = [
        0 => [
            'introduction' => 'Alice est une petite fille qui s\'est réveillée apres avoir rêvé d\'un étrange Lapin parlant, 
            de champignons en chocolat, d\'une cascade... Ce qui a le plus marqué Alice, c\'est la Carotarêve mais elle n\'arrive pas à s\'en rappeler.
            Alors qu\'elle y pense en prenant son petit déjeuner, tout lui donne une impression de déja vu.
            ',
            'conclusion' => 'conclu chapitre 1',
            'title' => 'Une impression de déjà vu',
            'code' => 'code1',
            'number' => 1
        ],
        1 => [
            'introduction' => 'A l\école, Alice a parlé de la Carotarêve à son amie Rebecca. Un Lapin parlant est apparut 
            devant une oeuf geant bleu avec un noeud rose, il a l\'air d\'en savoir beaucoup au sujet de la Carotarêve et parle d\'une clairière magique. Mais que sait il ?
            ',
            'conclusion' => 'conclu chapitre 2',
            'title' => 'Le Lapin parlant de l\'école',
            'code' => 'code2',
            'number' => 2
        ],
        2 => [
            'introduction' => 'Aprés que le Lapin ait révélé que la Carotarêve se trouvait dans la forêt multicolore, 
            les nuages sont devenus eux aussi multicolores. Alice, Rebecca et le Lapin ont alors été transportés dans une 
            forêt...décidémment pas comme les autres.
            ',
            'conclusion' => 'conclu chapitre 3',
            'title' => 'La forêt multicolore',
            'code' => 'code3',
            'number' => 3
        ],

        3 => [
            'introduction' => 'Rebecca est tombée dans une rivière, Alice et le lapin ont sautés pour essayer de l\'aider. 
            Mais pourquoi y a t\'il autant de courant ? Est ce à cause d\'une cascade ? Vite ! Mais cette rivière cache bien des secrets.
            ',
            'conclusion' => 'conclu chapitre 4',
            'title' => 'Cascades à répétition et poissons d\'avril',
            'code' => 'code4',
            'number' => 4
        ],

        4 => [
            'introduction' => 'Enfin sortis de la rivière, nos amis se retrouvent face à 3 portes. Laquelle mène à la Carotarêve ?
            Que se passe t\'il lorsqu\'on franchi une porte ? Encore un passage bien bizarre.
            ',
            'conclusion' => 'conclu chapitre 5',
            'title' => 'L\'embarras du choix',
            'code' => 'code5',
            'number' => 5
        ],
        5 => [
            'introduction' => 'Alice, Rebecca et le Lapin sont enfin parvenus à la clairière chocolatée et ont découvert la Carotarêve.
            Mais c\'est quoi au juste une Carotarêve ? A quoi ressemble t\'elle ? A quoi sert elle ?
            ',
            'conclusion' => 'conclu chapitre 6',
            'title' => 'La Carotarêve',
            'code' => 'code6',
            'number' => 6
        ],
        6 => [
            'introduction' => 'Alice a croqué un champignon en chocolat. Erreur, tous les champignons de la clairière se mettent à gonfler, ils deviennent énormes.
            Le Lapin leur explique qu\'ils vont exploser, vite, il faut partir avant que tout se termine ne fondue au chocolat ! Le Lapin montre sa mystérieuse montre à gousset.
            ',
            'conclusion' => 'conclu chapitre 7',
            'title' => 'Contre la montre magique',
            'code' => 'code7',
            'number' => 7
        ],
        7 => [
            'introduction' => 'Alice et Rebecca sont enfin revenus à l\'école. Ils ont caché la Carotarêve dans le potager. 
            Que vont ils en faire ? Restera-t-elle un secret ou d\'autres enfants vont ils la découvir ?
            ',
            'conclusion' => 'conclu chapitre 8',
            'title' => 'Et ensuite',
            'code' => 'code8',
            'number' => 8
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
            $chapter->setNumber(self::CHAPTERS[$i]['number']);

            $this->addReference('chapter_' .$i, $chapter);
            $manager->persist($chapter);
        }

        $manager->flush();
    }
}
