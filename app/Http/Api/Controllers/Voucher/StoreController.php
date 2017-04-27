<?php

namespace App\Http\Api\Controllers\Voucher;

use App\Http\Api\Requests\Voucher\StoreVoucherRequest;
use App\Http\Api\Responses\Transformers\VoucherTransformer;
use App\Http\Controllers\Controller;
use App\Repositories\VoucherRepository;
use Carbon\Carbon;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    /**
     * POST /vouchers
     *
     * Create new voucher
     *
     * @param \App\Http\Api\Requests\Voucher\StoreVoucherRequest $request
     * @param \App\Repositories\VoucherRepository $voucherRepository
     *
     * @return \App\Http\Api\Responses\ArrayResponse
     */
    public function store(StoreVoucherRequest $request, VoucherRepository $voucherRepository)
    {
        $toSave = $request->only('discount_tier_id', 'start_date', 'end_date');
        
        $toSave = $this->prepareDates($toSave);
        
        $voucher = $voucherRepository->create($toSave);
        
        return fractalResponse($voucher, VoucherTransformer::class, Response::HTTP_CREATED);
    }
    
    /**
     * Assign Carbon dates to save in model
     *
     * @param $toSave
     *
     * @return array
     */
    protected function prepareDates($toSave)
    {
        $toSave['start_date'] = Carbon::parse($toSave['start_date']);
        $toSave['end_date']   = Carbon::parse($toSave['end_date']);
        
        return $toSave;
    }
}
