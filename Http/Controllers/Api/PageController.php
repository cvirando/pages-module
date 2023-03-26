<?php

/**
 * Made by CV. IRANDO
 * https://irando.co.id ©2023
 * info@irando.co.id
 */

namespace Modules\Pages\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Page;

class PageController extends Controller
{
    /**
     * Show the specified page resource.
     * @param int $id
     * @return Renderable
     */
    public function index($slug)
    {
        $page = Page::where('slug', $slug)->where('active', true)->with(['seo'])->first();
        return response()->json([
            'data' => $page,
        ], 200);
    }
}
