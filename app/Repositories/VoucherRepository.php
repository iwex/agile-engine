<?php

namespace App\Repositories;

use App\Models\Voucher;
use Rinvex\Repository\Repositories\EloquentRepository;

/**
 * Class VoucherRepository
 *
 * @package App\Repositories
 */
class VoucherRepository extends EloquentRepository
{
    protected $repositoryId = 'repository.voucher';
    
    protected $model = Voucher::class;
}