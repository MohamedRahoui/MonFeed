<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    /**
     * Render facebook index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function facebook_view()
    {
        $pages = Auth::user()->pages()->get();
        return view('my_space.facebook.index', compact('pages'));
    }

    /**
     * Render facebook publications view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function publications_view()
    {
        return view('my_space.facebook.post');
    }

    /**
     * Render facebook search view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_view()
    {
        return view('my_space.facebook.search');
    }

    /**
     * @param Request $request
     * $request = page id
     * @return \Illuminate\Http\JsonResponse
     * return boolean added
     */
    public function add_page(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $page = new Page();
        $page->facebook_id = $id;
        $page->key = str_random(40);
        $user->pages()->save($page);
        return response()->json(['added' => true]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * return pages ids
     */
    public function get_pages_ids()
    {
        $pages = Auth::user()->pages()->pluck('facebook_id')->toArray();
        if ($pages) {
            return response()->json(['found' => true, 'pages' => $pages]);
        } else {
            return response()->json(['found' => false]);
        }

    }

    /**
     * @param Request $request
     * $request = page key
     * @return \Illuminate\Http\JsonResponse
     * return boolean deleted
     */
    public function delete_page_by_key(Request $request)
    {
        $key = $request->get('key');
        $page = Page::where('key', $key)->first();
        if ($page->delete()) {
            return response()->json(['deleted' => true]);
        } else {
            return response()->json(['deleted' => false]);
        }
    }
}
