@extends('headerAndFooter')
@section('body')

<div class="container mt-5 mb-5">
    <form class=" mt-5 mb-5" id="myForm" method="POST" action="{{ route('adduseraccess') }}">
        @csrf
        <h6 class="pt-4">
            <b class="bg-dark p-1 text-white">
                {{ __('message.addUserَAccessPage.titleUseraccessPage') }}
            </b>
        </h6>
        <div class="row pt-2">
            <div class="col-sm-4 mt-2">
                <input class="form-control" type="text" name="title" placeholder="{{ __("message.addUserَAccessPage.accessName") }}">
            </div>
            <div class="col-sm-4 mt-2">
                <div class="input-group">
                <select id="homepage" name="homepage" onchange="changed(this);" class="form-control" name="">
                    <option value="">{{ __("message.addUserَAccessPage.selectFirstOpsion") }}</option>
                   @foreach (__('message.allpage') as $key=>$page)
                   <option value="{{ $key }}">{{ $page }}</option>
                   @endforeach
                </select>
                </div>
            </div>
            @foreach (__('message.allpage') as $key=>$page)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="{{ $key }}" name="{{ $key }}" type="checkbox"> {{ $page }}
                    </label>
                </div>
            </div>
            @endforeach
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="publicuser" name="publicuser" type="checkbox"> {{ __('message.textpublicUser') }}
                    </label>
                </div>
            </div>

        </div>
        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                {{ __('message.addUserَAccessPage.titleListReciveSmsInUseraccessPage') }}
            </b>
        </h6>
        <div class="row">
            @foreach ($suborder as $sub)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="{{$sub->id }}" name="{{$sub->id }}" type="checkbox"> {{ $sub->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                {{ __('message.addUserَAccessPage.titleColorInUseraccessPage') }}
            </b>
        </h6>
        <div class="row">
            @foreach ( __('message.colors') as $key=>$color)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="input-group form-control">
                        {{ $color[1]." : " }} <input class="form-control" value="{{ $color[2] }}" id="{{$key }}" name="{{$key}}" type="color">
                    </label>
                </div>
            </div>
            @endforeach

        </div>
        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                 {{ __('message.addUserَAccessPage.titleListChooseCategoryInUseraccessPage') }}
            </b>
        </h6>

        <div class="row">
            @foreach ($suborder as $sub)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="select{{$sub->id }}" name="select{{$sub->id }}" type="checkbox"> {{ $sub->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>


        <div class=" col-sm-3 mx-auto">
            <div class="input-group mx-auto m-2">
                <button class="btn btn-success mx-auto" onclick="refsubmit();" type="button">{{ __("message.addUserَAccessPage.addButton") }}</button>
                <a class="btn btn-primary mx-auto"  href="{{ route('useraccess') }}">{{ __("message.addUserَAccessPage.backButton") }}</a>
            </div>
        </div>
    </form>

</div>


<script>
    function refsubmit(){
        if(confirm('{{ __("message.addUserَAccessPage.confrimAddUserAccess") }}')){
        var form=document.getElementById("myForm");
              form.submit();

        }
    }
    function changed(item){
        document.getElementById(item.value).checked = true
    }


</script>
@endsection
