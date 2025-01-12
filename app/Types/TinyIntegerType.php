<?php
namespace App\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class TinyIntegerType extends Type
{
    const TINYINTEGER = 'tinyinteger';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "TINYINT(" . ($fieldDeclaration['length'] ?? 1) . ")";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (int) $value;
    }

    public function getName()
    {
        return self::TINYINTEGER;
    }
}
