<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Vote;
use DB;
class ChoiceResource extends JsonResource
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
            'choices_id' => $this->choices_id,
            'choices' => $this->choices
        ];

        $vote = DB::table('votes')->whereRaw('choices_id in (SELECT max(choices_id) FROM votes)')->get();
         
        $data['point'] = 1;
        return $data;
        // return parent::toArray($request);
    }

}
