@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')
@section('page_title', 'Konfigurasi Website & Identitas Properti')
@section('page_subtitle', 'Sesuaikan nama properti, nomor WhatsApp resmi, rekening bank tujuan, persentase DP, dan hero banner beranda')

@section('content')
<div class="max-w-5xl space-y-8" x-data="{ activeTab: 'profile' }">

    <!-- TAB NAVIGATION BAR -->
    <div class="bg-white p-2 rounded-2xl border border-stone-200/80 shadow-sm flex flex-wrap gap-2">
        <button type="button" 
                @click="activeTab = 'profile'" 
                :class="activeTab === 'profile' ? 'bg-amber-600 text-white shadow-sm' : 'text-stone-600 hover:bg-stone-100'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-hotel"></i>
            <span>Profil Properti & Kontak</span>
        </button>

        <button type="button" 
                @click="activeTab = 'payment'" 
                :class="activeTab === 'payment' ? 'bg-amber-600 text-white shadow-sm' : 'text-stone-600 hover:bg-stone-100'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-credit-card"></i>
            <span>Rekening Bank & DP</span>
        </button>

        <button type="button" 
                @click="activeTab = 'social'" 
                :class="activeTab === 'social' ? 'bg-amber-600 text-white shadow-sm' : 'text-stone-600 hover:bg-stone-100'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-share-nodes"></i>
            <span>Media Sosial</span>
        </button>

        <button type="button" 
                @click="activeTab = 'hero'" 
                :class="activeTab === 'hero' ? 'bg-amber-600 text-white shadow-sm' : 'text-stone-600 hover:bg-stone-100'"
                class="px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center gap-2">
            <i class="fa-solid fa-panorama"></i>
            <span>Hero Banner & Beranda</span>
        </button>
    </div>

    <!-- MAIN FORM CONTAINER -->
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1. TAB: PROFIL PROPERTI & KONTAK -->
        <div x-show="activeTab === 'profile'" x-cloak class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="border-b border-stone-100 pb-4">
                <h3 class="font-serif text-lg font-bold text-stone-900">Identitas & Kontak Utama</h3>
                <p class="text-xs text-stone-600">Informasi ini ditampilkan pada navbar, footer, dan tombol WhatsApp resmi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                <!-- Nama Properti -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        Nama Properti / Venue <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" 
                           name="site_name" 
                           value="{{ old('site_name', $settings['site_name'] ?? 'Rumah Joglo Omah Ayem') }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- Tagline -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        Tagline / Slogan
                    </label>
                    <input type="text" 
                           name="tagline" 
                           value="{{ old('tagline', $settings['tagline'] ?? '') }}" 
                           placeholder="Contoh: Keanggunan Tradisi Jawa untuk Momen Istimewa Anda"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- Nomor WhatsApp Admin -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        No. WhatsApp Admin (Aktif) <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" 
                           name="contact_whatsapp" 
                           value="{{ old('contact_whatsapp', $settings['contact_whatsapp'] ?? '6281234567890') }}" 
                           required 
                           placeholder="Contoh: 6281234567890"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-mono">
                    <p class="text-[11px] text-stone-600 mt-1">Gunakan format internasional (misal 6281234567890) agar tombol WhatsApp langsung berfungsi.</p>
                </div>

                <!-- Email Pengelola -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        Alamat Email Pengelola
                    </label>
                    <input type="email" 
                           name="contact_email" 
                           value="{{ old('contact_email', $settings['contact_email'] ?? 'info@omahayem.com') }}" 
                           placeholder="info@omahayem.com"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>
            </div>

            <!-- Alamat Lengkap -->
            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Alamat Lengkap Lokasi Venue
                </label>
                <textarea name="address" 
                          rows="3" 
                          placeholder="Alamat jalan, kelurahan, kecamatan, kabupaten, dan kode pos..."
                          class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">{{ old('address', $settings['address'] ?? '') }}</textarea>
            </div>

            <!-- Google Maps Embed Link -->
            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Link Embed Google Maps (Iframe / URL)
                </label>
                <input type="text" 
                       name="maps_embed" 
                       value="{{ old('maps_embed', $settings['maps_embed'] ?? '') }}" 
                       placeholder="https://www.google.com/maps/embed?pb=..."
                       class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-mono">
                <p class="text-[11px] text-stone-600 mt-1">URL embed peta untuk ditampilkan di halaman kontak web.</p>
            </div>
        </div>

        <!-- 2. TAB: REKENING BANK & DP -->
        <div x-show="activeTab === 'payment'" x-cloak class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="border-b border-stone-100 pb-4">
                <h3 class="font-serif text-lg font-bold text-stone-900">Rekening Tujuan Transfer & Skema Uang Muka (DP)</h3>
                <p class="text-xs text-stone-600">Nomor rekening ini ditampilkan pada halaman invoice instruksi pembayaran bagi calon penyewa.</p>
            </div>

            <!-- Persentase DP -->
            <div class="text-xs max-w-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Persentase Uang Muka (DP %) <span class="text-rose-600">*</span>
                </label>
                <div class="relative">
                    <input type="number" 
                           name="dp_percentage" 
                           min="10" 
                           max="100"
                           value="{{ old('dp_percentage', $settings['dp_percentage'] ?? '30') }}" 
                           required 
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 font-bold">
                    <span class="absolute right-4 top-3 text-stone-500 font-bold">%</span>
                </div>
                <p class="text-[11px] text-stone-600 mt-1">Default 30% atau 50% dari total nilai paket.</p>
            </div>

            <!-- Rekening 1: BCA -->
            <div class="p-5 rounded-2xl bg-stone-50 border border-stone-200 space-y-4 text-xs">
                <span class="font-bold text-brand-dark uppercase tracking-wider text-[11px] block">Rekening Bank Utama (1)</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Nama Bank</label>
                        <input type="text" 
                               name="bank_name_1" 
                               value="{{ old('bank_name_1', $settings['bank_name_1'] ?? 'BCA') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-bold">
                    </div>
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Nomor Rekening</label>
                        <input type="text" 
                               name="bank_account_number_1" 
                               value="{{ old('bank_account_number_1', $settings['bank_account_number_1'] ?? '8465-123-456') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-mono font-bold">
                    </div>
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Atas Nama (Rekening)</label>
                        <input type="text" 
                               name="bank_account_holder_1" 
                               value="{{ old('bank_account_holder_1', $settings['bank_account_holder_1'] ?? 'Rumah Joglo Omah Ayem') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-medium">
                    </div>
                </div>
            </div>

            <!-- Rekening 2: Mandiri / Lainnya -->
            <div class="p-5 rounded-2xl bg-stone-50 border border-stone-200 space-y-4 text-xs">
                <span class="font-bold text-brand-dark uppercase tracking-wider text-[11px] block">Rekening Bank Alternatif (2)</span>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Nama Bank</label>
                        <input type="text" 
                               name="bank_name_2" 
                               value="{{ old('bank_name_2', $settings['bank_name_2'] ?? 'Bank Mandiri') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-bold">
                    </div>
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Nomor Rekening</label>
                        <input type="text" 
                               name="bank_account_number_2" 
                               value="{{ old('bank_account_number_2', $settings['bank_account_number_2'] ?? '137-00-1234567-8') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-mono font-bold">
                    </div>
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Atas Nama (Rekening)</label>
                        <input type="text" 
                               name="bank_account_holder_2" 
                               value="{{ old('bank_account_holder_2', $settings['bank_account_holder_2'] ?? 'Rumah Joglo Omah Ayem') }}" 
                               class="w-full px-3 py-2 rounded-xl border border-stone-300 font-medium">
                    </div>
                </div>
            </div>

            <!-- Petunjuk Transfer -->
            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Teks Petunjuk Pembayaran / Instruksi
                </label>
                <textarea name="payment_instructions" 
                          rows="3" 
                          class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">{{ old('payment_instructions', $settings['payment_instructions'] ?? 'Silakan lakukan transfer Uang Muka (DP) ke rekening resmi kami di atas dan sertakan Kode Booking pada berita transfer. Jadwal acara resmi terkunci setelah pembayaran DP diverifikasi.') }}</textarea>
            </div>

            <!-- WhatsApp API Gateway Config (Opsional) -->
            <div class="pt-4 border-t border-stone-200">
                <span class="font-bold text-stone-900 block text-sm mb-1">Integrasi WhatsApp Gateway (Opsional)</span>
                <p class="text-xs text-stone-500 mb-4">Jika Anda menggunakan provider API seperti Fonnte atau Wablas, masukkan token di sini untuk pengiriman pesan otomatis.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">Provider WhatsApp Gateway</label>
                        <select name="whatsapp_provider" class="w-full px-3 py-2.5 rounded-xl border border-stone-300 bg-white">
                            <option value="fonnte" {{ ($settings['whatsapp_provider'] ?? 'fonnte') === 'fonnte' ? 'selected' : '' }}>Fonnte (api.fonnte.com)</option>
                            <option value="wablas" {{ ($settings['whatsapp_provider'] ?? '') === 'wablas' ? 'selected' : '' }}>Wablas (wablas.com)</option>
                            <option value="custom" {{ ($settings['whatsapp_provider'] ?? '') === 'custom' ? 'selected' : '' }}>Generic / Custom Webhook</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-stone-600 mb-1">API Token / Secret Key</label>
                        <input type="password" 
                               name="whatsapp_api_token" 
                               value="{{ old('whatsapp_api_token', $settings['whatsapp_api_token'] ?? '') }}" 
                               placeholder="Masukkan token API jika ada" 
                               class="w-full px-3 py-2.5 rounded-xl border border-stone-300 font-mono">
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. TAB: MEDIA SOSIAL -->
        <div x-show="activeTab === 'social'" x-cloak class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="border-b border-stone-100 pb-4">
                <h3 class="font-serif text-lg font-bold text-stone-900">Tautan Media Sosial Resmi</h3>
                <p class="text-xs text-stone-600">Tautan ini muncul pada footer dan floating action buttons website.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                <!-- Instagram -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        <i class="fa-brands fa-instagram text-rose-600 text-sm mr-1"></i> Instagram URL
                    </label>
                    <input type="url" 
                           name="social_instagram" 
                           value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" 
                           placeholder="https://instagram.com/omahayem.joglo"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- TikTok -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        <i class="fa-brands fa-tiktok text-stone-900 text-sm mr-1"></i> TikTok URL
                    </label>
                    <input type="url" 
                           name="social_tiktok" 
                           value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}" 
                           placeholder="https://tiktok.com/@omahayem.joglo"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- Facebook -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        <i class="fa-brands fa-facebook text-blue-600 text-sm mr-1"></i> Facebook Fanpage URL
                    </label>
                    <input type="url" 
                           name="social_facebook" 
                           value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}" 
                           placeholder="https://facebook.com/omahayem.joglo"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- YouTube -->
                <div>
                    <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                        <i class="fa-brands fa-youtube text-red-600 text-sm mr-1"></i> YouTube Channel URL
                    </label>
                    <input type="url" 
                           name="social_youtube" 
                           value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}" 
                           placeholder="https://youtube.com/@omahayem"
                           class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                </div>
            </div>
        </div>

        <!-- 4. TAB: HERO BANNER & BERANDA -->
        <div x-show="activeTab === 'hero'" x-cloak class="bg-white rounded-3xl border border-stone-200/80 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="border-b border-stone-100 pb-4">
                <h3 class="font-serif text-lg font-bold text-stone-900">Hero Banner & Teks Utama Beranda</h3>
                <p class="text-xs text-stone-600">Sesuaikan foto latar belakang dan pesan sambutan pertama yang dilihat pengunjung.</p>
            </div>

            <!-- Preview Banner Saat Ini -->
            @if(isset($settings['hero_image']) && $settings['hero_image'])
            <div class="text-xs">
                <span class="block font-bold uppercase tracking-wider text-stone-700 mb-2">Foto Hero Banner Saat Ini</span>
                <div class="relative aspect-[21/9] rounded-2xl overflow-hidden border border-stone-200 max-h-56 bg-stone-900">
                    <img src="{{ $settings['hero_image'] }}" alt="Hero Banner" class="w-full h-full object-cover">
                </div>
            </div>
            @endif

            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Unggah Banner Baru (Resolusi Tinggi, Maks 5MB)
                </label>
                <input type="file" 
                       name="hero_image_file" 
                       accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-3 py-2 border border-stone-300 rounded-xl text-stone-700 bg-stone-50 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                <p class="text-[11px] text-stone-600 mt-1">Disarankan foto landscape beresolusi minimal 1920x1080px bernuansa syahdu.</p>
            </div>

            <!-- Headline Utama -->
            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Teks Headline Beranda (H1)
                </label>
                <textarea name="hero_headline" 
                          rows="2" 
                          placeholder="Pesona Otentik Joglo Kayu Jati Kuno untuk Momen Sakral dan Bersejarah"
                          class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">{{ old('hero_headline', $settings['hero_headline'] ?? '') }}</textarea>
            </div>

            <!-- Subheadline Deskripsi -->
            <div class="text-xs">
                <label class="block font-bold uppercase tracking-wider text-stone-700 mb-2">
                    Teks Sub-Headline / Deskripsi Singkat
                </label>
                <textarea name="hero_subheadline" 
                          rows="3" 
                          placeholder="Tempat sewa eksklusif bernuansa klasik Jawa di Condongcatur, Yogyakarta..."
                          class="w-full px-4 py-3 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500">{{ old('hero_subheadline', $settings['hero_subheadline'] ?? '') }}</textarea>
            </div>
        </div>

        <!-- SUBMIT BAR (STICKY BOTTOM) -->
        <div class="mt-8 pt-4 flex items-center justify-end gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 rounded-xl border border-stone-300 text-stone-600 hover:bg-stone-100 font-semibold text-xs transition">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-stone-950 font-bold text-xs tracking-wide shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Semua Pengaturan</span>
            </button>
        </div>
    </form>

</div>
@endsection
