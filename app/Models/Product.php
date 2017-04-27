<?php

namespace App\Models;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property bool $available
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voucher[] $vouchers
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereAvailable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    /**
     * Max available discount
     *
     * @var int
     */
    protected $maxDiscount = 60;
    
    protected $guarded = [
        'id'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        // Show only available products
        static::addGlobalScope(
            'available',
            function (Builder $builder) {
                $builder->where('available', true);
            }
        );
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class);
    }
    
    /**
     * Buy product - make this and associated vouchers as unavailable
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function buy()
    {
        \DB::transaction(
            function () {
                $this->markAsUnavailable();
                $this->vouchers->each->markAsUnavailable();
            }
        );
    }
    
    /**
     * Set product status to unavailable
     */
    public function markAsUnavailable()
    {
        /** @var ProductRepository $repo */
        $repo = resolve(ProductRepository::class);
        $repo->update($this->id, ['available' => false]);
    }
    
    /**
     * Calculate discounted price
     *
     * @return float
     */
    public function discountedPrice() : float
    {
        return round($this->price * (1 - $this->discount() / 100), 2);
    }
    
    /**
     * Get discount value
     *
     * @return int
     */
    public function discount() : int
    {
        return min(
            $this->maxDiscount,
            $this->vouchers->sum(
                function (Voucher $voucher) {
                    if ($voucher->isExpired()) {
                        return 0;
                    }
                    
                    return $voucher->percent;
                }
            )
        );
    }
}
