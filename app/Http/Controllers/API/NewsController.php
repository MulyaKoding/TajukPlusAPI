<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\News;
use Validator;
use App\Http\Resources\News as NewsResource;

class NewsController extends BaseController
{
    public function index() {
        $news = News::all();
        return $this->sendResponse(NewsResource::collection($news), 'All news retrieved.');
    }

    public function show($id) {
        $news = News::find($id);
        if (is_null($news)) {
            return $this->sendError('News not found.');
        }

        return $this->sendResponse(new NewsResource($news), 'News detail retrieved successfully.');
    }
}
