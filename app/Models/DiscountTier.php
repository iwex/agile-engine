<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DiscountTier
 *
 * @property int $id
 * @property int $percent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voucher[] $vouchers
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DiscountTier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DiscountTier wherePercent($value)
 * @mixin \Eloquent
 */
class DiscountTier extends Model
{
    public $timestamps = false;
    
    protected $guarded = [
        'id'
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
