<?php

namespace App\Models;

use App\Enum\AppConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $primaryKey = 'ID';

    protected $keyType = 'integer';

    public $incrementing = true;

    protected $guarded = [];

    protected $hidden = [];

    const CREATED_AT = 'CRT_DT';
    const UPDATED_AT = 'UPD_DT';
    public $timestamps = true;

    protected $attributes = [
        'ID' => null,
        'USER_BUY_ID' => null,
        'USER_BUY_EMAIL' => null,
        'USER_BUY_FULLNAME' => null,
        'USER_BUY_PHONE' => null,
        'USER_BUY_ADDRESS' => null,
        'TOTAL_QUANTITY' => 0,
        'TOTAL_PRICE' => 0,
        'USER_BUY_MESSAGE' => null,
        'TRANSACTION_STATUS' => null,
        'PAYMENT_METHOD' => null,
        'PAYMENT_DATE' => null,
        'CRT_DT' => null,
        'UPD_DT' => null,
        'CRT_ID' => null,
        'UPD_ID' => null,
        'CRT_NAME' => null,
        'UPD_NAME' => null,
        'STATUS' => 'USING',
        'IS_ACTIVE' => true,
    ];

    protected $casts = [
        'IS_ACTIVE' => 'boolean',
        'CRT_DT' => 'datetime',
        'UPD_DT' => 'datetime',
        'PAYMENT_DATE' => 'datetime',
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'TRANSACTION_ID', 'ID')
            ->where('STATUS', AppConstant::STATUS_USING);
    }
}
