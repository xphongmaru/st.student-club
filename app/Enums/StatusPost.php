<?php

namespace App\Enums;

enum StatusPost:string
{
    case draft = 'draft';
    case pending = 'pending';
    case approved = 'approved';
    case published = 'published';
    case private = 'private';
    case scheduled = 'scheduled';
    case rejected = 'rejected';
    public static function mapValue(string $statusRC):self
    {
        return match (mb_strtolower($statusRC)){
            'draft','bản nháp', 'ban nhap' => self::draft,
            'pending', 'chờ duyệt' , 'cho duyet' => self::pending,
            'approved', 'đã duyệt' , 'da duyet' => self::approved,
            'published', 'đã xuất bản' , 'da xuat ban' => self::published,
            'private', 'riêng tư' ,' rieng tu' => self::private,
            'rejected', 'đã từ chối' ,'da tu choi' => self::rejected,
            'scheduled', 'đã lên lịch' ,'da len lich' => self::scheduled,
            default => self::draft,
        };
    }
    public function label(): string
    {
        return match ($this) {
            self::draft => 'Bản nháp',
            self::pending => 'Chờ duyệt',
            self::approved => 'Đã duyệt',
            self::published => 'Đã xuất bản',
            self::private => 'Riêng tư',
            self::scheduled => 'Đã lên lịch',
            self::rejected => 'Đã từ chối',
        };
    }
}
