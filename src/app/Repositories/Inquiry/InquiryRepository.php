<?php
declare(strict_types=1);

namespace App\Repositories\Inquiry;

use App\Entities\Inquiry\Inquiry;
use App\Interfaces\Repositories\Inquiry\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{
    /**
     * @var \App\Models\Inquiry
     */
    private \App\Models\Inquiry $model;

    /**
     * @param \App\Models\Inquiry $model
     */
    public function __construct(\App\Models\Inquiry $model)
    {
        $this->model = $model;
    }

    /**
     * @param Inquiry $inquiry
     * @return void
     */
    public function registerInquiry(Inquiry $inquiry): void
    {
        $this->model->fill([
            'name' => (string)$inquiry->name(),
            'email' => (string)$inquiry->email(),
            'body' => (string)$inquiry->body()
        ])->save();
    }
}
