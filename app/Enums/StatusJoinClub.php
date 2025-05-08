<?php

namespace App\Enums;

enum StatusJoinClub:string
{
    case Pending="pending";
    case Approved = "approved";
    case Rejected="rejected";
    case Cancelled="cancelled";
    case In_review="in_review";
    case Interview="interview";
    case Fail="fail";

    public static function mapValue(string $statusRC):self
    {
        return match (mb_strtolower($statusRC)){
            'pending','Chờ duyệt', 'chờ duyệt' , 'cho duyet' => self::Pending,
            'approved', 'Đã duyệt' , 'đã duyệt' , 'da duyet' => self::Approved,
            'rejected', 'Từ chối' ,'từ chối' , 'tu choi' => self::Rejected,
            'cancelled', 'Đã hủy', 'đã hủy', 'da huy' => self::Cancelled,
            'in_review', 'Đang xem xét' ,'đang xem xét' , 'dang xem xet' => self::In_review,
            'interview', 'Đã hẹn phỏng vấn' ,'đã hẹn phỏng vấn' , 'da hen phong van' => self::Interview,
            'fail', 'Gửi email thất bại' ,'gửi email thất bại' , 'gui email that bai' => self::Fail,
            default => self::Pending,

        };
    }
    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Chờ duyệt',
            self::Approved => 'Đã duyệt',
            self::Rejected => 'Từ chối',
            self::Cancelled => 'Đã hủy',
            self::In_review => 'Đang xem xét',
            self::Interview => 'Đã hẹn phỏng vấn',
            self::Fail => 'Gửi email thất bại',
        };
    }
}
