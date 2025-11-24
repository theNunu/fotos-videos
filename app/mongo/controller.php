namespace App\Http\Controllers;

use App\Services\MongoNewsService;

class MongoNewsController extends Controller
{
    protected $mongoNewsService;

    public function __construct(MongoNewsService $mongoNewsService)
    {
        $this->mongoNewsService = $mongoNewsService;
    }

    public function getCategories()
    {
        return response()->json([
            'categories' => $this->mongoNewsService->listAllCategoriesFromNews()
        ]);
    }
}
