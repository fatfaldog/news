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

    public function search(\Illuminate\Http\Request $request) {
        $query = \DB::table('articles')->paginate(15);

        if ($request->has('q') ) {
            $query = $query->whe('feature_id', [$request->get('feature_id')]);
        }

        $products = $query->get();

        return response()->json([
            'products' =>$products
        ]);
    }
}
