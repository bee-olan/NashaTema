<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\NomerBr;

use App\Model\Drevos\Entity\Rass\LiniBr\LiniBr;

use App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\VetkaBr;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dre_ras_linibr_vet_noms")
 */
class NomerBr
{

    /**
     * @var VetkaBr
     * @ORM\ManyToOne(targetEntity="App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\VetkaBr", inversedBy="nomers")
     * @ORM\JoinColumn(name="vetka_id", referencedColumnName="id", nullable=false)
     */
    private $vetka;


    /**
     * @var Id
     * @ORM\Column(type="dre_ras_linibr_vet_nom_id")
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\SequenceGenerator(sequenceName="dre_ras_linibr_vet_nom_seq", initialValue=1)
     * @ORM\Id
     */
    private $id;
//SEQUENCE  -- NONE

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nomBr;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $god;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $sortNom;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var Status
     * @ORM\Column(type="dre_ras_linibr_vet_nom_status", length=16)
     */
    private $status;

    private $newLinia;


    /**
     * @var NomerBr|null
     * @ORM\ManyToOne(targetEntity="NomerBr")
     * @ORM\JoinColumn(name="parentn_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $parentn;  // родитель

    public function __construct(VetkaBr $vetka, Id $id,
                                string $nomBr,
                                string $god,
                                int $sortNom,
                                string $title,
                                ?NomerBr $parentn)
    {
        $this->vetka = $vetka;
        $this->id = $id;
        $this->nomBr = $nomBr;
        $this->god = $god;
        $this->sortNom = $sortNom;
        $this->title = $title;
        $this->parentn = $parentn;

        $this->status = Status::ojidaet();

    }

    public function edit(string $nomBr, string $god): void
    {
        $this->nomBr = $nomBr;
        $this->god = $god;
    }

// линия от ветки или новая из номера
    public function getNewLinia(): string
    {
        if ($this->getTitle() == '-') {
            $this->newLinia = $this->getVetka()->getLinia()->getName() . ' : ' . $this->getVetka()->getNomer() . '-' . $this->getVetka()->getGod();
        } else {
            $this->newLinia = $this->getTitle();
        }
        return $this->newLinia;
    }

    //------------------------------------------------------

    public function setChildNom(?NomerBr $parentn): void
    {
        if ($parentn) {
            $current = $parentn;
            do {
                if ($current === $this) {
                    throw new \DomainException('Цикломатические дети..');
                }
            } while ($current && $current = $current->getParentn());
        }

        $this->parentn = $parentn;
    }

    //------------------------------------------------------
    public function archive(): void
    {
        if ($this->isArchived()) {
            throw new \DomainException('Номер уже заархивирован.');
        }
        $this->status = Status::archived();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function esVetka(): void
    {
        $this->setSortNom(1);
    }

    public function noVetka(): void
    {
        $this->setSortNom(0);
    }

    public function setSortNom(int $sortNom): void
    {
//        =0 нет ветки,  =1 сдулала ветку

        $this->sortNom = $sortNom;
    }

    public function reinstate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Номер уже активен.?');
        }
        $this->status = Status::active();
    }

    public function ojidaetActive(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Номер уже активен.?');
        }
        $this->status = Status::active();

    }

    public function activeOjidaet(): void
    {
        if ($this->isOjidaet()) {
            throw new \DomainException('Номер уже ожидает');
        }
        $this->status = Status::ojidaet();

    }

    public function isArchived(): bool
    {
        return $this->status->isArchived();
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }

    public function isOjidaet(): bool
    {
        return $this->status->isOjidaet();
    }


// равно Ли Имя
    public function isNomerEqual(string $nomBr): bool
    {
        return $this->nomBr === $nomBr;
    }


    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return VetkaBr
     */
    public function getVetka(): VetkaBr
    {
        return $this->vetka;
    }


    public function getNomBr(): string
    {
        return $this->nomBr;
    }

    public function getGod(): string
    {
        return $this->god;
    }

    public function getSortNom(): int
    {
        return $this->sortNom;
    }


    public function getParentn(): ?NomerBr
    {
        return $this->parentn;
    }


//
//    public function getNomWets()
//    {
//        return $this->nomwets->toArray();
//    }
//
//    public function getNomWet(NomWetId $id): NomWet
//    {
//        foreach ($this->nomwets as $nomwet) {
//            if ($nomwet->getId()->isEqual($id)) {
//                return $nomwet;
//            }
//        }
//        throw new \DomainException('NomWet is not found.');
//    }


}
