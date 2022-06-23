@extends('headerAndFooter')
@section('body')

<div class="header-mobile align-items-center header-mobile-fixed d-block d-sm-none">
    <br>
</div>
<div class="row mt-5">
    <h5 class="p-3 my-auto shadow" style="background-color: #e2e0e091">
       {{ __('message.showTicketPage.title') }}  : {{ $tickets->code }}
    </h5>
    <br>
    <table style="text-align: center;" class="table my-auto mt-5 ">
        <thead style="background-color: #41e3ff91">
            <tr style="text-align: center;">
                @foreach (__('message.showTicketPage.table') as $key=>$item)
                <th style="text-align: center;" scope="col">{{ $item}}</th>
                @endforeach
                {{-- <th style="text-align: center;" scope="col">موضوع</th>
                <th style="text-align: center;" scope="col">نام کاربر</th>
                <th style="text-align: center;" scope="col">کد  ملی</th>
                <th style="text-align: center;" scope="col">وضعیت</th>
                <th style="text-align: center;" scope="col">تعداد چت</th> --}}
            </tr>
        </thead>
        <tbody>
            <td>{{ $tickets->getorder->name }}</td>
            <td>{{ $tickets->getuser->name }}</td>
            <td>{{ $tickets->getuser->username }}</td>
            <td>
                {{ __('message.showTicketPage.typestatus')[$tickets->status] }}
                </td>
            <td>{{ $tickets->messages->count() }}</td>
        </tbody>
    </table>
<br>
<br>

</div>
@foreach ($tickets->messages as $item)
<div class="col mt-5">
    <div class="row"
    @if ($tickets->user_id==$item->user_id)
    style="background: #ebebeb;padding: 5px;min-height:50px;color:#03778b;"
    @else
    style="background: #d1eeff;padding: 5px;min-height:50px;color:#03778b;"
    @endif>
        <div style="text-align: {{ __('setting.right-align') }};"  class="col my-auto">
           <h6 class="my-auto"> {{ $item->getuser->name }}</h6>
        </div>
        <div style="text-align: {{ __('setting.left-align') }};" class="col my-auto">
            <h6  class="my-auto"> {!! jdate( $item->created_at)->format(' H:i:s Y-m-d') !!}</h6>
        </div>
    </div>
    <div class="row my-auto"
    @if ($tickets->user_id==$item->user_id)
    style="background: #f5f5f5;padding: 10px;"
    @else
    style="background: #def3ff;padding: 10px;"
    @endif>
        <div class="row cil">
            {!! $item->text !!}
        </div>
        <div class="row">
            @if ($item->audio!="")
            <audio  src="{{ url($item->audio) }}" controls></audio>
            @endif
        </div>
        <div class="row mx-auto text-center">
            <div class="col-sm mx-auto text-center ">
                @if ($item->file!="")
            <a class="btn btn-primary mx-auto" target="_download" href="{{ url($item->file) }}">{{ __('message.showTicketPage.downloadFile') }}</a>
            @endif
            </div>

        </div>
    </div>
</div>
@endforeach

