import React, { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { 
    Bell, 
    Eye, 
    EyeOff, 
    ArrowUpDown, 
    ShoppingBag, 
    CreditCard, 
    Send,
    Home,
    User,
    TrendingUp,
    Package
} from 'lucide-react';

interface Loan {
    id: number;
    loan_type: string;
    product_name: string;
    remaining_balance: number;
}

interface Transaction {
    id: number;
    title: string;
    subtitle: string | null;
    amount: number;
    type: 'income' | 'expense';
    transaction_date: string;
}

interface Product {
    id: number;
    name: string;
    price: number;
    status: 'promo' | 'baru' | 'reguler';
}

interface Member {
    id: number;
    member_number: string;
    user_name: string;
    simpanan_pokok: number;
    simpanan_wajib: number;
    simpanan_sukarela: number;
    total_simpanan: number;
    total_pinjaman: number;
    unread_notifications: number;
    loans: Loan[];
}

interface Props {
    member: Member;
    recent_transactions: Transaction[];
    promo_products: Product[];
    [key: string]: unknown;
}

export default function Dashboard({ member, recent_transactions, promo_products }: Props) {
    const [showSavings, setShowSavings] = useState(false);
    const [showLoans, setShowLoans] = useState(false);

    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const handleMenuAction = (action: string) => {
        router.post(route('dashboard.store'), { action }, {
            preserveState: true,
            preserveScroll: true,
            onError: () => {
                // For demo purposes, just show alert
                alert(`Fitur ${action} akan segera hadir!`);
            }
        });
    };

    const getStatusBadge = (status: string) => {
        const badges = {
            promo: 'bg-red-100 text-red-800 border-red-200',
            baru: 'bg-green-100 text-green-800 border-green-200',
            reguler: 'bg-gray-100 text-gray-800 border-gray-200'
        };
        
        const labels = {
            promo: 'Promo',
            baru: 'Baru',
            reguler: 'Reguler'
        };

        return (
            <span className={`px-2 py-1 text-xs font-medium rounded-full border ${badges[status as keyof typeof badges]}`}>
                {labels[status as keyof typeof labels]}
            </span>
        );
    };

    return (
        <>
            <Head title="Dashboard Koperasi" />
            
            <div className="min-h-screen bg-gray-50 pb-20">
                {/* Header */}
                <div className="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-6 text-white">
                    <div className="flex items-center justify-between mb-4">
                        <div>
                            <h1 className="text-lg font-semibold">Halo, Anggota 👋</h1>
                            <p className="text-blue-100 text-sm">No. Anggota: {member.member_number}</p>
                        </div>
                        <div className="relative">
                            <Bell className="w-6 h-6" />
                            {member.unread_notifications > 0 && (
                                <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {member.unread_notifications}
                                </span>
                            )}
                        </div>
                    </div>
                </div>

                <div className="px-4 -mt-2">
                    {/* Savings Card */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 p-5">
                        <div className="flex items-center justify-between mb-3">
                            <h2 className="font-semibold text-gray-900">💰 Total Simpanan</h2>
                            <button 
                                onClick={() => setShowSavings(!showSavings)}
                                className="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                            >
                                {showSavings ? <EyeOff className="w-5 h-5 text-gray-500" /> : <Eye className="w-5 h-5 text-gray-500" />}
                            </button>
                        </div>
                        
                        <div className="mb-4">
                            <p className="text-2xl font-bold text-green-600 mb-1">
                                {showSavings ? formatCurrency(member.total_simpanan) : 'Rp ••••••••'}
                            </p>
                        </div>

                        <div className="space-y-2">
                            <div className="flex justify-between items-center">
                                <span className="text-sm text-gray-600">Simpanan Pokok</span>
                                <span className="text-sm font-medium">
                                    {showSavings ? formatCurrency(member.simpanan_pokok) : 'Rp ••••••••'}
                                </span>
                            </div>
                            <div className="flex justify-between items-center">
                                <span className="text-sm text-gray-600">Simpanan Wajib</span>
                                <span className="text-sm font-medium">
                                    {showSavings ? formatCurrency(member.simpanan_wajib) : 'Rp ••••••••'}
                                </span>
                            </div>
                            <div className="flex justify-between items-center">
                                <span className="text-sm text-gray-600">Simpanan Sukarela</span>
                                <span className="text-sm font-medium">
                                    {showSavings ? formatCurrency(member.simpanan_sukarela) : 'Rp ••••••••'}
                                </span>
                            </div>
                        </div>
                    </div>

                    {/* Loans Card */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 p-5">
                        <div className="flex items-center justify-between mb-3">
                            <h2 className="font-semibold text-gray-900">🏦 Total Pinjaman</h2>
                            <button 
                                onClick={() => setShowLoans(!showLoans)}
                                className="p-2 hover:bg-gray-100 rounded-lg transition-colors"
                            >
                                {showLoans ? <EyeOff className="w-5 h-5 text-gray-500" /> : <Eye className="w-5 h-5 text-gray-500" />}
                            </button>
                        </div>
                        
                        <div className="mb-4">
                            <p className="text-2xl font-bold text-orange-600 mb-1">
                                {showLoans ? formatCurrency(member.total_pinjaman) : 'Rp ••••••••'}
                            </p>
                        </div>

                        <div className="space-y-2">
                            {member.loans.map((loan) => (
                                <div key={loan.id} className="flex justify-between items-center">
                                    <span className="text-sm text-gray-600">Pinjaman {loan.loan_type}</span>
                                    <span className="text-sm font-medium">
                                        {showLoans ? formatCurrency(loan.remaining_balance) : 'Rp ••••••••'}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Menu Buttons */}
                    <div className="grid grid-cols-4 gap-3 mb-6">
                        <button 
                            onClick={() => handleMenuAction('mutasi')}
                            className="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center space-y-2 hover:shadow-md transition-shadow"
                        >
                            <div className="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <ArrowUpDown className="w-6 h-6 text-green-600" />
                            </div>
                            <span className="text-xs font-medium text-gray-700">Mutasi</span>
                        </button>

                        <button 
                            onClick={() => handleMenuAction('produk')}
                            className="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center space-y-2 hover:shadow-md transition-shadow"
                        >
                            <div className="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                                <ShoppingBag className="w-6 h-6 text-yellow-600" />
                            </div>
                            <span className="text-xs font-medium text-gray-700">Produk</span>
                        </button>

                        <button 
                            onClick={() => handleMenuAction('bayar')}
                            className="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center space-y-2 hover:shadow-md transition-shadow"
                        >
                            <div className="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                                <CreditCard className="w-6 h-6 text-red-600" />
                            </div>
                            <span className="text-xs font-medium text-gray-700">Bayar</span>
                        </button>

                        <button 
                            onClick={() => handleMenuAction('transfer')}
                            className="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center space-y-2 hover:shadow-md transition-shadow"
                        >
                            <div className="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <Send className="w-6 h-6 text-blue-600" />
                            </div>
                            <span className="text-xs font-medium text-gray-700">Transfer</span>
                        </button>
                    </div>

                    {/* Recent Transactions */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100 mb-4">
                        <div className="p-5 border-b border-gray-100">
                            <h2 className="font-semibold text-gray-900">📋 Mutasi Terakhir</h2>
                        </div>
                        <div className="divide-y divide-gray-100">
                            {recent_transactions.map((transaction) => (
                                <div key={transaction.id} className="p-4 flex justify-between items-center">
                                    <div className="flex-1">
                                        <p className="font-medium text-gray-900 text-sm">{transaction.title}</p>
                                        {transaction.subtitle && (
                                            <p className="text-xs text-gray-500 mt-1">{transaction.subtitle}</p>
                                        )}
                                    </div>
                                    <div className="text-right">
                                        <p className={`font-semibold text-sm ${
                                            transaction.type === 'income' 
                                                ? 'text-green-600' 
                                                : 'text-red-600'
                                        }`}>
                                            {transaction.type === 'income' ? '+' : '-'}{formatCurrency(transaction.amount)}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Promo Products */}
                    <div className="bg-white rounded-xl shadow-sm border border-gray-100 mb-4">
                        <div className="p-5 border-b border-gray-100">
                            <h2 className="font-semibold text-gray-900">🛒 Promo Produk</h2>
                        </div>
                        <div className="p-4 space-y-4">
                            {promo_products.map((product) => (
                                <div key={product.id} className="flex justify-between items-center">
                                    <div className="flex-1">
                                        <div className="flex items-center space-x-2 mb-1">
                                            <p className="font-medium text-gray-900 text-sm">{product.name}</p>
                                            {getStatusBadge(product.status)}
                                        </div>
                                        <p className="text-lg font-bold text-blue-600">{formatCurrency(product.price)}</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Bottom Navigation */}
                <div className="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
                    <div className="flex justify-around">
                        <button className="flex flex-col items-center py-2 px-3">
                            <Home className="w-6 h-6 text-blue-600" />
                            <span className="text-xs text-blue-600 font-medium mt-1">Home</span>
                        </button>
                        <button 
                            onClick={() => handleMenuAction('mutasi')}
                            className="flex flex-col items-center py-2 px-3"
                        >
                            <TrendingUp className="w-6 h-6 text-gray-400" />
                            <span className="text-xs text-gray-400 mt-1">Mutasi</span>
                        </button>
                        <button 
                            onClick={() => handleMenuAction('produk')}
                            className="flex flex-col items-center py-2 px-3"
                        >
                            <Package className="w-6 h-6 text-gray-400" />
                            <span className="text-xs text-gray-400 mt-1">Produk</span>
                        </button>
                        <button className="flex flex-col items-center py-2 px-3">
                            <User className="w-6 h-6 text-gray-400" />
                            <span className="text-xs text-gray-400 mt-1">Profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </>
    );
}