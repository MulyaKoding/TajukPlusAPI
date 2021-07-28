<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Video;
use Validator;
use App\Http\Resources\Video as VideoResource;

class VideoController extends BaseController
{
    public function index() {
        $video = Video::all();
        return $this->sendResponse(VideoResource::collection($video), 'All videos retrieved.');
    }

    public function show($id) {
        $video = Video::find($id);
        if (is_null($video)) {
            return $this->sendError('Video not found.');
        }

        return $this->sendResponse(new VideoResource($video), 'Video detail retrieved successfully.');
    }
}