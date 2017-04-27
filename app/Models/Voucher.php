<?php

namespace App\Models;

use App\Repositories\VoucherRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Voucher
 *
 * @property int $id
 * @property bool $discount_tier_id
 * @property \Carbon\Carbon $start_date
 * @property \Carbon\Carbon $end_date
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\DiscountTier $discountTier
 * @property-read int $percent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereDiscountTierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereEndDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Voucher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Voucher extends Model
{
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime'
    ];
    
    protected $guarded = [
        'id'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        // Show only available vouchers
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->where('available', true);
        });
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discountTier()
    {
        return $this->belongsTo(DiscountTier::class);
    }
    
    /**
     * Set voucher status to unavailable
     */
    public function markAsUnavailable()
    {
        /** @var VoucherRepository $repo */
        $repo = resolve(VoucherRepository::class);
        $repo->update($this->id, ['available' => false]);
    }
    
    /**
     * Get discount tier percent
     *
     * @return int
     */
    public function getPercentAttribute()
    {
        return $this->discountTier->percent;
    }
    
    /**
     * Check if voucher expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return time() > $this->end_date->timestamp;
    }
}
