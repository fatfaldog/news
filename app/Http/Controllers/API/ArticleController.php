<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use App\Models\News;

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
            if( $request->input('typename')== 'news'){
                $classname = 'News';
            }
        }

        $classname = 'App\\Models\\'.$classname;

        $query = $classname::query()->paginate(15);

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

        $articles = $query->get();

        return response()->json([
            'articles' => $articles
        ]);
    }
}
