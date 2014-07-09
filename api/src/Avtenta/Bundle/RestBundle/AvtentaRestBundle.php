<?php

namespace Avtenta\Bundle\RestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AvtentaRestBundle extends Bundle
{
    public function getParent()
    {
       return 'FOSUserBundle';
    }
}
