<?php

namespace App\Http\Api\Controllers\Voucher;

use App\Http\Api\Responses\Transformers\VoucherTransformer;
use App\Http\Controllers\Controller;
use App\Repositories\VoucherRepository;

class ListController extends Controller
{
    protected $perPage = 25;
    
    /**
     * GET /vouchers
     *
     * Get list of all vouchers
     *
     * @param \App\Repositories\VoucherRepository $voucherRepository
     *
     * @return \App\Http\Api\Responses\ArrayResponse
     */
    public function index(VoucherRepository $voucherRepository)
    {
        $vouchers = $voucherRepository->paginate($this->perPage);
        
        return fractalResponse($vouchers, VoucherTransformer::class);
    }
}
