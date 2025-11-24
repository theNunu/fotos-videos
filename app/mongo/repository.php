namespace App\Repositories;

use App\Models\MongoNews;

class MongoNewsRepository
{
    public function getAllUsedCategories()
    {
        // Obtener solo el campo categories de todas las noticias
        $categories = MongoNews::select('categories')->get();

        return $categories
            ->pluck('categories')   // extraemos el arreglo categorias
            ->flatten()             // convertimos todo en un solo array
            ->unique()              // eliminamos duplicados
            ->values();             // reindexar
    }
}
