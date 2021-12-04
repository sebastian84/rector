<?php

declare (strict_types=1);
namespace Rector\Transform\ValueObject;

use Rector\Transform\Contract\ValueObject\ArgumentFuncCallToMethodCallInterface;
final class ArgumentFuncCallToMethodCall implements \Rector\Transform\Contract\ValueObject\ArgumentFuncCallToMethodCallInterface
{
    /**
     * @readonly
     * @var string
     */
    private $function;
    /**
     * @readonly
     * @var string
     */
    private $class;
    /**
     * @readonly
     * @var string|null
     */
    private $methodIfArgs;
    /**
     * @readonly
     * @var string|null
     */
    private $methodIfNoArgs;
    public function __construct(string $function, string $class, ?string $methodIfArgs = null, ?string $methodIfNoArgs = null)
    {
        $this->function = $function;
        $this->class = $class;
        $this->methodIfArgs = $methodIfArgs;
        $this->methodIfNoArgs = $methodIfNoArgs;
    }
    public function getFunction() : string
    {
        return $this->function;
    }
    public function getClass() : string
    {
        return $this->class;
    }
    public function getMethodIfNoArgs() : ?string
    {
        return $this->methodIfNoArgs;
    }
    public function getMethodIfArgs() : ?string
    {
        return $this->methodIfArgs;
    }
}
