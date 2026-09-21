@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-transition class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <div>
            <p class="text-sm font-semibold text-emerald-900">{{ session('success') }}</p>
        </div>
    </div>
    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg transition">
        <i class="fa-solid fa-xmark text-sm"></i>
    </button>
</div>
@endif

@if(session('error'))
<div x-data="{ show: true }" x-show="show" x-transition class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-sm">
    <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-triangle-exclamation text-sm"></i>
        </div>
        <div>
            <p class="text-sm font-semibold text-rose-900">{{ session('error') }}</p>
        </div>
    </div>
    <button @click="show = false" class="text-rose-600 hover:text-rose-800 p-1 rounded-lg transition">
        <i class="fa-solid fa-xmark text-sm"></i>
    </button>
</div>
@endif

@if($errors->any())
<div x-data="{ show: true }" x-show="show" x-transition class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center flex-shrink-0 mt-0.5">
                <i class="fa-solid fa-circle-exclamation text-sm"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-rose-900 mb-1">Terdapat beberapa kendala pada input data:</p>
                <ul class="list-disc list-inside text-xs space-y-1 text-rose-700">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button @click="show = false" class="text-rose-600 hover:text-rose-800 p-1 rounded-lg transition">
            <i class="fa-solid fa-xmark text-sm"></i>
        </button>
    </div>
</div>
@endif

