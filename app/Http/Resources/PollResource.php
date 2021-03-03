<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Vote;
use Carbon\Carbon;
class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_by' => $this->created_by,
            'creator' => $this->user->username,
            'deadline' => $this->deadline,
            'result' => null,
            'choices' => $this->choices
            // 'creator' => $this->;
        ];

        $vote = Vote::where('poll_id', $this->id)->get();

        $result = ChoiceResource::collection($vote);

        if(auth()->user()->role == 'admin'){
            $data['result'] = $result;
        }else{
            $isUserVote = Vote::where('poll_id', $this->id)->where('user_id', auth()->user()->id)->first();
            if($isUserVote || Carbon::now()->gte(Carbon::parse($this->deadline))){
                $data['result'] = $result;
            }
        }
        return $data;
        // return parent::toArray($request);
    }
}
