<?php

namespace App\Service;

use App\Entity\StatTag;
use App\Repository\StatTagRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class StatTagManager
{
    private $params;
    private $statTagRepository;
    private $session;
    private $entityManager;

    public function __construct(
        StatTagRepository $statTagRepository,
        ParameterBagInterface $params,
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ) {
        $this->params = $params;
        $this->statTagRepository = $statTagRepository;
        $this->session = $session;
        $this->entityManager = $entityManager;
        $session->start();

        $this->addTag();
    }

    /**
     *
     * @param String $name
     * @throws \Exception
     */
    public function addTag(String $name=null)
    {
        if (!$name) {
            $name = $_SERVER['REQUEST_URI'];
        }

        $tag = new StatTag();
        $tag->setName($name);
        $tag->setDate(new DateTime());
        $tag->setBrowser($this->getBrowser());
        $tag->setOpsys($this->getOS());
        $tag->setIp($this->getIP());

        $sessionId = $this->session->getId();
        $pseudo = '';
        if (!is_null($this->session->get('pseudo'))) {
            $pseudo = substr($this->session->get('pseudo'), 0, 200);
        }

        $tag->setSessionid($sessionId.' ('.$pseudo.')');

        $this->entityManager->persist($tag);
        $this->entityManager->flush();
    }

    /**
     * get the browser name from the request
     * code from : https://www.juliepirio.com/php/detection-navigateur-systeme-exploitation/
     * @return mixed|string
     */
    private function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Inconnu";
        $browser_array = array( '/mobile/i'    => 'Handheld Browser',
            '/msie/i'      => 'Internet Explorer',
            '/trident/i'   => 'Internet Explorer',
            '/firefox/
            i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

        //limit the return length to protect database
        return substr($browser,0,245);
    }

    private function getOS()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Inconnu";
        $os_array     = array(  '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;

        //limit the return length to protect database
        return substr($os_platform,0,245);
    }

    /**
     * Try to get the ip from the request
     * Note that the result is limited to 100 char to protect the database in case the ip is corrupted.
     * @return false|string
     */
    function getIp()
    {
        // IP si internet partagé
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return substr($_SERVER['HTTP_CLIENT_IP'],0,99);
        }
        // IP derrière un proxy
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return substr($_SERVER['HTTP_X_FORWARDED_FOR'],0,99);
        }
        // Sinon : IP normale
        else {
            $ip =  (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
            return substr($ip,0,99);
        }
    }
}
