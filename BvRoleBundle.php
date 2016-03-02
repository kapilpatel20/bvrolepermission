<?php

namespace BvRoleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BvRoleBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
