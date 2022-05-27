<?php

declare (strict_types=1);
namespace RectorPrefix20220527\Helmich\TypoScriptParser\Tokenizer\Printer;

use RectorPrefix20220527\Helmich\TypoScriptParser\Tokenizer\TokenInterface;
use RectorPrefix20220527\Symfony\Component\Yaml\Yaml;
class StructuredTokenPrinter implements TokenPrinterInterface
{
    /** @var Yaml */
    private $yaml;
    public function __construct(Yaml $yaml = null)
    {
        $this->yaml = $yaml ?: new Yaml();
    }
    /**
     * @param TokenInterface[] $tokens
     * @return string
     */
    public function printTokenStream(array $tokens) : string
    {
        $content = '';
        foreach ($tokens as $token) {
            $content .= \sprintf("%20s %s\n", $token->getType(), $this->yaml->dump($token->getValue()));
        }
        return $content;
    }
}
