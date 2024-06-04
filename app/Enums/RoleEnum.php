<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum RoleEnum: string
{

    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case OPERATOR = 'operator';
    case MEMBER = 'member';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::SUPER_ADMIN => ucwords(Str::replace('_', ' ', self::SUPER_ADMIN->value)),
            static::ADMIN => ucwords(Str::replace('_', ' ', self::ADMIN->value)),
            static::OPERATOR => ucwords(Str::replace('_', ' ', self::OPERATOR->value)),
            static::MEMBER => ucwords(Str::replace('_', ' ', self::MEMBER->value)),
        };
    }
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    public function color()
    {
        return match ($this) {
            static::SUPER_ADMIN => 'danger',
            static::ADMIN => 'primary',
            static::OPERATOR => 'info',
            static::MEMBER => 'warning',
        };
    }
}
