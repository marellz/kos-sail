<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user_id' => $this->user_id,
            'email' => $this->email,
            'subject' => $this->subject,
            'phone' => $this->phone,
            'message' => $this->message,
            'response_to' => $this->response_to,
            'resolved' => $this->resolved,
            'read' => $this->read,
            'sent_at' => $this->updated_at->format('d/m/y - H:m A'),
        ];
    }
}
