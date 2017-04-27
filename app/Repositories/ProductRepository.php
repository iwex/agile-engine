<?php

namespace App\Repositories;

use App\Models\Product;
use Rinvex\Repository\Repositories\EloquentRepository;

/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductRepository extends EloquentRepository
{
    protected $repositoryId = 'repository.product';
    
    protected $model = Product::class;
}