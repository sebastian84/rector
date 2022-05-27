<?php

declare (strict_types=1);
namespace RectorPrefix20220527;

use RectorPrefix20220527\Symplify\SymplifyKernel\ValueObject\KernelBootAndApplicationRun;
use RectorPrefix20220527\Symplify\VendorPatches\Kernel\VendorPatchesKernel;
$possibleAutoloadPaths = [__DIR__ . '/../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../autoload.php', __DIR__ . '/../../../vendor/autoload.php'];
foreach ($possibleAutoloadPaths as $possibleAutoloadPath) {
    if (!\file_exists($possibleAutoloadPath)) {
        continue;
    }
    require_once $possibleAutoloadPath;
}
$kernelBootAndApplicationRun = new KernelBootAndApplicationRun(VendorPatchesKernel::class);
$kernelBootAndApplicationRun->run();
