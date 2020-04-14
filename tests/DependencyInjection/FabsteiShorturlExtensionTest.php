<?php

namespace Fabstei\ShorturlBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Fabstei\ShorturlBundle\DependencyInjection\FabsteiShorturlExtension;
use Symfony\Component\Yaml\Parser;

final class FabsteiShorturlExtensionTest extends TestCase
{
    protected $configuration;

    public function testCreateConfiguration(): void
    {
        $this->configuration = new ContainerBuilder();
        $loader = new FabsteiShorturlExtension();
        $config = $this->getConfig();
        $loader->load([$config], $this->configuration);
        $this->assertInstanceOf(ContainerBuilder::class, $this->configuration);
    }

    /**
     * getConfig
     *
     * @return array
     */
    protected function getConfig(): array
    {
        $yaml = <<<EOF
url_class: Acme\TestBundle\Entity\User
EOF;
        $parser = new Parser();

        return $parser->parse($yaml);
    }

    protected function tearDown(): void
    {
        unset($this->configuration);
    }
}
