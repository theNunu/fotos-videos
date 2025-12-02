<?php

namespace App\Services;

use App\FileRelationType;
use App\Models\File;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class NewsService
{
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function index()
    {
        return $this->newsRepository->all();
    }

    public function create(array $data)
    {
        // Crear noticia
        $news = $this->newsRepository->store([
            'title' => $data['title'],
            'description' => $data['description'],
            'file_id' => $data['file_id'] ?? null,
        ]);

        // Insertar imágenes (type = image)
        // if (!empty($data['images'])) {
        //     foreach ($data['images'] as $fileId) {
        //         $news->newsFiles()->attach($fileId, [
        //             'type' => FileRelationType::IMAGE->value
        //         ]);
        //     }
        // }

        // Insertar videos (type = video)
        // if (!empty($data['videos'])) {
        //     foreach ($data['videos'] as $fileId) {
        //         $news->newsFiles()->attach($fileId, [
        //             'type' => FileRelationType::VIDEO->value
        //         ]);
        //     }
        // }

        // 🔥 Recargar la noticia con las relaciones
        // $news->load(['images', 'videos']); //ESTO ES CLAVE

        return $news;
    }

    public function show(string $id)
    {
        return $this->newsRepository->find($id);
    }

    public function addMedia(array $request, string $id)
    {
        $news = News::findOrFail($id);

        $insertRows = [];

        // IMAGEN (siempre UUID)
        if (!empty($request['images'])) {
            $insertRows[] = [
                'new_id'  => $news->new_id,
                'file_id' => $request['images'],
                'type'    => 'image',
                'url_externo'     => null,
            ];
        }

        // VIDEO (URL o UUID)
        if (!empty($request['videos'])) {

            $value  = $request['videos'];
            $isUuid = Str::isUuid($value);
            $isUrl  = filter_var($value, FILTER_VALIDATE_URL);

            if (!$isUuid && !$isUrl) {
                throw ValidationException::withMessages([
                    'videos' => ['El video debe ser un UUID válido o una URL válida.']
                ]);
            }

            if ($isUuid && !File::where('file_id', $value)->exists()) {
                throw ValidationException::withMessages([
                    'videos' => ['El file_id proporcionado no existe.']
                ]);
            }

            $insertRows[] = [
                'new_id'  => $news->new_id,
                'file_id' => $isUuid ? $value : null,
                'type'    => 'video',
                'url_externo'     => $isUrl ? $value : null,
            ];
        }

        // INSERTAR DIRECTAMENTE EN news_files
        foreach ($insertRows as $row) {
            $news->newsFiles()->newPivot($row)->save();
        }

        return $news->load(['images', 'videos']);
    }


    // public function update(string $id, array $data)
    // {
    //     $news = News::findOrFail($id);

    //     // 1. Actualizar campos normales
    //     $news->update($data);

    //     // ---------------------------------------------------
    //     // 2. Actualizar IMÁGENES
    //     // ---------------------------------------------------
    //     if (isset($data['images'])) {

    //         // Obtener IDs actuales de tipo imagen
    //         $currentImageIds = $news->images()->pluck('files.file_id')->toArray();

    //         // Quitar las imágenes actuales
    //         if (!empty($currentImageIds)) {
    //             $news->newsFiles()->detach($currentImageIds);
    //         }

    //         // Agregar las nuevas
    //         foreach ($data['images'] as $fileId) {
    //             $news->newsFiles()->attach($fileId, ['type' => 'image']);
    //         }
    //     }

    //     // ---------------------------------------------------
    //     // 3. Actualizar VIDEOS
    //     // ---------------------------------------------------
    //     if (isset($data['videos'])) {

    //         // Obtener IDs actuales de tipo video
    //         $currentVideoIds = $news->videos()->pluck('files.file_id')->toArray();

    //         // Quitar los videos actuales
    //         if (!empty($currentVideoIds)) {
    //             $news->newsFiles()->detach($currentVideoIds);
    //         }

    //         // Agregar los nuevos
    //         foreach ($data['videos'] as $fileId) {
    //             $news->newsFiles()->attach($fileId, ['type' => 'video']);
    //         }
    //     }

    //     // 4. Recargar relaciones correctamente
    //     $news->load(['files', 'images', 'videos']);

    //     return $news;
    // }
}
