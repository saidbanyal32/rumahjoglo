@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')
@section('page_title', 'Galeri & Aset Visual Venue')
@section('page_subtitle', 'Unggah dokumentasi foto venue berkualitas tinggi untuk memikat calon penyewa')

@section('content')
<div class="space-y-8" x-data="{
    uploadModal: false,
    previewModal: false,
    activeImage: null,
    previewImage(item) {
        this.activeImage = item;
        this.previewModal = true;
    }
}">

    <!-- 1. HEADER BAR: KATEGORI FILTER & TOMBOL UPLOAD -->
    <div class="bg-white p-4 sm:p-6 rounded-3xl border border-stone-200/80 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <!-- Category Pill Filters -->
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.gallery.index', ['category' => 'all']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $category === 'all' ? 'bg-stone-900 text-white shadow-sm' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                Semua Foto ({{ \App\Models\Gallery::count() }})
            </a>
            @foreach($categories as $catKey => $catLabel)
            <a href="{{ route('admin.gallery.index', ['category' => $catKey]) }}" 
               class="px-4 py-2 rounded-xl text-xs font-bold transition {{ $category === $catKey ? 'bg-amber-600 text-white shadow-sm' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                {{ $catLabel }} ({{ \App\Models\Gallery::where('category', $catKey)->count() }})
            </a>
            @endforeach
        </div>

        <!-- Tombol Buka Modal Upload -->
        <button type="button" 
                @click="uploadModal = true" 
                class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400 text-stone-950 font-bold text-xs tracking-wide shadow-md transition flex items-center gap-2 flex-shrink-0">
            <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
            <span>Upload Foto Baru</span>
        </button>
    </div>

    <!-- 2. GRID FOTO GALERI -->
    @if($galleries->isEmpty())
    <div class="bg-white rounded-3xl border border-stone-200/80 p-16 text-center shadow-sm">
        <div class="w-16 h-16 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto mb-3 text-2xl">
            <i class="fa-regular fa-image"></i>
        </div>
        <h4 class="font-serif font-bold text-stone-800 text-base">Belum Ada Foto Galeri</h4>
        <p class="text-xs text-stone-600 mt-1 max-w-sm mx-auto">
            Klik tombol "Upload Foto Baru" untuk menambahkan dokumentasi foto arsitektur joglo, taman, kamar, atau dekorasi acara.
        </p>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($galleries as $item)
        <div class="bg-white rounded-3xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md transition group flex flex-col justify-between">
            <!-- Image & Overlay Actions -->
            <div class="relative aspect-video overflow-hidden bg-stone-100">
                <img src="{{ $item->image_url }}" 
                     alt="{{ $item->title }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                
                <!-- Category Badge -->
                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full bg-stone-900/80 backdrop-blur-sm text-white text-[10px] font-semibold border border-white/20">
                    {{ $item->category }}
                </span>

                <!-- Quick Action Buttons on Hover -->
                <div class="absolute inset-0 bg-stone-950/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3">
                    <button type="button" 
                            @click="previewImage({{ json_encode(['title' => $item->title, 'category' => $item->category, 'url' => $item->image_url, 'caption' => $item->caption]) }})" 
                            class="w-10 h-10 rounded-full bg-white/90 hover:bg-white text-stone-900 flex items-center justify-center shadow-lg transition">
                        <i class="fa-solid fa-magnifying-glass-plus text-sm"></i>
                    </button>
                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Hapus foto ini dari galeri?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-10 h-10 rounded-full bg-rose-600/90 hover:bg-rose-600 text-white flex items-center justify-center shadow-lg transition">
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Detail Info -->
            <div class="p-4 flex-1 flex flex-col justify-between">
                <div>
                    <h4 class="font-serif font-bold text-stone-900 text-sm line-clamp-1" title="{{ $item->title }}">
                        {{ $item->title }}
                    </h4>
                    <p class="text-[11px] text-stone-600 mt-1 line-clamp-2">
                        {{ $item->caption ?: 'Tidak ada keterangan tambahan.' }}
                    </p>
                </div>
                
                <div class="pt-3 mt-3 border-t border-stone-100 flex items-center justify-between text-[10px] text-stone-600">
                    <span>Urutan: #{{ $item->sort_order }}</span>
                    <span>{{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : '-' }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-white rounded-2xl border border-stone-200/80">
        {{ $galleries->links() }}
    </div>
    @endif

    <!-- 3. MODAL UPLOAD FOTO BARU -->
    <div x-show="uploadModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="uploadModal = false" 
             class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-stone-200 relative">
            
            <div class="flex items-center justify-between pb-4 border-b border-stone-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-stone-900">Upload Foto Galeri</h3>
                        <p class="text-xs text-stone-600">Format JPG, PNG, atau WebP (Maks. 5MB)</p>
                    </div>
                </div>
                <button @click="uploadModal = false" class="p-2 text-stone-400 hover:text-stone-700 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="{{ route('admin.gallery.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="py-4 space-y-4 text-xs">
                @csrf

                <!-- File Input -->
                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Pilih Berkas Foto <span class="text-rose-600">*</span>
                    </label>
                    <input type="file" 
                           name="image" 
                           required 
                           accept="image/jpeg,image/png,image/jpg,image/webp"
                           class="w-full px-3 py-2 border border-stone-300 rounded-xl text-stone-700 bg-stone-50 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-amber-100 file:text-amber-800 hover:file:bg-amber-200 cursor-pointer">
                </div>

                <!-- Judul Foto -->
                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Judul Foto <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           required 
                           placeholder="Contoh: Ornamen Tumpangsari Kayu Jati"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs">
                </div>

                <!-- Kategori & Urutan -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                            Kategori Area <span class="text-rose-600">*</span>
                        </label>
                        <select name="category" 
                                required 
                                class="w-full px-3 py-2.5 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs bg-white font-medium">
                            @foreach($categories as $cKey => $cVal)
                            <option value="{{ $cKey }}">{{ $cVal }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                            Urutan Tampil
                        </label>
                        <input type="number" 
                               name="sort_order" 
                               value="0" 
                               min="0"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs">
                    </div>
                </div>

                <!-- Deskripsi / Caption -->
                <div>
                    <label class="block font-semibold uppercase tracking-wider text-stone-600 mb-1.5">
                        Deskripsi / Keterangan Singkat
                    </label>
                    <textarea name="caption" 
                              rows="2" 
                              placeholder="Keterangan estetika sudut atau kapasitas area..."
                              class="w-full px-3.5 py-2 rounded-xl border border-stone-300 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 text-xs"></textarea>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2">
                    <button type="button" 
                            @click="uploadModal = false" 
                            class="px-4 py-2 rounded-xl border border-stone-300 text-stone-600 hover:bg-stone-100 font-semibold">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2 rounded-xl bg-amber-600 hover:bg-amber-500 text-white font-bold transition shadow-sm">
                        Simpan & Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 4. MODAL PREVIEW RESOLUSI BESAR -->
    <div x-show="previewModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div @click.away="previewModal = false" 
             class="bg-stone-900 rounded-3xl max-w-4xl w-full overflow-hidden shadow-2xl border border-stone-800 relative text-white">
            
            <div class="p-4 border-b border-stone-800 flex items-center justify-between">
                <div>
                    <h3 class="font-serif text-base font-bold text-white" x-text="activeImage ? activeImage.title : ''"></h3>
                    <p class="text-xs text-amber-400 font-medium" x-text="activeImage ? activeImage.category : ''"></p>
                </div>
                <button @click="previewModal = false" class="p-2 text-stone-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <div class="max-h-[70vh] bg-stone-950 flex items-center justify-center overflow-hidden p-2">
                <img :src="activeImage ? activeImage.url : ''" 
                     :alt="activeImage ? activeImage.title : ''" 
                     class="max-h-[68vh] w-auto max-w-full object-contain rounded-xl">
            </div>

            <div class="p-4 bg-stone-900 text-xs text-stone-300" x-show="activeImage && activeImage.caption">
                <p x-text="activeImage ? activeImage.caption : ''"></p>
            </div>
        </div>
    </div>

</div>
@endsection

