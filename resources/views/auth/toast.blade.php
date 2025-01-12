@toastr_css
@toastr_js
@toastr_render
<script>
    @if(count($errors) > 0)
        @if (
            \Route::currentRouteName() != 'app.sales.create' && \Route::currentRouteName() != 'app.sales.edit' && 
            \Route::currentRouteName() != 'app.pig-breeds.create' && \Route::currentRouteName() != 'app.pig-breeds.edit'
            )
            @foreach($errors->all()  as $error)
            toastr.error('{{ $error }}');
            @endforeach
        @else
            toastr.error('Vui lòng kiểm tra lại các trường');
        @endif
    @endif
</script>
