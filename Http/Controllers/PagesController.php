<?php

/**
 * Made by CV. IRANDO
 * https://irando.co.id ©2023
 * info@irando.co.id
 */

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Page;
use Illuminate\Support\Str;
use Storage;
use Image;
use Schema;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super-admin|staff','permission:add page|edit page|delete page']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->get();
        return view('pages::index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pages::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->name = $request->input('name');
        $page->active = $request->input('active');
        $page->description = $request->input('description');
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = $page->slug. '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            $pathToThumbImage = public_path('images/thumb/'. $filename);
            $pathToBigImage = public_path('images/big/'. $filename);
            Image::make($image)->resize(1200, 672)->save($location); // for social media
            Image::make($image)->resize(250, 250)->save($pathToThumbImage);
            Image::make($image)->save($pathToBigImage);
            $page->photo = $filename;
        }
        if(Schema::hasTable('seos')) {
            if($page->save()) {
                $seo = new \Modules\Seo\Entities\Seo;
                $seo->name = $request->input('seo_name');
                $seo->tags = $request->input('seo_tags');
                $seo->description = $request->input('seo_description');
                if ($request->hasFile('seo_photo')) {
                    $image = $request->file('seo_photo');
                    $filename = 'seo-' . time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/'. $filename);
                    $pathToThumbImage = public_path('images/thumb/'. $filename);
                    $pathToBigImage = public_path('images/big/'. $filename);
                    Image::make($image)->resize(1200, 672)->save($location); // for social media
                    Image::make($image)->resize(250, 250)->save($pathToThumbImage);
                    Image::make($image)->save($pathToBigImage);
                    $seo->photo = $filename;
                }
                $seo->seoble_id = $page->id;
                $seo->seoble_type = 'Modules\Pages\Entities\Page';
                $page->save();
            }
        } else {
            $page->save();
        }
        return redirect()->route('pagesIndex');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pages::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        if(Schema::hasTable('seos')) {
            $seo = $page->seo()->first();
            return view('pages::edit', compact('page', 'seo'));
        } else {
            return view('pages::edit', compact('page'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->name = $request->input('name');
        $page->active = $request->input('active');
        $page->description = $request->input('description');
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = $page->slug . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/'. $filename);
            $pathToThumbImage = public_path('images/thumb/'. $filename);
            $pathToBigImage = public_path('images/big/'. $filename);
            Image::make($image)->resize(1200, 672)->save($location); // for social media
            Image::make($image)->resize(250, 250)->save($pathToThumbImage);
            Image::make($image)->save($pathToBigImage);
            $oldFilename = $page->photo;
            $page->photo = $filename;
            if(!empty($page->photo)){
                Storage::delete($oldFilename);
            }
        }
        if(Schema::hasTable('seos')) {
            if($page->save()) {
                $seo = new \Modules\Seo\Entities\Seo;
                $seo->name = $request->input('seo_name');
                $seo->tags = $request->input('seo_tags');
                $seo->description = $request->input('seo_description');
                if ($request->hasFile('seo_photo')) {
                    $image = $request->file('seo_photo');
                    $filename = 'seo-' . time() . '.' . $image->getClientOriginalExtension();
                    $location = public_path('images/'. $filename);
                    $pathToThumbImage = public_path('images/thumb/'. $filename);
                    $pathToBigImage = public_path('images/big/'. $filename);
                    Image::make($image)->resize(1200, 672)->save($location); // for social media
                    Image::make($image)->resize(250, 250)->save($pathToThumbImage);
                    Image::make($image)->save($pathToBigImage);
                    $seo->photo = $filename;
                }
                $seo->seoble_id = $page->id;
                $seo->seoble_type = 'Modules\Pages\Entities\Page';
                $page->save();
            }
        } else {
            $page->save();
        }
        return redirect()->route('pagesIndex');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        return redirect()->route('pagesIndex');
    }
}
