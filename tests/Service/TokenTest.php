<?php

namespace Fabstei\ShorturlBundle\Tests\Service;

use Fabstei\ShorturlBundle\Service\Token;
use PHPUnit\Framework\TestCase;

final class UrlControllerFunctionalTest extends TestCase
{
    private $codeset;
    private $tokenizer;

    public function setUp(): void
    {
        $this->codeset = 'abc';
        $this->tokenizer = new Token($this->codeset);
    }

    public function testCodesetAttribute(): void
    {
        $classname = get_class($this->tokenizer);
        $this->assertClassHasAttribute('codeset', $classname, 'There\'s no "codeset" attribute in "'.$classname.'".');
    }

    public function testGetCodeset(): void
    {
        $result = $this->tokenizer->getCodeset();

        $this->assertIsString($result);
        $this->assertEquals($this->codeset, $result);
    }

    public function testEncode(): void
    {
        $result = $this->tokenizer->encode(5);

        $this->assertIsString($result);
        $this->assertEquals('bc', $result);
    }

   public function testDecode(): void
    {
        $result = $this->tokenizer->decode('bc');

        $this->assertIsString($result); //should be integer, but at the moment decode returns strings
        $this->assertEquals('5', $result);
    }
}
