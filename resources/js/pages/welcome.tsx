import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { 
    Wallet, 
    PiggyBank, 
    CreditCard, 
    Shield, 
    Users, 
    TrendingUp,
    ArrowRight,
    CheckCircle,
    Smartphone,
    Globe
} from 'lucide-react';

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    const features = [
        {
            icon: <PiggyBank className="w-8 h-8 text-blue-600" />,
            title: "Kelola Simpanan",
            description: "Pantau simpanan pokok, wajib, dan sukarela Anda dengan mudah"
        },
        {
            icon: <CreditCard className="w-8 h-8 text-green-600" />,
            title: "Pinjaman Fleksibel",
            description: "Akses berbagai produk pinjaman untuk kebutuhan rumah tangga"
        },
        {
            icon: <TrendingUp className="w-8 h-8 text-purple-600" />,
            title: "Mutasi Real-time",
            description: "Lihat riwayat transaksi dan mutasi keuangan secara real-time"
        },
        {
            icon: <Shield className="w-8 h-8 text-orange-600" />,
            title: "Aman & Terpercaya",
            description: "Platform yang aman dengan enkripsi data tingkat tinggi"
        }
    ];

    const benefits = [
        "✅ Dashboard yang user-friendly dan mobile-responsive",
        "✅ Notifikasi real-time untuk setiap transaksi",
        "✅ Akses 24/7 ke informasi keuangan Anda",
        "✅ Katalog produk dengan sistem cicilan mudah",
        "✅ Transfer antar sesama anggota koperasi",
        "✅ Laporan keuangan yang detail dan akurat"
    ];

    return (
        <>
            <Head title="Koperasi Digital - Platform Keuangan Terpercaya" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center h-16">
                            <div className="flex items-center space-x-3">
                                <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                                    <Users className="w-6 h-6 text-white" />
                                </div>
                                <span className="text-xl font-bold text-gray-900">KoperasiKu</span>
                            </div>
                            
                            <div className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link
                                        href="/dashboard"
                                        className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-medium transition-colors flex items-center space-x-2"
                                    >
                                        <span>Dashboard</span>
                                        <ArrowRight className="w-4 h-4" />
                                    </Link>
                                ) : (
                                    <div className="flex items-center space-x-3">
                                        <Link
                                            href="/login"
                                            className="text-gray-700 hover:text-gray-900 font-medium"
                                        >
                                            Masuk
                                        </Link>
                                        <Link
                                            href="/register"
                                            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-medium transition-colors"
                                        >
                                            Daftar Sekarang
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="relative overflow-hidden pt-16 pb-32">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center">
                            <div className="flex justify-center mb-6">
                                <div className="flex items-center space-x-2 bg-blue-100 px-4 py-2 rounded-full">
                                    <span className="text-2xl">🏆</span>
                                    <span className="text-blue-800 font-medium">Platform Koperasi Terdepan</span>
                                </div>
                            </div>
                            
                            <h1 className="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                                Kelola Keuangan <br />
                                <span className="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Koperasi Digital
                                </span>
                            </h1>
                            
                            <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                                Platform digital terpercaya untuk mengelola simpanan, pinjaman, dan transaksi koperasi Anda. 
                                Mudah diakses kapan saja, di mana saja! 📱✨
                            </p>
                            
                            <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4 mb-12">
                                {auth.user ? (
                                    <Link
                                        href="/dashboard"
                                        className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 flex items-center space-x-2 shadow-lg"
                                    >
                                        <Wallet className="w-5 h-5" />
                                        <span>Buka Dashboard</span>
                                    </Link>
                                ) : (
                                    <>
                                        <Link
                                            href="/register"
                                            className="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 flex items-center space-x-2 shadow-lg"
                                        >
                                            <Users className="w-5 h-5" />
                                            <span>Mulai Sekarang</span>
                                        </Link>
                                        <Link
                                            href="/login"
                                            className="bg-white hover:bg-gray-50 text-gray-900 px-8 py-4 rounded-xl font-semibold text-lg border-2 border-gray-200 transition-all flex items-center space-x-2"
                                        >
                                            <ArrowRight className="w-5 h-5" />
                                            <span>Login Member</span>
                                        </Link>
                                    </>
                                )}
                            </div>

                            {/* Stats */}
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-blue-600 mb-2">1000+</div>
                                    <div className="text-gray-600">Anggota Aktif</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-green-600 mb-2">99.9%</div>
                                    <div className="text-gray-600">Uptime</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-purple-600 mb-2">24/7</div>
                                    <div className="text-gray-600">Support</div>
                                </div>
                                <div className="text-center">
                                    <div className="text-3xl font-bold text-orange-600 mb-2">5⭐</div>
                                    <div className="text-gray-600">Rating</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Background decoration */}
                    <div className="absolute inset-0 -z-10">
                        <div className="absolute top-1/4 left-1/4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div className="absolute top-1/3 right-1/4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div className="absolute bottom-1/4 left-1/3 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                    </div>
                </section>

                {/* Features Section */}
                <section className="py-20 bg-white">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                Fitur Unggulan 🚀
                            </h2>
                            <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                                Semua yang Anda butuhkan untuk mengelola keuangan koperasi dalam satu platform
                            </p>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            {features.map((feature, index) => (
                                <div key={index} className="text-center p-8 rounded-2xl bg-gray-50 hover:bg-white hover:shadow-lg transition-all duration-300">
                                    <div className="flex justify-center mb-4">
                                        <div className="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm">
                                            {feature.icon}
                                        </div>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 mb-3">{feature.title}</h3>
                                    <p className="text-gray-600 leading-relaxed">{feature.description}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>

                {/* Benefits Section */}
                <section className="py-20 bg-gradient-to-r from-blue-50 to-purple-50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                            <div>
                                <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                                    Mengapa Memilih <br />
                                    <span className="text-blue-600">KoperasiKu? 💎</span>
                                </h2>
                                <p className="text-xl text-gray-600 mb-8">
                                    Platform digital yang dirancang khusus untuk kemudahan dan keamanan transaksi koperasi Anda
                                </p>
                                
                                <div className="space-y-4">
                                    {benefits.map((benefit, index) => (
                                        <div key={index} className="flex items-start space-x-3">
                                            <CheckCircle className="w-6 h-6 text-green-500 flex-shrink-0 mt-0.5" />
                                            <span className="text-gray-700 text-lg">{benefit}</span>
                                        </div>
                                    ))}
                                </div>
                            </div>
                            
                            <div className="relative">
                                <div className="bg-white rounded-3xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                                    <div className="flex items-center space-x-3 mb-6">
                                        <div className="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                            <Smartphone className="w-6 h-6 text-white" />
                                        </div>
                                        <div>
                                            <h3 className="font-semibold text-gray-900">Mobile First</h3>
                                            <p className="text-gray-500 text-sm">Responsive Design</p>
                                        </div>
                                    </div>
                                    
                                    <div className="space-y-4">
                                        <div className="bg-green-50 p-4 rounded-xl">
                                            <div className="flex justify-between items-center">
                                                <span className="text-green-800 font-medium">Total Simpanan</span>
                                                <span className="text-green-600 font-bold">Rp 12.450.000</span>
                                            </div>
                                        </div>
                                        
                                        <div className="bg-blue-50 p-4 rounded-xl">
                                            <div className="flex justify-between items-center">
                                                <span className="text-blue-800 font-medium">Pinjaman Aktif</span>
                                                <span className="text-blue-600 font-bold">Rp 10.500.000</span>
                                            </div>
                                        </div>
                                        
                                        <div className="grid grid-cols-2 gap-3">
                                            <div className="bg-purple-50 p-3 rounded-lg text-center">
                                                <Globe className="w-5 h-5 text-purple-600 mx-auto mb-1" />
                                                <span className="text-purple-800 text-sm font-medium">Web Access</span>
                                            </div>
                                            <div className="bg-orange-50 p-3 rounded-lg text-center">
                                                <Shield className="w-5 h-5 text-orange-600 mx-auto mb-1" />
                                                <span className="text-orange-800 text-sm font-medium">Secure</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {/* CTA Section */}
                <section className="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
                    <div className="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                        <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
                            Siap Bergabung? 🎉
                        </h2>
                        <p className="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                            Mulai kelola keuangan koperasi Anda dengan mudah dan aman. Gratis untuk semua anggota!
                        </p>
                        
                        {auth.user ? (
                            <Link
                                href="/dashboard"
                                className="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-colors space-x-2"
                            >
                                <Wallet className="w-5 h-5" />
                                <span>Buka Dashboard</span>
                                <ArrowRight className="w-5 h-5" />
                            </Link>
                        ) : (
                            <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <Link
                                    href="/register"
                                    className="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-colors space-x-2"
                                >
                                    <Users className="w-5 h-5" />
                                    <span>Daftar Gratis</span>
                                    <ArrowRight className="w-5 h-5" />
                                </Link>
                                <Link
                                    href="/login"
                                    className="inline-flex items-center border-2 border-white text-white px-8 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-colors space-x-2"
                                >
                                    <span>Login Member</span>
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                            <div className="col-span-1 md:col-span-2">
                                <div className="flex items-center space-x-3 mb-4">
                                    <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center">
                                        <Users className="w-6 h-6 text-white" />
                                    </div>
                                    <span className="text-xl font-bold">KoperasiKu</span>
                                </div>
                                <p className="text-gray-400 mb-4 max-w-md">
                                    Platform digital terpercaya untuk mengelola simpanan, pinjaman, dan transaksi koperasi Anda dengan mudah dan aman.
                                </p>
                            </div>
                            
                            <div>
                                <h3 className="font-semibold mb-4">Fitur</h3>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Kelola Simpanan</li>
                                    <li>Pinjaman Online</li>
                                    <li>Mutasi Real-time</li>
                                    <li>Transfer Instan</li>
                                </ul>
                            </div>
                            
                            <div>
                                <h3 className="font-semibold mb-4">Dukungan</h3>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Pusat Bantuan</li>
                                    <li>Kontak Support</li>
                                    <li>FAQ</li>
                                    <li>Keamanan</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                            <p>&copy; 2024 KoperasiKu. Semua hak dilindungi. Dibuat dengan ❤️ untuk kemajuan koperasi Indonesia.</p>
                        </div>
                    </div>
                </footer>
            </div>

            <style>{`
                @keyframes blob {
                    0% { transform: translate(0px, 0px) scale(1); }
                    33% { transform: translate(30px, -50px) scale(1.1); }
                    66% { transform: translate(-20px, 20px) scale(0.9); }
                    100% { transform: translate(0px, 0px) scale(1); }
                }
                .animate-blob {
                    animation: blob 7s infinite;
                }
                .animation-delay-2000 {
                    animation-delay: 2s;
                }
                .animation-delay-4000 {
                    animation-delay: 4s;
                }
            `}</style>
        </>
    );
}