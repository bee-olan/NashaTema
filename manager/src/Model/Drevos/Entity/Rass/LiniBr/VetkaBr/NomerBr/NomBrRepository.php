<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\NomerBr;

use App\Model\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

class NomBrRepository
{
//    /**
//     * @var \Doctrine\ORM\EntityRepository
//     */
    private $repo;
    private $connection;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(NomerBr::class);
        $this->connection = $em->getConnection();
        $this->em = $em;
    }



    public function has(Id $id): bool
    {
        return $this->repo->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.id = :id')
                ->setParameter(':id', $id->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    public function get(Id $id): NomerBr
    {
        /** @var NomerBr $nomer */
        if (!$nomer = $this->repo->find($id->getValue())) {
            throw new EntityNotFoundException('NomerBr is not found.  NomBrReposit');
        }
        return $nomer;
    }

    public function add(NomerBr $nomer): void
    {
        $this->em->persist($nomer);
    }

    public function nextId(): Id
    {
        return new Id((int)$this->connection->query('SELECT nextval(\'dre_ras_linibr_vet_nom_seq\')')->fetchColumn());
    }
}
