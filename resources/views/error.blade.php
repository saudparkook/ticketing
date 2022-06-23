@php
        $er='';
    if ($errors->any()){
        foreach($errors->all() as $error){
            $er=$er.$error.'\n';
        }
    }
    if (session("error-dialog")){
        $er=$er.session("error-dialog");
    }
    $successfull='';
    if (session("success-dialog")){
        $successfull=session("success-dialog");
    }
@endphp


<script>
    @if ($er!='')
    toast_dialog_error('{{ $er }}');
    @endif
    @if ($successfull!='')
    toast_dialog('{{ $successfull }}');
    @endif

</script>
