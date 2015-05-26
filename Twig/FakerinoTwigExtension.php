<?php
/**
 * This file is part of the Symfony Fakerino Bundle.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fakerino\Bundle\FakerinoBundle\Twig;

use Symfony\Component\DependencyInjection\Container;
use Twig_Extension;

/**
 * Class FakerinoTwigExtension
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
class FakerinoTwigExtension extends Twig_Extension
{
    /**
     * Constructor.
     * Needs the container to retrieve the configuration values.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('fake', array($this, 'fakeFunction')),
        );
    }

    /**
     * Fakes the data.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function fakeFunction($data)
    {
        $fakerino = $this->container->get('fakerino');

        return $fakerino->fake($data);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fakerino.twig';
    }
}