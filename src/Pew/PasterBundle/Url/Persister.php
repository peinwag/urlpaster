<?php

namespace Pew\PasterBundle\Url;

use \Symfony\Component\DependencyInjection\ContainerInterface;
use Pew\PasterBundle\Entity\Url;

class Persister
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

    public function __construct(ContainerInterface $container, $url)
    {
        $this->container = $container;
        $this->url = new Url();
        $this->url->setUrl($url);

        $validator = $this->container->get('validator');
        $errors = $validator->validate($this->url);

        if (count($errors) > 0) {

            $message = '';
            foreach ($errors as $error) {

                $message .= $error->getMessage() . "\n";
            }

            throw new \RuntimeException($message);
        }
    }

    public function persist()
    {
        $date = new \DateTime();
        $listName = sprintf('paster_%s', $date->format('Y-m-d'));

        $redis = $this->container->get('snc_redis.default');
        $redis->lpush($listName, $this->url->getUrl());
    }
}