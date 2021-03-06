<?php
/**
 * We want to pre-load the data from the model, or what has been sent with the form.
 */
$selectedOption = [];

// Try to load what was sent with the form first, in case there was a form validation error
$previous = old($fieldId);
if (!empty($previous) && !empty($prefillModel)) {
    // Previous input has a value, load that one
    $selectedModel = new $prefillModel;
    $selected = $selectedModel->find($previous);
    if ($selected) {
        $selectedOption = [$selected->id => $selected->name];
    }
}
// If we didn't get anything, and there is a model sent, use that
if (empty($selectedOption) && !empty($prefill)) {
    if ($prefill instanceof \App\Models\MiscModel) {
        $selectedOption = [$prefill->id => $prefill->name];
    } elseif ($prefill instanceof \App\Models\Entity) {
        $selectedOption = [$prefill->id => $prefill->name];
    } elseif (is_array($prefill)) {
        $selectedOption = $prefill;
    }
}

// Assume placeholder key
$singularFieldName = trim($fieldId, '_id');
$pluralField = ($singularFieldName == 'family' ? 'families' : $singularFieldName . 's');
if ($pluralField == 'parent_locations') {
    $pluralField = 'locations';
}
$placeholderKey = empty($placeholderKey) ? 'crud.placeholders.' . $singularFieldName : $placeholderKey;
$labelKey = empty($labelKey) ? 'crud.fields.' . $singularFieldName : $labelKey;
$searchRouteName = empty($searchRouteName) ? $pluralField . '.find' : $searchRouteName;
?>
<label>{{ trans($labelKey) }}</label>
@if ($allowNew)
    <div class="input-group input-group-sm">
@endif
{!! Form::select(
    $fieldId,
    $selectedOption,
    [],
    [
        'id' => $fieldId,
        'class' => 'form-control select2',
        'style' => 'width: 100%',
        'data-url' => route($searchRouteName),
        'data-placeholder' => trans($placeholderKey),
    ]
) !!}

@if ($allowNew)
    <div class="input-group-btn">
        <a class="new-entity-selector btn btn-tab-form" style="" data-toggle="modal" data-target="#new-entity-modal" data-parent="{{ $fieldId }}" data-entity="{{ $pluralField }}">
            <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>
</div>
@endif