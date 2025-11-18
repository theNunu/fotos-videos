<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Archivos Subidos</title>

    <style>
        body {
            background: #111;
            color: white;
            font-family: Arial;
            padding: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .card {
            border: 1px solid #444;
            padding: 15px;
            border-radius: 10px;
            background: #1a1a1a;
            text-align: center;
        }
        img, video {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 14px;
            margin-bottom: 5px;
            word-break: break-all;
        }
        .info {
            font-size: 12px;
            opacity: .7;
        }
    </style>
</head>
<body>

<h2>Archivos subidos</h2>

<div class="grid">

    @foreach ($files as $file)
        <div class="card">

            {{-- Detectar si es imagen --}}
            @if (str_contains($file->mime_type, 'image'))
                <img src="{{ asset('storage/' . $file->path) }}" alt="Imagen">
            @endif

            {{-- Detectar si es video --}}
            @if (str_contains($file->mime_type, 'video'))
                <video controls>
                    <source src="{{ asset('storage/' . $file->path) }}" type="{{ $file->mime_type }}">
                </video>
            @endif

            <div class="title">{{ $file->original_name }}</div>
            <div class="info">
                Tipo: {{ $file->mime_type }} <br>
                Tamaño: {{ number_format($file->size / 1024, 2) }} KB
            </div>

        </div>
    @endforeach

</div>

</body>
</html>
