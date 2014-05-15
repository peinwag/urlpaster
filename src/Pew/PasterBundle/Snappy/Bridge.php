<?php

namespace Pew\PasterBundle\Snappy;

require_once __DIR__ . '/../../../../vendor/knplabs/knp-snappy/src/autoload.php';


use Knp\Snappy\Image;

class Bridge
{
    public function takeScreenshot($url)
    {
        
        
        $options = array('quality' => 95, 'load-error-handling' => 'skip');
        $image = new Image('/usr/local/bin/wkhtmltoimage-i386');
        #header('Content-Type: image/jpg');
        #header('Content-Disposition: attachment; filename="file.jpg"');
        header("Content-Type: image/jpeg");
        echo $image->getOutput($url, $options);
    }

}