@auth
    @if (($tickets->status>=0) &&
    ((array_search($tickets->order,$rollconfig)&&array_search('answerforalluser',$rollconfig)&&array_search('answer',$rollconfig))
    ||
    (Auth::user()->id==$tickets->user_id&&array_search('answer',$rollconfig)))
    )
    <style>
        .divchooser{
        height: 100%;
        width: 100%;
        background-image: url('{{ url("images/add.png") }}');
        background-repeat: no-repeat;
        background-attachment: cover;
        background-position: center;
        background-size: 75px 75px;
        opacity: 0.5;
    }
    .divchooser2{
        height: 100%;
        width: 100%;
        background-image: url('{{ url("images/audio.png") }}');
        background-repeat: no-repeat;
        background-attachment: cover;
        background-position: center;
        background-size: 75px 75px;
        opacity: 0.5;
    }
    .divchooser:hover,.divchooser2:hover{
        opacity: 1;
    }
    </style>
    @include('uploadfileJS')
    <form method="POST" action="{{ route('answer',$tickets->code) }}" id="answerform">
        @csrf
        <div class="row pt-5">
            <div class="col-sm-4 pt-5">
                <h6>{{ __('message.showTicketPage.BodyMessage') }}
                    <span  style="color: red;font-size: 14px;">({{ __('message.showTicketPage.Necessary') }})</span>
                </h6>
                <textarea name="text" class="form-control" aria-required="true" aria-invalid="false" rows="6" >{{ old('text') }}</textarea>
            </div>
            <div class="col-sm-4 pt-5">
                <h6>{{ __('message.showTicketPage.titleUploadFile') }}</h6>
                <div class="mx-auto border border-dark mx-auto m-2 text-center align-center" style="height: 100%;width: 100%;max-height: 155px;">
                    <input value="{{ old('filepath') }}" type="text" name="filepath" id="filepath" hidden>
                    <div class="divchooser" id="divfilechooser">
                        <input type="file" id="file_upload" style="opacity: 0;height: 100%;width: 100%;" onchange="uploadFiles();"/>
                    </div>
                    <h6 id="titleUploadfile" hidden>{{ __("message.showTicketPage.onUploadFile") }}</h6>
                    <button id="btnloadfile" class="btn btn-primary mx-auto" type="button" disabled hidden>
                        {{ __("message.showTicketPage.onUpload") }}
                        <span class="spinner-border spinner-border-sm" ></span>
                    </button>
                    <button id="btnsuccessfile" type="button" class="btn btn-outline-success btn-rounded waves-effect" disabled hidden>
                        {{ __("message.showTicketPage.UploadSuccess") }}
                    </button>
                    <button id="btndeletefile" type="button" class="btn btn-outline-danger" hidden>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                        </svg>
                        {{ __("message.showTicketPage.deletFile") }}
                    </button>

                </div>
            </div>
            <div class="col-sm-4 pt-5">
                <h6>{{ __("message.showTicketPage.titleUploadVoice") }}</h6>

                <div class="mx-auto border border-dark mx-auto m-2 text-center align-center" style="height: 100%;width: 100%;max-height: 155px;">
                    <input value="{{ old('audiopath') }}" type="text" name="audiopath" id="audiopath" hidden>
                    <div class="divchooser2" id="divaudiochooser">
                        <input type="file" id="audio_upload" style="opacity: 0;height: 100%;width: 100%;"  accept="audio/*" capture="microphone"  onchange="uploadaudios();"/>
                    </div>
                    <h6 id="titleUploadaudio" hidden>{{ __("message.showTicketPage.onUploadVoice") }}</h6>
                    <button id="btnloadaudio" class="btn btn-primary mx-auto" type="button" disabled hidden>
                        {{ __("message.showTicketPage.onUpload") }}
                        <span class="spinner-border spinner-border-sm" ></span>
                    </button>
                    <button id="btnsuccessaudio" type="button" class="btn btn-outline-success btn-rounded waves-effect" disabled hidden>
                        {{ __("message.showTicketPage.UploadSuccess") }}
                    </button>
                    <button id="btndeleteaudio" type="button" class="btn btn-outline-danger" hidden>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                        </svg>
                        {{ __("message.showTicketPage.deleteVoice") }}
                    </button>

                </div>
            </div>
        </div>
        <div class="mx-auto text-center pt-5">

            <button type="button" onclick="if(confirm('{{ __('message.showTicketPage.confrimAddButtonText') }}')){answerform.submit()}" class="btn btn-primary mx-auto">{{ __("message.showTicketPage.addButton") }}</button>
        </div>
      </form>
      <br>
    @endif

    <script>
        var textaudio = "{{old('audiopath')}}";
        audiouploaded(textaudio);
        var textfile = "{{old('filepath')}}";
        fileuploaded(textfile);
    </script>
@endauth
@endsection

