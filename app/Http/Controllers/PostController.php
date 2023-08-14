<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PostDetailResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Post::with('user:id,name,role');

        if ($request->keyword) {
            $query->where('title', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->orderBy) {
            $query->orderBy('id', $request->orderBy);
        } else {
            $query->orderBy('id', 'ASC');
        }

        if ($request->pagination) {
            if ($request->limit) {
                $post = $query->paginate($request->limit);
            } else {
                $post = $query->paginate(10);
            }
        } else {
            $post = $query->get();
        }

        return $this->sendResponse($this->successMessage['get'], $post);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($request->file) {
            /* proses upload file */
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            $path = Storage::putFileAs('image', $request->file, $fileName . '.' . $extension);
            $request['image'] = $fileName . '.' . $extension;
        }

        $request['user_id'] = Auth::user()->id;

        $post = Post::create($request->all());

        if ($post->isClean()) {
            return $this->sendResponse($this->successMessage['insert']);
        } else {
            return $this->sendError($this->errorMessage['insert'], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::with(['user:id,email', 'comments:id,post_id,user_id,content,created_at'])->find($id);
        if (!$post) {
            return $this->sendError($this->errorMessage['notfound'], 404);
        }

        return $this->sendResponse($this->successMessage['get'], new PostDetailResource($post));

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
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return $this->sendError($this->errorMessage['notfound']);
        }

        $post->update($request->all());

        if ($user->isClean()) {
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
        $post = Post::find($id);

        if (!$post) {
            return $this->sendError($this->errorMessage['notfound']);
        }

        $post->delete();

        if ($post->isClean()) {
            return $this->sendResponse($this->successMessage['delete']);
        } else {
            return $this->sendError($this->errorMessage['delete'], 409);
        }
    }

    public function generateRandomString($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
