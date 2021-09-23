<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\News;
use Validator;
use App\Http\Resources\News as NewsResource;
use Hash;
use Illuminate\Support\Facedes\Auth;

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

    public function getNews() {
        $news = News::all();
        return $this->sendResponse(NewsResource::collection($news), 'News successfully retrieved.');
    }

    public function delete_news($id, Request $request){
        $news = News::find($id);
        $news -> delete();
        $validator = Validator::make($input,[
            'id' => 'required',
            'title' => 'required',
            'writer' => 'required',
            'category' => 'required',
            'tag' => 'required',
            'viewed' => 'required',
            'shared' => 'required',
            'liked' => 'required',
            'content' => 'required',
            'cover' => 'required',
            'created_at' => 'required',
            'updated_at' => 'required'
        ]); 

        if ($validator-> fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }else{
            $user = User::where('id', $id)->delete([
             'id' => $input['id'],
             'title' => $input['title'],
             'writer' => $input ['writer'],
             'category' => $input['category'] ,
             'tag' => $input['tag'],
             'viewed' => $input['viewed'],
             'shared' => $input['shared'],
             'liked' => $input['liked'],
             'content' => $input['content'],
             'cover' => $input['cover'],
             'created_at' =>$input['created_at'],
             'updated_at' => $input['updated_at']  
            ]);
            if(!$user){
                return $this->sendError('Delete Fails');
            } else {
                $success =[
              'id' => $input['id'],
              'title' => $input['title'],
              'writer' => $input['writer'],
              'category'=> $input['category'],
              'tag' => $input['tag'],
              'viewed' => $input['viewed'],
              'shared' => $input['shared'],
              'liked' => $input['liked'],
              'content' => $input['content'],
              'cover' => $input['cover'],
              'created_at' => $input['created_at'],
              'updated_at' => $input['updated_at']
                ];
                return $this->sendResponse($success, 'Delete News Success');
            }
        }
    }
}
