@extends('headerAndFooter')
@section('body')

<div class="container mt-5 mb-5">

    <form id="myForm"  method="POST" action="{{ route('edituseraccess',$userAccess->id) }}">
        @csrf
        <h6 class="pt-4">
            <b class="bg-dark p-1 text-white">
                {{ __('message.editUserَAccessPage.titleUseraccessPage') }}
            </b>
        </h6>
        <div class="row mx-auto text-center pt-2">
            <div class="col-sm-4 pt-2">
                <input class="form-control" value="{{ $userAccess->title }}" type="text" name="title" placeholder="{{ __('message.editUserَAccessPage.accessName') }}">
            </div>
            <div class="col-sm-4 pt-2">
                <div class="input-group">
                <select id="homepage" name="homepage" onchange="changed(this);" class="form-control " name="">
                    <option value="">{{ __("message.editUserَAccessPage.selectFirstOpsion") }}</option>
                   @foreach (__('message.allpage') as $key=>$page)
                   <option @if ($userAccess->homepage==$key)
                       selected
                   @endif value="{{ $key }}">{{ $page }}</option>
                   @endforeach
                </select>
                </div>
            </div>
            @foreach (__('message.allpage') as $key=>$page)
            <div class="col-sm-4 pt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="{{ $key }}" name="{{ $key }}" type="checkbox" @if ($userAccess->$key==$key)
                        checked
                    @endif>
                        {{ $page }}
                    </label>
                </div>
            </div>
            @endforeach
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="publicuser" name="publicuser" type="checkbox" @if ($userAccess->status=='on')
                        checked
                    @endif> {{ __('message.publicUser') }}
                    </label>
                </div>
            </div>

        </div>
        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                {{ __('message.editUserَAccessPage.titleListReciveSmsInUseraccessPage') }}
            </b>
        </h6>
        <div class="row">
            @foreach ($suborder as $sub)
            @php
                $subkey=$sub->id;
            @endphp
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="{{ $subkey}}" name="{{ $subkey }}" type="checkbox" @if ($userAccess->$subkey==$subkey)
                        checked
                    @endif> {{ $sub->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>

        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                {{ __('message.editUserَAccessPage.titleColorInUseraccessPage') }}
            </b>
        </h6>
        <div class="row">
            @foreach ( __('message.colors') as $key=>$color)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="input-group form-control">
                        {{ $color[1]." : " }} {{ @$settingAccess[$key] }}
                        <input class="form-control" value="{{ @$settingAccess[$key] }}" id="{{$key }}" name="{{$key}}" type="color">
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        <hr>
        <h6>
            <b class="bg-dark p-1 text-white">
                {{ __('message.editUserَAccessPage.titleListChooseCategoryInUseraccessPage') }}
            </b>
        </h6>
        <div class="row">
            @foreach ($suborder as $sub)
            <div class="col-sm-4 mt-2">
                <div class="input-group" >
                    <label class="form-control">
                        <input id="select{{$sub->id }}" name="select{{$sub->id }}" type="checkbox"
                        @isset($settingAccess[$sub->id])
                            checked
                        @endisset

                        > {{ $sub->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>



        <div class=" col-sm-3 mx-auto">
            <div class="input-group mx-auto m-2">
                <button class="btn btn-success mx-auto" onclick="refsubmit();" type="button">{{ __("message.editUserَAccessPage.addButton") }}</button>
                <a class="btn btn-primary mx-auto"  href="{{ route('useraccess') }}">{{ __("message.editUserَAccessPage.backButton") }}</a>
            </div>
        </div>
    </form>

</div>


<script>
    function refsubmit(){
        if(confirm('{{ __("message.editUserَAccessPage.confrimUpdateUserAccess") }}')){
        var form=document.getElementById("myForm");
              form.submit();

        }
    }
    function changed(item){
        document.getElementById(item.value).checked = true
    }


</script>
@endsection
