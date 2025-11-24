public function showMongoNews()
{
    $news = NewsMongo::with('files')->get();

    $response = $news->map(function ($item) {
        
        return [
            "new_id"      => $item->new_id,
            "title"       => $item->title,
            "description" => $item->description,
            "created_at"  => $item->created_at,
            "updated_at"  => $item->updated_at,

            "images" => $item->files->where('type', 'image')->values(),
            "videos" => $item->files->where('type', 'video')->values(),
        ];
    });

    return response()->json($response);
}
