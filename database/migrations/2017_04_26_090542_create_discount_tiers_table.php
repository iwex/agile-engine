<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountTiersTable extends Migration
{
    protected $foreignDiscounts = 'fk_discounts_vouchers';
    
    protected $defaultTiers = [
        10,
        15,
        20,
        25
    ];
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'discount_tiers',
            function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->unsignedInteger('percent');
            }
        );
        
        foreach ($this->defaultTiers as $defaultTier) {
            \App\Models\DiscountTier::create(['percent' => $defaultTier]);
        }
        
        Schema::table(
            'vouchers',
            function (Blueprint $table) {
                $table->foreign('discount_tier_id', $this->foreignDiscounts)
                      ->references('id')
                      ->on('discount_tiers')
                      ->onDelete('cascade');
            }
        );
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'vouchers',
            function (Blueprint $table) {
                $table->dropForeign($this->foreignDiscounts);
            }
        );
        
        Schema::dropIfExists('discount_tiers');
    }
}
