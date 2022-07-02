<?php

namespace Mothership\TwigBemBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TwigBemBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}