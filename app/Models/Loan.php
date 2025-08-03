<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Loan
 *
 * @property int $id
 * @property int $member_id
 * @property string $loan_type
 * @property string $product_name
 * @property float $amount
 * @property float $remaining_balance
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read CooperativeMember $member
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereLoanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRemainingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan active()
 * @method static \Database\Factories\LoanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'member_id',
        'loan_type',
        'product_name',
        'amount',
        'remaining_balance',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the cooperative member that owns the loan.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(CooperativeMember::class, 'member_id');
    }

    /**
     * Scope a query to only include active loans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}