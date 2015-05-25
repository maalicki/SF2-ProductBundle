<?php

namespace Polcode\ProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->addChild('Products', array('route' => 'product'));
        $menu->addChild('Add Product', array('route' => 'product_new'));
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        return $menu;
    }

}
