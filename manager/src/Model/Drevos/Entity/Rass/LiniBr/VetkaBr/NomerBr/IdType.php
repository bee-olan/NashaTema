<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\NomerBr;

use Doctrine\DBAL\Platforms\AbstractPlatform;

use Doctrine\DBAL\Types\IntegerType;

class IdType extends IntegerType
{
    public const NAME = 'dre_ras_linibr_vet_nom_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Id ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Id($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
    
    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
}