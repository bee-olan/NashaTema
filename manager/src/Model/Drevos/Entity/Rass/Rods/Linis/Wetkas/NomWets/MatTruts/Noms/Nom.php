<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\Rods\Linis\Wetkas\NomWets\MatTruts\Noms;

use App\Model\Adminka\Entity\Uchasties\Uchastie\Id as UchastieId;

use App\Model\Adminka\Entity\Uchasties\Uchastie\Uchastie;

use App\Model\Drevos\Entity\Rass\Rods\Linis\Wetkas\NomWets\MatTruts\MatTrut;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dre_ras_rod_lini_wet_nomw_noms")
 */
class Nom
{
    /**
     * @var MatTrut
     * @ORM\ManyToOne(targetEntity="App\Model\Drevos\Entity\Rass\Rods\Linis\Wetkas\NomWets\MatTruts\MatTrut", inversedBy="nomers")
     * @ORM\JoinColumn(name="mattrut_id", referencedColumnName="id", nullable=false)
     */
    private $mattrut;

    /**
     * @var Id
     * @ORM\Column(type="dre_ras_rod_lini_wet_nomw_nom_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $god;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $tit;

//    /**
//     * @var string
//     * @ORM\Column(type="string")
//     */
    private $rasaName;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $sortNom;

    /**
     * @var Statu
     * @ORM\Column(type="dre_ras_rod_lini_wet_nomw_nom_stat", length=16)
     */
    private $status;

    /**
     * @var Uchastie
     * @ORM\ManyToOne(targetEntity="App\Model\Adminka\Entity\Uchasties\Uchastie\Uchastie")
     * @ORM\JoinColumn(name="zakazal_id", referencedColumnName="id", nullable=false)
     */
    private $zakazal;

    private $drevMat;

    public function __construct(
        MatTrut $mattrut,
        Id $id,
        string $nom,
        string $god,
        string $tit,
        int $sortNom,
        Uchastie $zakazal
    ) {
        $this->mattrut = $mattrut;
        $this->id = $id;
        $this->nom = $nom;
        $this->god = $god;
        $this->tit = $tit;
        $this->sortNom = $sortNom;
        $this->zakazal = $zakazal;

        $this->status = Statu::ojidaet();
//        $this->zakazals = new ArrayCollection();
    }

    public function edit(
        string $nom,
        string $god,
        string $tit
    ): void {
        $this->nom = $nom;
        $this->god = $god;
        $this->tit = $tit;
    }

    public function wseRodosMat(): string
    {
        $nomer = $this->nom;
        $mattrut = $this->mattrut;

        $nomwet = $mattrut->getNomwet();
        $wetka = $nomwet->getWetka();

        $wetkaW = $wetka->getNameW() . "-" . $nomwet->getTitW();
        $wetkaMat = $nomwet->getTitMat();
        $mattrutW = $mattrut->getNameOt();
        $linia = $wetka->getLinia();
        $lini = $linia->getName();
        $stranmat = $linia->getStranmat()->getNameS();
        $rodo = $linia->getStranmat()->getRodo();
        $rodoW = $rodo->getNameMatkov() . "-" . $rodo->getKodMatkov();
        $rass = $rodo->getRasa()->getName();

        $nomerW = $this->getTit();

        $wseRodoMat = " Раса: " . $rass . " | матковод: " . $rodoW . " |страна:". $stranmat."| линия: " . $lini . " | материнка-номер: ".$wetkaMat. " | материнка-рег/ном: " . $wetkaW . " | материнка трутня-рег/ном: " . $mattrutW . " | номер: " . $nomerW;
        return $wseRodoMat;
    }

    public function miniRodosMat(): string
    {
        $nomer = $this->nom;
        $mattrut = $this->mattrut;

        $nomwet = $mattrut->getNomwet();
        $wetka = $nomwet->getWetka();

        $nomwetW = $nomwet->getNomW();
        $wetkaMat = $nomwet->getTitMat();
        $linia = $wetka->getLinia();
        $lini = $linia->getName();
        $stranmat = $linia->getStranmat();
        $rodo = $stranmat->getRodo();
        $rass = $rodo->getRasa()->getName();
        $this->setRasaName($rass);
        $nomerW = $this->getTit();

        $miniRodoMat = $rass . " : " . $lini. " : " . $wetkaMat . " : " . $nomerW;

        return $miniRodoMat;
    }

//------------------------------------------------------
    public function archive(): void
    {
        if ($this->isArchived()) {
            throw new \DomainException('Номер уже заархивирован.');
        }
        $this->status = Statu::archived();
    }

    public function reinstate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Номер уже активен.');
        }
        $this->status = Statu::active();
    }

    public function ojidaetActive(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Номер уже активен.?');
        }
        $this->status = Statu::active();
    }

    public function activeOjidaet(): void
    {
        if ($this->isOjidaet()) {
            throw new \DomainException('Номер уже ожидает');
        }
        $this->status = Statu::ojidaet();
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

// -----------------------------------------------------------

    public function isTitEqual(string $tit): bool
    {
        return $this->tit === $tit;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getSortNom(): int
    {
        return $this->sortNom;
    }

    public function getStatus(): Statu
    {
        return $this->status;
    }

    public function getMattrut(): MatTrut
    {
        return $this->mattrut;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getGod(): string
    {
        return $this->god;
    }


    public function getTit(): string
    {
        return $this->tit;
    }

    /**
     * @return mixed
     */
    public function getDrevMat()
    {
        return $this->drevMat;
    }

    public function getZakazal(): Uchastie
    {
        return $this->zakazal;
    }

    /**
     * @return mixed
     */
    public function getRasaName()
    {
        return $this->rasaName;
    }

    /**
     * @param mixed $rasaName
     */
    public function setRasaName($rasaName): void
    {

        $this->rasaName = $rasaName;
    }


}
