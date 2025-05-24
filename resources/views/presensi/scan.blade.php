<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Presensi QR Scan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(120deg, #f6f7fb 0%, #e9eefa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .filament-card {
            border-radius: 1.4rem;
            background: #fff;
            box-shadow: 0 2px 20px rgba(16,40,81,.12), 0 1px 3px rgba(16,40,81,.10);
            padding: 2.1rem 2rem 2rem 2rem;
            max-width: 370px;
            width: 100%;
            color: #23272f;
        }
        .filament-title {
            font-size: 1.3rem;
            color: #eab308; /* kuning */
            font-weight: 700;
            margin-bottom: .3rem;
            letter-spacing: -.01em;
        }
        .filament-session {
            color: #64748b;
            font-size: 1.09rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        .filament-date {
            color: #eab308;
            font-size: .99rem;
            margin-bottom: 1.1rem;
        }
        .filament-btn {
            background: linear-gradient(90deg, #fde047 0%, #fde68a 100%);
            color: #23272f;
            font-weight: 700;
            border: none;
            border-radius: 999px;
            padding: 0.68rem 0;
            font-size: 1.09rem;
            letter-spacing: .02em;
            box-shadow: 0 2px 12px 0 rgba(254, 220, 55, 0.12);
            transition: all .14s;
        }
        .filament-btn:active, .filament-btn:focus, .filament-btn:hover {
            background: linear-gradient(90deg, #fde68a 0%, #fde047 100%);
            color: #18181b;
        }
        .filament-info {
            font-size: 1.01rem;
            background: #fffbe6;
            color: #a16207;
            border-radius: .7rem;
            padding: .8rem 1rem .4rem 1rem;
            margin-top: 1.2rem;
            text-align: center;
            border: 1.5px dashed #fde047;
        }
        .filament-icon {
            color: #fde047;
            font-size: 2.3rem;
            margin-bottom: 0.65rem;
        }
        .filament-border {
            border-top: 2.5px dashed #fde047;
            margin: 1.2rem 0 1.3rem 0;
        }
        @media (max-width: 600px) {
            .filament-card { padding: 1.1rem 0.3rem 1.2rem 0.3rem; }
        }

        /* ====== DARK MODE ====== */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(120deg, #18181b 0%, #23272f 100%);
            }
            .filament-card {
                background: #23272f;
                color: #fff;
                box-shadow: 0 2px 20px rgba(16,40,81,.16), 0 1px 3px rgba(16,40,81,.20);
            }
            .filament-title { color: #fde047; }
            .filament-session { color: #fefce8; }
            .filament-date { color: #fde68a; }
            .filament-btn {
                background: linear-gradient(90deg, #fde047 0%, #fde68a 100%);
                color: #23272f;
            }
            .filament-btn:active, .filament-btn:focus, .filament-btn:hover {
                background: linear-gradient(90deg, #fde68a 0%, #fde047 100%);
                color: #18181b;
            }
            .filament-info {
                background: #18181b;
                color: #fde047;
                border: 1.5px dashed #fde047;
            }
            .filament-border {
                border-top: 2.5px dashed #fde047;
            }
        }
    </style>
</head>
<body>
    <main class="d-flex align-items-center justify-content-center flex-column" style="min-height:100vh;">
        <div class="filament-card">
            <div class="text-center">
                <i class="bi bi-qr-code filament-icon"></i>
                <div class="filament-title">Presensi Sesi</div>
                <div class="filament-session">{{ $session->name }}</div>
                <div class="filament-date">
                    {{ $session->start_time->format('d M Y H:i') }} - {{ $session->end_time->format('H:i') }}
                </div>
                <div class="filament-border"></div>
            </div>
            <form method="POST" action="{{ route('presensi.submit') }}">
                @csrf
                <input type="hidden" name="attendance_session_id" value="{{ $session->id }}">
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
                <button type="submit" class="filament-btn w-100 mb-2 mt-2 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> Absen Sekarang
                </button>
            </form>
            <div class="filament-info mt-3">
                Lokasi akan terdeteksi otomatis jika diizinkan browser.<br>
                <span class="d-block mt-1" style="font-size:.93em;">Jangan tutup halaman sebelum absen berhasil.</span>
            </div>
        </div>
    </main>
    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            });
        }
    </script>
</body>
</html>
