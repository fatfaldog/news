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
 *    required=false,
 *    example="NFT",
 *    @OA\Schema(
 *       type="string",
 *    )
 * ),
 * @OA\Parameter(
 *    name="from_date",
 *    in="path",
 *    required=false,
 *    example="2021-11-02",
 *    @OA\Schema(
 *       type="string",
 *    )
 * ),
 * @OA\Parameter(
 *    name="to_date",
 *    in="path",
 *    required=false,
 *    example="2021-11-02",
 *    @OA\Schema(
 *       type="string",
 *    )
 * ),
 * @OA\Parameter(
 *    name="typename",
 *    in="path",
 *    required=false,
 *    example="news",
 *    @OA\Schema(
 *       type="string",
 *    )
 * ),
 * @OA\Response(
 *     response=200,
 *     description="Success",
 *     @OA\JsonContent(type="array", @OA\Items(ref="#Article"))
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

        $query = $classname::with(['category', 'author']);

        if ($request->has('q')) {
            $query->searchText($request->input('q'));
        }

        if ($request->has('from_date')) {
            $query->fromDate($request->input('from_date'));
        }

        if ($request->has('to_date')) {
            $query->toDate($request->input('to_date'));
        }

        $articles = $query->paginate(15);

        return response()->json(
            $articles
        );
    }
}
