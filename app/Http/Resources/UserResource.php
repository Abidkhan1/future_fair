<?php

namespace App\Http\Resources;

use App\Models\Session;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'details' => $this->details,
            'contact' => $this->contact,
            'address' => $this->address,
            'display_name' => $this->display_name,
            'web_url' => $this->web_url,
            'total_employees' => $this->total_employees,
            'socialLinks' => $this->links,
            'uploads' => $this->uploads,
            'videos' => $this->videos,
            'galleryImages' => $this->galleryImages,
            'documents' => $this->documents,
            'online' => false,
            'session' => $this->session_details($this->id),
            'image' => $this->image,
            'logo' => $this->logo,
            'banner' => $this->banner,
            'poster' => $this->poster,
            'offers' => $this->offers,
        ];
    }
    private function session_details($id)
    {
        $session = Session::whereIn('user1_id', [auth()->id(), $id])->whereIn('user2_id', [auth()->id(), $id])->first();
        return new SessionResource($session);
    }
}
