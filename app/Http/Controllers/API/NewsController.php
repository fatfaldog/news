<?php

namespace App\Http\Controllers\API;

class NewsController extends Controller
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
        $query = \DB::table('articles')->paginate(15);

        if ($request->has('q')) {
            $param = $request->input('q');

            $query = $query->where(function ($q) use ($param) {
                $q->orWhere('title', 'like', '%' . $param . '%');
                $q->orWhere('description', 'like', '%' . $param . '%');
                $q->orWhere('content', 'like', '%' . $param . '%');

                $q->orWhereHas('author', function ($q) use ($param) {
                    $q->where('name', 'like', '%' . $param . '%');
                });

                $q->orWhereHas('category', function ($q) use ($param) {
                    $q->where('name', 'like', '%' . $param . '%');
                });
            });
        }

        if ($request->has('from_date')) {
            $param = $request->input('from_date');
            $query->where('publishedAt', '>=', $param);
        }

        if ($request->has('to_date')) {
            $param = $request->input('to_date');
            $query->where('publishedAt', '<=', $param);
        }


        if ($request->has('typename')) {
            $param = $request->input('typename');
            $query->where('typename', $param);
        }

        $articles = $query->get();

        return response()->json([
            'articles' => $articles
        ]);
    }
}
