<div class="flex flex-col items-center justify-center">
    @if($sessionAktif)
        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(url('/presensi/scan/'.$sessionAktif->token)) !!}
        <div class="text-center mt-2">
            <b>Sesi:</b> {{ $sessionAktif->name }}<br>
            <span class="text-xs text-gray-500 dark:text-gray-300">
                {{ $sessionAktif->start_time->format('d M Y H:i') }} - {{ $sessionAktif->end_time->format('H:i') }}
            </span>
        </div>
    @else
        <div class="text-center text-red-500 mb-2">
            Tidak ada sesi presensi aktif.
        </div>
    @endif
</div>
