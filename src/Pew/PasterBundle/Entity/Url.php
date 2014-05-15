<?php

namespace Pew\PasterBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;



class Url
{
    /**
     *
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    protected $url;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
