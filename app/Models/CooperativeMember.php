<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\CooperativeMember
 *
 * @property int $id
 * @property int $user_id
 * @property string $member_number
 * @property float $simpanan_pokok
 * @property float $simpanan_wajib
 * @property float $simpanan_sukarela
 * @property float $total_pinjaman
 * @property int $unread_notifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Loan> $loans
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Transaction> $transactions
 * @property-read float $total_simpanan
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereMemberNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereSimpananPokok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereSimpananWajib($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereSimpananSukarela($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereTotalPinjaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereUnreadNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CooperativeMember whereUpdatedAt($value)
 * @method static \Database\Factories\CooperativeMemberFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class CooperativeMember extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'member_number',
        'simpanan_pokok',
        'simpanan_wajib',
        'simpanan_sukarela',
        'total_pinjaman',
        'unread_notifications',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'simpanan_pokok' => 'decimal:2',
        'simpanan_wajib' => 'decimal:2',
        'simpanan_sukarela' => 'decimal:2',
        'total_pinjaman' => 'decimal:2',
        'unread_notifications' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the cooperative member.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the loans for the cooperative member.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'member_id');
    }

    /**
     * Get the transactions for the cooperative member.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'member_id');
    }

    /**
     * Get the total savings amount.
     *
     * @return float
     */
    public function getTotalSimpananAttribute(): float
    {
        return $this->simpanan_pokok + $this->simpanan_wajib + $this->simpanan_sukarela;
    }

    /**
     * Get recent transactions.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection<int, \Illuminate\Database\Eloquent\Model>
     */
    public function getRecentTransactions(int $limit = 5)
    {
        return $this->transactions()
            ->orderBy('transaction_date', 'desc')
            ->limit($limit)
            ->get();
    }


}