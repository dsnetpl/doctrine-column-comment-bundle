<?php

declare(strict_types=1);

namespace Dsnetpl\DoctrineColumnCommentBundle;

use Dsnetpl\DoctrineColumnCommentBundle\DependencyInjection\DoctrineColumnCommentBundleExtension;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DsnetplDoctrineColumnCommentBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new DoctrineColumnCommentBundleExtension();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
