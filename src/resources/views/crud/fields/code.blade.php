<!-- textarea -->
@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')
<textarea class="code-editor code-editor-{{ $field['name'] }}" name="{{ $field['name'] }}" @include('crud::fields.inc.attributes')>{{ old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? '')) }}</textarea>

@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@if ($crud->fieldTypeNotLoaded($field))
    @php
        $crud->markFieldTypeAsLoaded($field);
    @endphp

    @push('crud_fields_styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css"
            integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    @push('crud_fields_scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"
            integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @endpush
@endif
@push('crud_fields_scripts')
    <script>
        $(() => {
            CodeMirror.fromTextArea(document.querySelector('.code-editor-{{ $field['name'] }}'), {
                mode: "htmlmixed",
                lineNumbers: true,
            }).save();
        })
    </script>
@endpush
