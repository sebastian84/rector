<?php

declare (strict_types=1);
namespace Ssch\TYPO3Rector\FileProcessor\Resources\Files\Rector;

use Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector;
use Rector\Core\ValueObject\Application\File;
use Rector\Testing\PHPUnit\StaticPHPUnitEnvironment;
use Ssch\TYPO3Rector\Contract\FileProcessor\Resources\FileRectorInterface;
use Ssch\TYPO3Rector\Helper\FilesFinder;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Symplify\SmartFileSystem\SmartFileInfo;
final class RenameExtTypoScriptFilesFileRector implements FileRectorInterface
{
    /**
     * @readonly
     * @var \Rector\Core\Application\FileSystem\RemovedAndAddedFilesCollector
     */
    private $removedAndAddedFilesCollector;
    /**
     * @readonly
     * @var \Ssch\TYPO3Rector\Helper\FilesFinder
     */
    private $filesFinder;
    public function __construct(RemovedAndAddedFilesCollector $removedAndAddedFilesCollector, FilesFinder $filesFinder)
    {
        $this->removedAndAddedFilesCollector = $removedAndAddedFilesCollector;
        $this->filesFinder = $filesFinder;
    }
    public function refactorFile(File $file) : void
    {
        if ($this->shouldSkip($file)) {
            return;
        }
        $smartFileInfo = $file->getSmartFileInfo();
        $newFileName = $smartFileInfo->getPath() . $smartFileInfo->getBasenameWithoutSuffix() . '.typoscript';
        $this->removedAndAddedFilesCollector->addMovedFile($file, $newFileName);
    }
    public function getRuleDefinition() : RuleDefinition
    {
        return new RuleDefinition('Rename ext_typoscript_*.txt to ext_typoscript_*.typoscript', [new CodeSample(<<<'CODE_SAMPLE'
ext_typoscript_constants.txt
CODE_SAMPLE
, <<<'CODE_SAMPLE'
ext_typoscript_constants.typoscript
CODE_SAMPLE
)]);
    }
    private function shouldSkip(File $file) : bool
    {
        $smartFileInfo = $file->getSmartFileInfo();
        $extEmConfFile = $this->filesFinder->findExtEmConfRelativeFromGivenFileInfo($smartFileInfo);
        if (!$extEmConfFile instanceof SmartFileInfo) {
            return \true;
        }
        if ($extEmConfFile->getPath() !== $smartFileInfo->getPath()) {
            return \true;
        }
        if ('ext_typoscript_setup.txt' === $smartFileInfo->getBasename()) {
            return \false;
        }
        if ('ext_typoscript_constants.txt' === $smartFileInfo->getBasename()) {
            return \false;
        }
        if (StaticPHPUnitEnvironment::isPHPUnitRun() && \substr_compare($smartFileInfo->getBasename(), 'ext_typoscript_constants.txt', -\strlen('ext_typoscript_constants.txt')) === 0) {
            return \false;
        }
        if (StaticPHPUnitEnvironment::isPHPUnitRun() && \substr_compare($smartFileInfo->getBasename(), 'ext_typoscript_setup.txt', -\strlen('ext_typoscript_setup.txt')) === 0) {
            return \false;
        }
        return \true;
    }
}
