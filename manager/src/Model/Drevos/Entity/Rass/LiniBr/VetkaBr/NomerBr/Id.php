<?php

declare(strict_types=1);

namespace App\Model\Drevos\Entity\Rass\LiniBr\VetkaBr\NomerBr;

use Webmozart\Assert\Assert;

class Id
{
    private $value;

    public function __construct(int $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

//    public static function next(): self
//    {
//        return new self(Uuid::uuid4()->toString());
//    }

    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}