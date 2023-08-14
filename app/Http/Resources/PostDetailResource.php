<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'), //memanggil jika mengghunakan with
            'comments' => $this->whenLoaded('comments', function(){
                return collect($this->comments)->each(function($comment){
                    $comment->commentator;
                    return $comment;
                });
            }), //memanggil jika mengghunakan with
            'count_comment' => $this->whenLoaded('comments', function(){
                return $this->comments->count();
            })
        ];
    }
}
