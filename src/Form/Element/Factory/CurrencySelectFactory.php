<?php

namespace ZFBrasil\DoctrineMoneyModule\Form\Element\Factory;

use Interop\Container\ContainerInterface;
use ZFBrasil\DoctrineMoneyModule\Form\Element\CurrencySelect;
use InvalidArgumentException;

/**
 * @author Gabriel Schmitt <gabrielsch@outlook.com>
 * @license MIT
 */
class CurrencySelectFactory
{
    /**
     * @param ContainerInterface $container
     *
     * @return CurrencySelect
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config');

        if (!isset($config['money']['currencies'])) {
            throw new InvalidArgumentException('Couldn\'t find currencies configuration.');
        }

        $select = new CurrencySelect();
        $select->setValueOptions($config['money']['currencies']);

        return $select;
    }
}
