<?php

namespace App\Http\Livewire;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use App\Models\Complaint;

class ComplaintTable extends LivewireDatatable
{
    public $model = Complaint::class;

    public function builder()
    {
        return Complaint::query();
    }

    public function columns()
    {
        $statuses = Complaint::getStatuses();
        $categories = Complaint::getCategories();
        return [
            NumberColumn::name('id')->label('Id'),
            Column::name('title'),
            Column::callback(['status'], function ($status) use ($statuses) {
                return $statuses[$status];
            })->label('Status'),
            Column::callback(['category'], function ($category) use ($categories) {
                return $categories[$category];
            })->label('Category'),

            DateColumn::name('created_at'),
            DateColumn::name('updated_at'),
            Column::callback(['id'], function ($id) {
                return view('complaint.table-actions', ['id' => $id, 'model' => $this]);
            })->unsortable()
        ];

    }

    public function newcomplaint()
    {
        return redirect(route('complaint.new'));
    }

}
