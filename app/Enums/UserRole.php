<?php

namespace App\Enums;

enum UserRole:string
{
    case SuperAdmin = 'super_admin';
    case Officer = 'officer';
    case Student = 'student';
    case Normal = 'normal';

    public static function values()
    {
        return [
            self::SuperAdmin->value =>'Quản trị viên',
            self::Officer->value =>'Giảng viên - Cán bộ Khoa',
            self::Student->value =>'Sinh viên',
            self::Normal->value =>'Người dùng bình thường',
        ];
    }

    public static function getLabel(): string
    {
        return self::values()[$his->value] ?? 'Người dùng bình thường';
    }
}
