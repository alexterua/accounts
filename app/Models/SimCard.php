<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SimCard extends Model
{
    use HasFactory, SoftDeletes;

    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

    protected $table = 'sim_cards';
    protected $guarded = false;

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id', 'accounts');
    }
}
