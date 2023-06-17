<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ChamSoc
 * @method static static DieuTri
 * @method static static ThamMy
 * @method static static PhunXam
 */
final class CategoryEnum extends Enum
{
    const ChamSoc = 1;
    const DieuTri = 2;
    const ThamMy = 3;
    const PhunXam = 4;
}
