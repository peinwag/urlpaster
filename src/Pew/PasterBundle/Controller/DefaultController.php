<?php

namespace Pew\PasterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Pew\PasterBundle\Url\Persister as UrlPersister;
use Pew\PasterBundle\Url\Retriever as UrlRetriever;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $result = array();

        if ($this->getRequest()->isMethod('POST')) {

            try {

                $persister = new UrlPersister(
                    $this->container,
                    $this->getRequest()->get('url')
                );

                $persister->persist();

            } catch (\Exception $e) {

                $result['error'] = $e->getMessage();
            }
        }

        $urlRetriever = new UrlRetriever($this->container);

        $result['pastes'] = $urlRetriever->getLastThreeDays();

        return $result;
    }
}
