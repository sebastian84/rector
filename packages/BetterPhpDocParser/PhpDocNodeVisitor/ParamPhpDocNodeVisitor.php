<?php

declare (strict_types=1);
namespace Rector\BetterPhpDocParser\PhpDocNodeVisitor;

use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use Rector\BetterPhpDocParser\Attributes\AttributeMirrorer;
use Rector\BetterPhpDocParser\Contract\BasePhpDocNodeVisitorInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDoc\VariadicAwareParamTagValueNode;
use RectorPrefix20220527\Symplify\Astral\PhpDocParser\PhpDocNodeVisitor\AbstractPhpDocNodeVisitor;
final class ParamPhpDocNodeVisitor extends AbstractPhpDocNodeVisitor implements BasePhpDocNodeVisitorInterface
{
    /**
     * @readonly
     * @var \Rector\BetterPhpDocParser\Attributes\AttributeMirrorer
     */
    private $attributeMirrorer;
    public function __construct(AttributeMirrorer $attributeMirrorer)
    {
        $this->attributeMirrorer = $attributeMirrorer;
    }
    public function enterNode(Node $node) : ?Node
    {
        if (!$node instanceof ParamTagValueNode) {
            return null;
        }
        if ($node instanceof VariadicAwareParamTagValueNode) {
            return null;
        }
        $variadicAwareParamTagValueNode = new VariadicAwareParamTagValueNode($node->type, $node->isVariadic, $node->parameterName, $node->description);
        $this->attributeMirrorer->mirror($node, $variadicAwareParamTagValueNode);
        return $variadicAwareParamTagValueNode;
    }
}
