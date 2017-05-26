<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form\Element\Factory;

use Psr\Container\ContainerInterface;
use PHPUnit_Framework_TestCase as TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use ZFBrasil\DoctrineMoneyModule\Form\Element\Factory\CurrencySelectFactory;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;

/**
 * @author  Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class CurrencySelectFactoryTest extends TestCase
{
    /** @var ContainerInterface|ObjectProphecy */
    private $container;

    private $config = [
        'money' => [
            'currencies' => [
                'BRL' => 'Brazilian Real',
                'SAD' => 'Sad Asteka',
            ],
        ],
    ];

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    public function testFactoryCanCreateElement()
    {
        $this->container->get('Config')->willReturn($this->config);

        $factory = new CurrencySelectFactory();
        $currencySelect = $factory($this->container->reveal());

        $this->assertInstanceOf(CurrencySelect::class, $currencySelect);
    }

    public function testFactoryCreateElementWithExpectedCurrencies()
    {
        $this->container->get('Config')->willReturn($this->config);

        $factory = new CurrencySelectFactory();
        $currencySelect = $factory($this->container->reveal());

        $this->assertEquals($this->config['money']['currencies'], $currencySelect->getValueOptions());
    }

    public function testFactoryCreateElementsWithNoCurrenciesShouldTrownAnException()
    {
        $this->container->get('Config')->willReturn(false);

        $factory = new CurrencySelectFactory();

        $this->setExpectedException('InvalidArgumentException');

        $factory($this->container->reveal());
    }
}
