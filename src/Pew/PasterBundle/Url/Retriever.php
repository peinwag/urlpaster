<?php

namespace Pew\PasterBundle\Url;

use \Symfony\Component\DependencyInjection\ContainerInterface;

class Retriever
{
    /**
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
     *
     * @var Url
     */
    protected $url;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getLastThreeDays()
    {
        $result = array();

        $today = new \DateTime();
        $yesterday = new \DateTime();
        $yesterday->sub(new \DateInterval('P1D'));
        $dayBeforeYesterday = new \DateTime();
        $dayBeforeYesterday->sub(new \DateInterval('P2D'));
        
        $dates = array(
            $today,
            $yesterday,
            $dayBeforeYesterday,
        );

        foreach ($dates as $date) {

            $result[$date->format('Y-m-d')] = $this->retrieve($date);
            
        }

        return $result;
    }

    protected function retrieve($date = null)
    {
        if (null === $date) {
            
            $date = new \DateTime();
        }
        
        $listName = sprintf('paster_%s',  $date->format('Y-m-d'));

        $redis = $this->container->get('snc_redis.default');
        $result = $redis->lrange($listName, 0, -1);

        return $result;
    }
}
