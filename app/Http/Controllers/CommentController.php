<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\BaseController;

class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comment = Comment::with('user')->get();

        return $this->sendResponse($this->successMessage['get'], CommentResource::collection($comment));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;

        $comment = Comment::create($request->all());

        if($comment->isClean()){
            return $this->sendResponse($this->successMessage['insert']);
        }else{
            return $this->sendError($this->errorMessage['insert']);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'content' => 'required',
        ]);

        $comment = Comment::find($id);

        if(!$comment){
            return $this->sendError($this->errorMessage['notfound']);
        }

        $comment->update($request->all());

        if ($comment->isClean()) {
            return $this->sendResponse($this->successMessage['update']);
        } else {
            return $this->sendError($this->errorMessage['update'], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comment = Comment::find($id);

        if (!$comment) {
            return $this->sendError($this->errorMessage['notfound']);
        }

        $comment->delete();

        if ($comment->isClean()) {
            return $this->sendResponse($this->successMessage['delete']);
        } else {
            return $this->sendError($this->errorMessage['delete'], 409);
        }
    }
}
