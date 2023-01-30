<?php

namespace App\Repository;

use App\Entity\Currency;
use App\Entity\Item;
use App\Entity\Price;
use App\Entity\Size;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Item>
 *
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    public function save(Item $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Item $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function setupItemPrice(Item $entity, $request): array
    {

        if (count($entity->getPrices()) > 0) { //how much have prices

            if ($entity->getCategory()->isPriceBySize()) { //update All price

                foreach ($entity->getPrices() as $priceObj) {
                    $priceObj->setValue($request->attributes->get('data')->decimal);
                    $this->getEntityManager()->persist($priceObj);
                }
            } else {
                //
            }
        } else {//create new price

            $size = $this->getEntityManager()->getRepository(Size::class)->find($request->attributes->get('data')->sizeId);
            $currency = $this->getEntityManager()->getRepository(Currency::class)->find($request->attributes->get('data')->currencyId);

            $price = new Price();
            $price->setItem($entity);
            $price->setValue($request->attributes->get('data')->decimal);
            $price->setCurrency($currency);
            $price->setSize($size);
            
            $this->getEntityManager()->persist($price);

        }

        $this->getEntityManager()->flush();

        return [];
    }

    //    /**
    //     * @return Item[] Returns an array of Item objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Item
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
