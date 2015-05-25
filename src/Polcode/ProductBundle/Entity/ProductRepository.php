<?php

/**
 * Description of Product
 *
 * @author lmalicki
 */

namespace Polcode\ProductBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository {

    public function findBySlugOrId($var) {

        $repository = $this->getEntityManager()->getRepository('PolcodeProductBundle:Product');


//        $query = $repository->createQueryBuilder('e')
//            ->where('e.id = :var')
//            ->orWhere('e.slug = :var')
//            ->setParameters( ['var' => $var])
//            ->getQuery();

        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT p, pTrans
                                FROM PolcodeProductBundle:Product p
                                JOIN p.translations pTrans
                                WHERE p.id = :id
                                    or pTrans.slug = :id'
                        )->setParameter('id', $var);

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }

    }

}