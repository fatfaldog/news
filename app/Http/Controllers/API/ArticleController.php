<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Models\News;

/**
 * @OA\Info(title="Article API", version="0.1")

 * @OA\Get(
 * path="/api/articles/search",
 * summary="List of articles",
 * description="List of articles",
 * operationId="articleList",
 * tags={"article"},
 * security={ {"bearer": {} }},
 * @OA\Parameter(
 *    name="q",
 *    in="path",
 *    required=true,
 *    example="1",
 *    @OA\Schema(
 *       type="string",
 *    )
 * ),
 * @OA\Response(
 *     response=200,
 *     description="Success",
 *     @OA\JsonContent(
 *     )
 *  )
 * )
 */
class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $classname = 'Article';
        if ($request->has('typename')) {
            if ($request->input('typename') == 'news') {
                $classname = 'News';
            }
        }

        $classname = 'App\\Models\\' . $classname;

        $query = $classname::query();

        if ($request->has('q')) {
            $param = $request->input('q');

            $query = $query->searchText($param);
        }

        if ($request->has('from_date')) {

            $param = $request->input('from_date');
            $query = $query->fromDate($param);
        }

        if ($request->has('to_date')) {
            $param = $request->input('to_date');
            $query = $query->toDate('typename', $param);
        }


        if ($request->has('typename')) {
            $param = $request->input('typename');
            $query = $query->typeName('typename', $param);
        }

        $articles = $classname::paginate(15);

        return response()->json(
             $articles
        );
    }
}
