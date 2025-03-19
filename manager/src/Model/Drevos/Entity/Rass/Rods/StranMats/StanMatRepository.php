<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\Rods\StranMats;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class StanMatRepository
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(StanMat::class);
        $this->em = $em;
    }

//    public function getRodId(string $nameMatkov): Id
//    {
//        /** @var StanMat $stranmat*/
//        if ($stranmat= $this->repo->findOneBy(['nameMatkov' => $nameMatkov]))
//        return $stranmat>getId();
//    }
//    public function hasRod(string $nameMatkov): bool
//    {
//        return $this->repo->createQueryBuilder('t')
//                ->select('COUNT(t.nameMatkov)')
//                ->andWhere('t.nameMatkov = :nameMatkov')
//                ->setParameter(':nameMatkov', $nameMatkov)
//                ->getQuery()->getSingleScalarResult() > 0;
//    }

//    public function getByLinia(string $name_star, string $idVetka ): Linia
//    {
//        /** @var Linia $stranmat */
//        if (!$stranmat = $this->repo->findOneBy([
//                'nameStar' => $name_star,
//                'idVetka' => $idVetka
//
//        ]))
//        {
//            throw new EntityNotFoundException('Linia не найдена.');
//        }
//        return $stranmat;
//    }

    public function has(Id $id): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.id = :id')
                ->setParameter(':id', $id->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    public function get(Id $id): StanMat
    {
        /** @var StanMat $stranmat */
        if (!$stranmat = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('StanMat is not found.');
        }
        return $stranmat;
    }

    public function add(StanMat $stranmat): void
    {
        $this->em->persist($stranmat);
    }
}
