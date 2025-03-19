<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\Rods;

use App\Model\Drevos\Entity\Rass\Ras;

use App\Model\Drevos\Entity\Rass\Rods\Linis\Id as LiniId;
use App\Model\Drevos\Entity\Rass\Rods\Linis\Lini;
use App\Model\Drevos\Entity\Rass\Rods\StranMats\StanMat;
use App\Model\Drevos\Entity\Rass\Rods\StranMats\Id AS StranMatId;
use App\Model\Drevos\Entity\Strans\Stran;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dre_ras_rods")
 */
class Rod
{
    /**
     * @var Ras
     * @ORM\ManyToOne(targetEntity="App\Model\Drevos\Entity\Rass\Ras", inversedBy="rodos")
     * @ORM\JoinColumn(name="rasa_id", referencedColumnName="id", nullable=false)
     */
    private $rasa;

    /**
     * @var Id
     * @ORM\Column(type="dre_ras_rod_id")
     * @ORM\Id
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nameMatkov;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $kodMatkov;

    /**
     * @var ArrayCollection|StanMat[]
     * @ORM\OneToMany(
     *     targetEntity="App\Model\Drevos\Entity\Rass\Rods\StranMats\StanMat",
     *     mappedBy="rodo", orphanRemoval=true, cascade={"all"}
     * )
     * @ORM\OrderBy({"nameS" = "ASC"})
     */
    private $stranmats;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $sortRodo;


    public function __construct(
        Ras $rasa,
        Id $id,
        int $sortRodo,
        string $nameMatkov,
        string $kodMatkov
    ) {
        $this->rasa = $rasa;
        $this->id = $id;
        $this->sortRodo = $sortRodo;
        $this->nameMatkov = $nameMatkov;
        $this->kodMatkov = $kodMatkov;

        $this->stranmats = new ArrayCollection();
    }

    public function edit(
        string $nameMatkov,
        string $kodMatkov
    ): void {
        $this->nameMatkov = $nameMatkov;
        $this->kodMatkov = $kodMatkov;
    }


    public function addStranMat(
        StranMatId $id,
        string $nameS,
        Stran $strana

    ): void {
        foreach ($this->stranmats as $stranmat) {
            if ($stranmat->isStranMatEqual($nameS)) {
                throw new \DomainException(
                    'Страна уже существует. Попробуйте для
                этой линии добавить свой номер'
                );
            }
        }

        $this->stranmats->add(
            new StanMat(
                $this,
                $id,
                $nameS,
                $strana
            )
        );
    }

    public function editStranMat(
        StranMatId $id,
        string $name
    ): void {
        foreach ($this->stranmats as $current) {
            if ($current->getId()->isEqual($id)) {
                $current->edit($name);
                return;
            }
        }
        throw new \DomainException('Linia is not found.');
    }

    public function removeStranMats(StranMatId $id): void
    {
        foreach ($this->stranmats as $stranmat) {
            if ($stranmat->getId()->isEqual($id)) {
                $this->stranmats->removeElement($stranmat);
                return;
            }
        }
        throw new \DomainException('StranMat is not found.');
    }


    public function getStranMats()
    {
        return $this->stranmats->toArray();
    }

    public function getStranMat(StranMatId $id): StanMat
    {
        foreach ($this->stranmats as $stranmat) {
            if ($stranmat->getId()->isEqual($id)) {
                return $stranmat;
            }
        }
        throw new \DomainException('stranmats is not found.');
    }


// равно Ли Имя
    public function isNameMatEqual(string $nameMatkov): bool
    {
        return $this->nameMatkov === $nameMatkov;
    }

    public function isKodMatkovEqual(string $kodMatkov): bool
    {
        return $this->kodMatkov === $kodMatkov;
    }


    public function getId(): Id
    {
        return $this->id;
    }


    public function getSortRodo(): int
    {
        return $this->sortRodo;
    }


    public function getNameMatkov(): string
    {
        return $this->nameMatkov;
    }


    public function getKodMatkov(): string
    {
        return $this->kodMatkov;
    }


    public function getRasa(): Ras
    {
        return $this->rasa;
    }


}
