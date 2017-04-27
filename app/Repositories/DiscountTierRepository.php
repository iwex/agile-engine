<?php

namespace App\Repositories;

use App\Models\DiscountTier;
use Rinvex\Repository\Repositories\EloquentRepository;

/**
 * Class DiscountTierRepository
 *
 * @package App\Repositories
 */
class DiscountTierRepository extends EloquentRepository
{
    protected $repositoryId = 'repository.discount_tier';
    
    protected $model = DiscountTier::class;
}