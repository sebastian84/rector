<?php

declare (strict_types=1);
namespace RectorPrefix20220527\Symplify\SymplifyKernel\Contract\Config;

use RectorPrefix20220527\Symfony\Component\Config\Loader\LoaderInterface;
use RectorPrefix20220527\Symfony\Component\DependencyInjection\ContainerBuilder;
interface LoaderFactoryInterface
{
    public function create(ContainerBuilder $containerBuilder, string $currentWorkingDirectory) : LoaderInterface;
}
