<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class YoutubeController
 * @package App\Http\Controllers
 */
class YoutubeController extends Controller
{
    /**
     * Render youtube index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function youtube_view()
    {
        $videos = Auth::user()->videos()->get();
        return view('my_space.youtube.index', compact('videos'));
    }

    /**
     * Render youtube search view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_view()
    {
        return view('my_space.youtube.search');
    }
    /**
     * @param Request $request
     * $request = video id
     * @return \Illuminate\Http\JsonResponse
     * return boolean added
     */
    public function add_video(Request $request)
    {
        $id = $request->input('id');
        $user = Auth::user();
        $video = new Video();
        $video->youtube_id = $id;
        $video->key = str_random(40);
        $user->videos()->save($video);
        return response()->json(['added' => true]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     * return videos ids
     */
    public function get_videos_ids()
    {
        $videos = Auth::user()->videos()->pluck('youtube_id')->toArray();
        if ($videos) {
            return response()->json(['found' => true, 'videos' => $videos]);
        } else {
            return response()->json(['found' => false]);
        }

    }

    /**
     * @param Request $request
     * $request = video key
     * @return \Illuminate\Http\JsonResponse
     * return boolean deleted
     */
    public function delete_video_by_key(Request $request)
    {
        $key = $request->get('key');
        $video = Video::where('key', $key)->first();
        if ($video->delete()) {
            return response()->json(['deleted' => true]);
        } else {
            return response()->json(['deleted' => false]);
        }
    }
}
