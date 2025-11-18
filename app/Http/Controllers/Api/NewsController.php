<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNews;
use App\Services\NewsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\HttpCache\Store;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function create(StoreNews $request)
    {
        return $this->newsService->create($request->all());
    }
}
