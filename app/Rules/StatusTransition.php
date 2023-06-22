<?php

namespace App\Rules;

use App\Models\Complaint;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class StatusTransition implements InvokableRule, DataAwareRule
{
    protected $data = [];

    public function __invoke($attribute, $value, $fail)
    {
        if ($this->data['current_status'] == $this->data['status']) {
            return;
        }
        $transitions = Complaint::transitions();
        if (in_array($this->data['status'], $transitions[$this->data['current_status']])) {
            return;
        }
        $fail('can\'t move from ' . $this->data['current_status'] . ' to ' . $this->data['status']);

    }
    public function setData($data): static
    {
        $this->data = $data;
        return $this;
    }
}
