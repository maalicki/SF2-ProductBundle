<?php

namespace Polcode\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Sonata\UserBundle\Entity\User;
use Polcode\ProductBundle\Entity\Product;
use Polcode\ProductBundle\Entity\Category;

Class AppFixtures extends AbstractFixture {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {
        $this->manager = $manager;
        
        $this->loadAdminUser();
        $this->loadSampleUsers();
        $this->loadData();
        
    }

    private function loadAdminUser() {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('email@example.com');
        $userAdmin->setEnabled(true);
        $userAdmin->addRole('ROLE_SONATA_ADMIN');
        $userAdmin->setPlainPassword('admin');
        
        $this->manager->persist($userAdmin);
        $this->manager->flush();
    }

    private function loadSampleUsers() {

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setUsername("user_$i");
            $user->setEmail("sample$i@example.com");
            $user->setEnabled(true);
            $user->addRole('ROLE_USER');
            $user->setPlainPassword("user_$i");
            
            $this->manager->persist($user);
            $this->manager->flush();
        }
    }
    
    private function loadData() {
        
        $elements = [
            0 => [
                'categoryName' => 'Cars',
                'products' => [
                    0 => [
                        'price' => 25000,
                        'translations' => [
                            ['en' => [ 'name' => 'Renault Megane 3', 'description' => "It's awsome car. Buy it!"]],
                            ['pl' => [ 'name' => 'Renault Megane 3', 'description' => "Świetny samochód. Kup go!"]],
                        ]
                    ],
                    1 => [
                        'price' => 19999,
                        'translations' => [
                            ['en' => [ 'name' => 'Car Audi A3', 'description' => "Love Audi? But it!"]],
                            ['pl' => [ 'name' => 'Samochód Audi A3', 'description' => "Kochasz Audi? Kup go!"]],
                        ]
                    ],
                ]
            ],
            1 => [
                'categoryName' => 'Trucks',
                'products' => [
                ]
            ],
            2 => [
                'categoryName' => 'Bikes',
                'products' => [
                ]
            ],
            3 => [
                'categoryName' => 'Boats',
                'products' => [
                    0 => [
                        'price' => 29000,
                        'translations' => [
                            ['en' => [ 'name' => 'Just boats', 'description' => "Your default text!"]],
                            ['pl' => [ 'name' => 'Tylko łodzie', 'description' => "Twój domyślny tekst!"]],
                        ]
                    ],
                ]
            ],
        ];


        foreach ($elements as $category) {
            $Category = new Category();
            
            $Category->setName( $category['categoryName'] );
            
            $products = $category['products'];
            
            if( $products ) {
                foreach( $products as $data ) {
                    $Product = new Product();
                    
                    $Product
                            ->setCategory( $Category )
                            ->setPrice( $data['price'] );
                    
                    foreach( $data['translations'] as $translations ) {
                        foreach( $translations as $locale => $t_data ) {
                            $ProductTranlations = new \Polcode\ProductBundle\Entity\ProductTranslation();
                            $ProductTranlations->setTranslatable( $Product );
                            $ProductTranlations->setName( $t_data['name'] );
                            $ProductTranlations->setDescription( $t_data['description'] );
                            $ProductTranlations->setSlug( $t_data['name'] );
                            $ProductTranlations->setLocale( $locale );
                            
                            $this->manager->persist($ProductTranlations);
                        }
                    }
                $this->manager->persist($Product);
                }
            }

            $this->manager->persist($Category);
        }

        $this->manager->flush();

        
    }


}
