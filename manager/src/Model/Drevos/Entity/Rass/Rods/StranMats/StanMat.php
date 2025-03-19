<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\Rods\StranMats;

use App\Model\Drevos\Entity\Rass\Rods\Linis\Id as LiniId;
use App\Model\Drevos\Entity\Rass\Rods\Linis\Lini;
use App\Model\Drevos\Entity\Rass\Rods\Rod;
use App\Model\Drevos\Entity\Strans\Stran;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dre_ras_rod_stranmats")
 */
class StanMat
{
    /**
     * @var Rod
     * @ORM\ManyToOne(targetEntity="App\Model\Drevos\Entity\Rass\Rods\Rod", inversedBy="stranmats")
     * @ORM\JoinColumn(name="rodo_id", referencedColumnName="id", nullable=false)
     */
    private $rodo;

    /**
     * @var Id
     * @ORM\Column(type="dre_ras_rod_stranmat_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nameS;

    /**
     * @var Stran
     * @ORM\ManyToOne(targetEntity="App\Model\Drevos\Entity\Strans\Stran")
     * @ORM\JoinColumn(name="strana_id", referencedColumnName="id", nullable=false)
     */
    private $strana;

    /**
     * @var ArrayCollection|Lini[]
     * @ORM\OneToMany(
     *     targetEntity="App\Model\Drevos\Entity\Rass\Rods\Linis\Lini",
     *     mappedBy="stranmat", orphanRemoval=true, cascade={"all"}
     * )
     * @ORM\OrderBy({"name" = "ASC"})
     */
    private $linias;


    public function __construct(
        Rod $rodo,
        Id $id,
        string $nameS,
        Stran $strana

    ) {
        $this->rodo = $rodo;
        $this->id = $id;
        $this->nameS = $nameS;
        $this->strana = $strana;


        $this->linias = new ArrayCollection();
    }

    public function edit(string $nameS
    ): void {
        $this->nameS = $nameS;
    }

//==================== не трогать
    public function addLini(
        LiniId $id,
        string $name,
        int $sortLini
    ): void {
        foreach ($this->linias as $linia) {
            if ($linia->isNameEqual($name)) {
                throw new \DomainException(
                    'Линия уже существует. Попробуйте для
                этой линии добавить свой номер'
                );
            }
        }

        $this->linias->add(
            new Lini(
                $this,
                $id,
                $name,
                $sortLini
            )
        );
    }

    public function editLinia(
        LiniId $id,
        string $name
    ): void {
        foreach ($this->linias as $current) {
            if ($current->getId()->isEqual($id)) {
                $current->edit($name);
                return;
            }
        }
        throw new \DomainException('Linia is not found.');
    }

    public function removeLinia(LiniId $id): void
    {
        foreach ($this->linias as $linia) {
            if ($linia->getId()->isEqual($id)) {
                $this->linias->removeElement($linia);
                return;
            }
        }
        throw new \DomainException('Linia is not found.');
    }

    /**
     * @return Lini[]|ArrayCollection
     */
    public function getLinias()
    {
        return $this->linias;
    }


    public function getLinia(LiniId $id): Lini
    {
        foreach ($this->linias as $linia) {
            if ($linia->getId()->isEqual($id)) {
                return $linia;
            }
        }
        throw new \DomainException('Linia is not found.');
    }


// равно Ли Имя
    public function isStranMatEqual(string $nameS): bool
    {
        return $this->nameS === $nameS;
    }


    public function getRodo(): Rod
    {
        return $this->rodo;
    }


    public function getNameS(): string
    {
        return $this->nameS;
    }

    public function getId(): Id
    {
        return $this->id;
    }


    public function getStrana(): Stran
    {
        return $this->strana;
    }


}
