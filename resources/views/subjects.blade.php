@extends('headerAndFooter')
@section('body')
<div class="row">

</div>

<div class="row col-sm-5 mt-2 mx-auto pt-4 pb-4 border border-dark shadow" style="text-align: center;">
        <form id="addsubform" method="POST" action="{{ route('addsubjectorder') }}">
            @csrf
            <div class="form-group row mx-auto">
            <input type="text" class="form-control" placeholder="{{ __('message.subjectsPage.placeholderAddbox') }}" name="name" id="name">
            </div>
            <div class="col-xs-2 pt-2">
                <button type="button" onclick="refsubmit('addsubform','{{ __('message.subjectsPage.confrimAddButtonText') }}')"
                class="btn mt-4 btn-primary h5 mx-auto"> {{ __('message.subjectsPage.addbutton') }} </button>
            </div>
        </form>
</div>


    <div class="row col-sm-7 mx-auto mt-3 border border-dark shadow">

        <table style="text-align: center;" class="table table-striped">
            <thead class="thead-dark">
                <tr style="text-align: center;">
                   @foreach (__('message.subjectsPage.table') as $key=>$item)
                    <th style="text-align: center;" scope="col">{{ $item}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $x=1;
                @endphp
                @foreach ($get as $subjectorder)
                <tr>
                    <td>{{$x}}</td>
                    <td>{{$subjectorder->name}}</td>
                    <td>
                        {{--  --}}
                        <form id='deletesubform' action="{{route('deletesuborder',$subjectorder->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button onclick="refsubmit('deletesubform','{{ __('message.subjectsPage.confrimdeleteButtonText') }}')"  class="btn btn-danger">
                                {{ __('message.subjectsPage.deletButton') }}
                            </button>
                        </form>
                </td>


                @php
                    $x++;
                @endphp
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>


<script>
     function refsubmit(formId,message){
    if(confirm(message)){
    var form=document.getElementById(formId);
              form.submit();

    }
}
</script>







@endsection
