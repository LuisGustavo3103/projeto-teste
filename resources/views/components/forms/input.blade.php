<div>
    <input class="border rounded-2xl p-1" name="{{ $field }}" id="{{ $field }}" type="{{ $type }}"
        placeholder="{{ $placeholder }}" @if ($isRequired) required @endif {{ $attributes }} />
    <x-forms.input-error field="{{ $field }}" />
</div>
