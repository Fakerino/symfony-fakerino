<?php
/**
 * This file is part of the Symfony Fakerino Bundle.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Bundle\FakerinoBundle\Test\Twig;

use Fakerino\Bundle\FakerinoBundle\Twig\FakerinoTwigExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Twig_Environment;
use Twig_Loader_String;
use Symfony\Component\DependencyInjection\Definition;

class Twig_Extensions_Fakerino_Test extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $loader = new \Twig_Loader_String();
        $container = new ContainerBuilder();
        $classDefinition = new Definition('Fakerino\Core\FakeDataFactory');
        $classDefinition->setFactory(array('Fakerino\Fakerino', 'create'), array());
        $container->setDefinition('fakerino', $classDefinition);
        $this->extension = new FakerinoTwigExtension($container);
        $this->twig = new \Twig_Environment($loader);
        $this->twig->addExtension($this->extension);
    }

    public function testGetName()
    {
        $this->assertEquals('fakerino.twig', $this->extension->getName());
    }

    public function testTwigExtension()
    {
        $helloString ='Hello ';
        $template = $this->twig->loadTemplate($helloString."{{ fake('surname') }}");
        $actual = $template->render(array());

        $this->assertTrue(strlen($actual) > strlen($helloString));
    }
}