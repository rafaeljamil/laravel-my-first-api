<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Tag;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tags = TagsResource::collection(Tag::all());
        $filtered = $tags->where('task_id', $this->id);
        return [
        'id' => (string)$this->id,
        'type' => 'Tasks',
        'attributes' => [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ],
        'tags'=> [
            $filtered
        ]
        
        ];
    }
}
