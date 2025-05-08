<?php

namespace App\Enums;

enum StatusClub:string
{
    case Active = "active";
    case Inactive = "inactive";

    public static function mapValue(string $statusRC):self
    {
        return match (mb_strtolower($statusRC)){
            'active','Đang hoạt động', 'đang hoạt động' , 'dang hoat dong' => self::Active,
            'inactive', 'Ngừng hoạt động' , 'ngừng hoạt động' , 'ngung hoat dong' => self::Inactive,
            default => self::Inactive,
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::Active => 'Đang hoạt động',
            self::Inactive => 'Ngừng hoạt động',
        };
    }
}
