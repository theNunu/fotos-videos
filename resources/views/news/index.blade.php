
<div class="container mt-4">

    <h2 class="mb-4">Listado de Noticias</h2>

    @foreach ($news as $item)
        <div class="card mb-4">
            <div class="card-body">

                {{-- 📌 Título y descripción --}}
                <h4>{{ $item->title }}</h4>
                <p>{{ $item->description }}</p>

                <hr>

                {{-- 📌 Portada principal --}}
                @if ($item->file)
                    <h5>Portada</h5>
                    @if ($item->file->type === 'image')
                        <img src="{{ asset($item->file->path) }}" 
                             alt="Imagen portada"
                             class="img-fluid mb-3" 
                             style="max-width: 250px;">
                    @elseif ($item->file->type === 'video')
                        <video controls style="max-width: 300px;">
                            <source src="{{ asset($item->file->path) }}" type="video/mp4">
                            Tu navegador no soporta videos.
                        </video>
                    @endif
                @endif

                {{-- 📌 Galería de imágenes --}}
                @if ($item->images->count() > 0)
                    <h5>Imágenes associadas</h5>
                    <div class="d-flex flex-wrap gap-3 mb-3">
                        @foreach ($item->images as $image)
                            <img src="{{ asset($image->path) }}" 
                                 class="img-thumbnail"
                                 style="width: 150px; height: auto;">
                        @endforeach
                    </div>
                @endif

                {{-- 📌 Galería de videos --}}
                @if ($item->videos->count() > 0)
                    <h5>Videos asociados</h5>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($item->videos as $video)
                            <video controls style="width: 250px; height: auto;">
                                <source src="{{ asset($video->path) }}" type="video/mp4">
                                Tu navegador no soporta videos.
                            </video>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    @endforeach

</div>

