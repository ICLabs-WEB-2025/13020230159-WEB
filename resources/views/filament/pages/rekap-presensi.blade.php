<x-filament::page>
    <div class="w-full min-h-screen flex flex-col justify-start items-stretch">
        <div class="flex-1 flex flex-col justify-start items-stretch p-2 md:p-8">
            <div class="bg-yellow-300 rounded-xl shadow-lg flex-1 flex flex-col overflow-auto">
                {{-- Flex row: judul di kiri, dua tombol di kanan (sejajar) --}}
                <div class="flex items-center justify-between px-4 pt-6 mb-4">
                    <h5 class="text-2xl font-bold text-gray-900">
                        Rekap Kehadiran Bulan {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}
                    </h5>
                    <div class="flex items-center gap-x-2">
                        <x-filament::button 
                            tag="a" 
                            href="{{ route('dashboard.export-excel') }}" 
                            color="success" 
                            class="font-semibold text-base px-6 py-2.5 rounded-xl shadow-lg"
                        >
                            Export Excel
                        </x-filament::button>
                        {{--<x-filament::button
                            color="warning"
                            icon="heroicon-o-qr-code"
                            class="p-0 w-12 h-12 rounded-full shadow-lg flex items-center justify-center"
                            x-data
                            @click="$dispatch('open-modal', { id: 'modal-qr-presensi' })"
                            title="Tampilkan QR Presensi">
                        </x-filament::button> --}}
                    </div>
                </div>

                 {{-- MODAL QR --}}
                {{--<x-filament::modal id="modal-qr-presensi" width="md" :slide-over="false">
                    <x-slot name="header">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-qr-code text-xl text-yellow-500"></i>
                            <span class="text-lg font-bold">QR Code Presensi Aktif</span>
                        </div>
                    </x-slot>

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
                </x-filament::modal> --}}

                <div class="flex-1 overflow-auto">
                    <table class="min-w-full w-full table-auto text-base text-gray-900">
                        <thead class="bg-yellow-200">
                            <tr class="border-b border-yellow-400">
                                <th class="px-4 py-3 text-left font-semibold">Nama Asisten</th>
                                <th class="px-4 py-3 text-center font-semibold">Hadir</th>
                                <th class="px-4 py-3 text-center font-semibold">Absen</th>
                                <th class="px-4 py-3 text-center font-semibold">Persentase Hadir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekap as $row)
                                <tr class="border-b border-yellow-200 hover:bg-yellow-200/50">
                                    <td class="px-4 py-3">{{ $row['nama'] }}</td>
                                    <td class="px-4 py-3 text-center">{{ $row['hadir'] }}</td>
                                    <td class="px-4 py-3 text-center">{{ $row['absen'] }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold {{ (float) $row['persentase'] >= 75 ? 'text-green-700' : 'text-red-700' }}">
                                            {{ $row['persentase'] }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-gray-600 py-6">Tidak ada data presensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
