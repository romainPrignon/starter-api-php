<?php
declare(strict_types=1);

namespace RomainPrignon\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function indexAction(Request $request): Response
    {
        return new Response('coucou');
    }
}
