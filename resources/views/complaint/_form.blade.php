@bind($model)
<x-form-input required name="title" label="Title" />
<x-form-textarea required name="description" label="Description"/>
<x-form-select required name="category" :options="\App\Models\Complaint::getCategories()" label="Category"/>
<x-form-select required name="status" :options="\App\Models\Complaint::getStatuses()" label="Status"/>
@if (!$model->id)
<x-form-textarea name="note" label="Notes"/>
@endif
@endbind
<x-form-submit>
    <span>Send</span>
</x-form-submit>
