<?php

declare(strict_types=1);

namespace App\Model\Adminka\UseCase\PcheloMatkas\PcheloMatka\Pchelovod\Edit;

//use App\Model\Adminka\Entity\Matkas\PlemMatka\Pchelosezon\Pchelosezon;
//use App\Model\Adminka\Entity\Matkas\PlemMatka\PlemMatka;
use App\Model\Adminka\Entity\PcheloMatkas\PcheloMatka\Pchelovod;

use App\Model\Adminka\Entity\PcheloMatkas\PcheloMatka\PcheloMatka;
use App\Model\Adminka\Entity\PcheloMatkas\PcheloMatka\Pchelosezon\Pchelosezon;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public $pchelomatka;
    /**
     * @Assert\NotBlank()
     */
    public $uchastie;
    /**
     * @Assert\NotBlank()
     */
    public $pchelosezons;

    public function __construct(string $pchelomatka, string $uchastie)
    {
        $this->pchelomatka = $pchelomatka;
        $this->uchastie = $uchastie;
    }

    public static function fromPchelovod(PcheloMatka $pchelomatka, Pchelovod $pchelovod): self
    {
        $command = new self($pchelomatka->getId()->getValue(), $pchelovod->getUchastie()->getId()->getValue());
        $command->pchelosezons = array_map(static function (Pchelosezon $pchelosezon): string {
            return $pchelosezon->getId()->getValue();
        }, $pchelovod->getPchelosezons());
//        $command->roles = array_map(static function (Role $role): string {
//            return $role->getId()->getValue();
//        }, $pchelovod->getRoles());
        return $command;
    }
}
