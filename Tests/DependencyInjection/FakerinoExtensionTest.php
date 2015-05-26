<?php
/**
 * This file is part of the Symfony Fakerino Bundle.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Bundle\FakerinoBundle\Test\DependencyInjection;

use Fakerino\Bundle\FakerinoBundle\DependencyInjection\FakerinoExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class FakerinoBundleExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FakerinoBundleExtension
     */
    private $extension;

    /**
     * Root name of the configuration
     *
     * @var string
     */
    private $root;

    public function setUp()
    {
        parent::setUp();

        $this->extension = $this->getExtension();
        $this->root = "fakerino";
    }

    public function testGetConfigWithDefaultValues()
    {
        $this->extension->load(array(), $container = $this->getContainer());

        $this->assertTrue($container->hasParameter($this->root . ".config"));
        $this->assertEquals(array(), $container->getParameter($this->root . ".config"));
    }

    public function testGetConfigWithOverrideValues()
    {
        $configs = array(
            "config" => array(
                "fakerinoTag" => "defaultValue1",
                "locale" => "defaultValue2",
                "fakeFilePath" => "defaultValue2",
                "database" => array(),
                "fake" => array(),
            ),
        );
        $this->extension->load(array($configs), $container = $this->getContainer());

        $this->assertTrue($container->hasParameter($this->root . ".config"));
        $this->assertEquals($configs['config'], $container->getParameter($this->root . ".config"));
    }

    /**
     * @return FakerinoExtension
     */
    protected function getExtension()
    {
        return new FakerinoExtension();
    }

    /**
     * @return ContainerBuilder
     */
    private function getContainer()
    {
        $container = new ContainerBuilder();

        return $container;
    }
}