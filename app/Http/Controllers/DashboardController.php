<?php

namespace App\Http\Controllers;

use App\Models\CooperativeMember;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get or create cooperative member data
        $member = CooperativeMember::with(['loans', 'transactions'])
            ->firstOrCreate(
                ['user_id' => $user->id],
                [
                    'member_number' => 'KOP-' . str_pad((string)$user->id, 6, '0', STR_PAD_LEFT),
                    'simpanan_pokok' => 2500000,
                    'simpanan_wajib' => 4950000,
                    'simpanan_sukarela' => 5000000,
                    'total_pinjaman' => 10500000,
                    'unread_notifications' => 3,
                ]
            );

        // Get recent transactions directly
        $recentTransactions = Transaction::where('member_id', $member->id)
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get();
            
        $recentTransactionsFormatted = $recentTransactions->map(function (Transaction $transaction): array {
            return [
                'id' => $transaction->id,
                'title' => $transaction->title,
                'subtitle' => $transaction->subtitle,
                'amount' => (float) $transaction->amount,
                'type' => $transaction->type,
                'transaction_date' => $transaction->transaction_date->format('Y-m-d H:i'),
            ];
        })->toArray();

        // Get promo products
        $promoProducts = Product::active()
            ->whereIn('status', ['promo', 'baru'])
            ->limit(4)
            ->get();

        return Inertia::render('dashboard', [
            'member' => [
                'id' => $member->id,
                'member_number' => $member->member_number,
                'user_name' => $user->name,
                'simpanan_pokok' => $member->simpanan_pokok,
                'simpanan_wajib' => $member->simpanan_wajib,
                'simpanan_sukarela' => $member->simpanan_sukarela,
                'total_simpanan' => $member->total_simpanan,
                'total_pinjaman' => $member->total_pinjaman,
                'unread_notifications' => $member->unread_notifications,
                'loans' => $member->loans->map(function ($loan) {
                    return [
                        'id' => $loan->id,
                        'loan_type' => $loan->loan_type,
                        'product_name' => $loan->product_name,
                        'remaining_balance' => $loan->remaining_balance,
                    ];
                }),
            ],
            'recent_transactions' => $recentTransactionsFormatted,
            'promo_products' => $promoProducts->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'status' => $product->status,
                ];
            }),
        ]);
    }

    /**
     * Handle menu actions.
     */
    public function store(Request $request)
    {
        $action = $request->input('action');
        
        // Handle different menu actions
        switch ($action) {
            case 'mutasi':
                // Redirect to transactions page
                return redirect()->route('transactions.index');
            case 'produk':
                // Redirect to products page
                return redirect()->route('products.index');
            case 'bayar':
                // Redirect to payment page
                return redirect()->route('payments.index');
            case 'transfer':
                // Redirect to transfer page
                return redirect()->route('transfers.index');
            default:
                return back()->with('error', 'Invalid action');
        }
    }
}