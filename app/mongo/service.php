namespace App\Services;

use App\Repositories\MongoNewsRepository;

class MongoNewsService
{
    protected $mongoNewsRepository;

    public function __construct(MongoNewsRepository $mongoNewsRepository)
    {
        $this->mongoNewsRepository = $mongoNewsRepository;
    }

    public function listAllCategoriesFromNews()
    {
        return $this->mongoNewsRepository->getAllUsedCategories();
    }
}
