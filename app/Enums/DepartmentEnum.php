<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Admin()
 * @method static static Manager()
 * @method static static TeamLead()
 * @method static static Staff()
 * @method static static Customer()
 * @method static static Other()
 */
final class DepartmentEnum extends Enum
{
    const Admin = 1;
    const Manager = 2;
    const TeamLead = 3;
    const Staff = 4;
    const Customer = 5;
    const Other = 6;
}
