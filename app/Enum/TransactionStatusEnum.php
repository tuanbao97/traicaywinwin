<?php

namespace App\Enum;

enum TransactionStatusEnum: string
{
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case SHIPPING = 'SHIPPING';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';

    public function description(): string
    {
        return match ($this) {
            self::PENDING => 'Chờ xác nhận',
            self::CONFIRMED => 'Đã xác nhận',
            self::SHIPPING => 'Đang giao hàng',
            self::COMPLETED => 'Hoàn thành',
            self::CANCELLED => 'Đã hủy',
        };
    }
}
