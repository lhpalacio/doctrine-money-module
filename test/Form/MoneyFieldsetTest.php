<?php

namespace ZFBrasil\Test\DoctrineMoneyModule\Form;

use Money\Money;
use PHPUnit_Framework_TestCase as TestCase;
use ZFBrasil\DoctrineMoneyModule\Form\Factory\MoneyFieldsetFactory;
use ZFBrasil\DoctrineMoneyModule\Form\MoneyFieldset;

/**
 * Description of MoneyFieldsetTest.
 *
 * @author  Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class MoneyFieldsetTest extends TestCase
{
    public function testCanHydrateMoneyWithInteger()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => 500,
            'currency' => 'BRL',
        ]);
        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }

    /**
     * @return MoneyFieldset
     */
    private function getMoneyFieldset()
    {
        $factory = new MoneyFieldsetFactory();

        return $factory();
    }

    public function testCanHydrateMoneyWithString()
    {
        $fieldset = $this->getMoneyFieldset();

        $fieldset->bindValues([
            'amount' => '500',
            'currency' => 'BRL',
        ]);

        $this->assertInstanceOf(Money::class, $fieldset->getObject());
    }
}
