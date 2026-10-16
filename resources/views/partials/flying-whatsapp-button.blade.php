@php
    $flyingPhoneRaw = preg_replace('/[^0-9]/', '', $profile->nomorTeleponPerusahaan ?? '6285355836787');
    if (\Illuminate\Support\Str::startsWith($flyingPhoneRaw, '0')) {
        $flyingPhoneRaw = '62' . substr($flyingPhoneRaw, 1);
    }
    if (empty($flyingPhoneRaw)) {
        $flyingPhoneRaw = '6285355836787';
    }
    $waText = "Halo PT Gretta Solutions Network, saya ingin konsultasi mengenai layanan IT dan solusi sistem.";
    $waUrl = "https://wa.me/" . $flyingPhoneRaw . "?text=" . rawurlencode($waText);
@endphp

<!-- Flying WhatsApp Consultation Button -->
<aside aria-label="Konsultasi WhatsApp" class="fixed bottom-6 right-6 z-50 flex items-center group">
    <!-- Chat preview tooltip / message badge (Desktop & Tablet) -->
    <a href="{{ $waUrl }}"
       target="_blank"
       rel="noopener noreferrer"
       class="hidden sm:flex items-center relative mr-3.5 px-4 py-2.5 bg-white text-slate-800 rounded-2xl shadow-[0_8px_24px_rgba(0,0,0,0.12)] border border-emerald-100 hover:border-emerald-300 transition-all duration-300 transform group-hover:scale-105 group-hover:shadow-[0_12px_28px_rgba(37,211,102,0.2)]">
        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse mr-2.5 shrink-0"></span>
        <div class="flex flex-col text-left">
            <span class="text-xs font-bold text-emerald-900 leading-tight">Konsultasi Gratis</span>
            <span class="text-[11px] font-medium text-slate-500 leading-tight">Chat langsung tim ahli IT kami</span>
        </div>
        <!-- Triangle pointing to the button on the right -->
        <div class="absolute -right-1.5 top-1/2 -translate-y-1/2 w-3 h-3 bg-white rotate-45 border-t border-r border-emerald-100"></div>
    </a>

    <!-- Main Flying Button -->
    <a href="{{ $waUrl }}"
       target="_blank"
       rel="noopener noreferrer"
       id="flying-whatsapp-btn"
       title="Konsultasi Cepat via WhatsApp"
       class="relative inline-flex items-center gap-2.5 px-4 py-3 sm:px-5 sm:py-3.5 rounded-full bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white font-semibold text-sm shadow-[0_10px_25px_rgba(37,211,102,0.4)] hover:shadow-[0_16px_35px_rgba(37,211,102,0.6)] hover:-translate-y-1 active:translate-y-0 transition-all duration-300 group-hover:from-[#22c35e] group-hover:to-[#0f7a6e] ring-2 ring-white/60">
        
        <!-- Subtle ping aura -->
        <span class="absolute -inset-1 rounded-full bg-[#25D366]/30 animate-ping pointer-events-none opacity-60"></span>
        
        <!-- Official WhatsApp Icon -->
        <svg class="w-6 h-6 fill-current text-white shrink-0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.456 5.711 1.457h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>

        <!-- Button Text -->
        <span class="tracking-wide">
            <span class="sm:hidden">Konsultasi</span>
            <span class="hidden sm:inline">Konsultasi WhatsApp</span>
        </span>
        
        <!-- Live Online Pill Indicator -->
        <span class="hidden md:inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-white/20 text-[11px] font-bold text-white tracking-wide backdrop-blur-xs">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-200 animate-pulse"></span>
            Online
        </span>
    </a>
</aside>
