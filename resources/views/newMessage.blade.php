@extends('headerAndFooter')
@section('body')

<style>
    h6{
        color: #000d83;
        margin-bottom: 15px;
        margin-top: 25px;
    }
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
<form action="{{ route('addticket') }}" method="POST" id="formnewticket">
   <div class="container">
    <div class="row mx-auto">
        @csrf
        <div class="col-sm-4">
            <h6>
                {{ __("message.newMessagePage.firstname") }} : {{ @Auth::user()->name }}
                <span style="color: red;font-size: 14px;">({{ __("message.newMessagePage.Necessary") }})</span>
            </h6>
            <input onkeydown="return IsAlphaNumeric(event,this)"
            onfocus="changeborder(this,0,0);" value="{{old('name',@Auth::user()->name) }}"
            @if (@Auth::user()->name!="")
            hidden
            @endif
            class="form-control" type="text" name="name" id="name">
        </div>
        <div class="col-sm-4">
            <h6>{{ __("message.newMessagePage.phone") }} : {{ @Auth::user()->phone }}
                <span style="color: red;font-size: 14px;">({{ __("message.newMessagePage.Necessary") }})</span>
            </h6>
            <input type="number" onKeyPress="return changeborder(this,10,0);"
            onkeyup="return changeborder(this,10,0);" onkeydown="deleteziro(this);"
            @if (@Auth::user()->phone!="")
                hidden
            @endif
            onfocus="changeborder(this,10,0);" onfocusout="deleteziro(this);" value="{{ old('phone',@Auth::user()->phone) }}" class="form-control" type="text" name="phone" id="phone">
        </div>
        <div class="col-sm-4">
            <h6>{{ __("message.newMessagePage.natoinalcode") }} : {{ @Auth::user()->meli_code }}
                <span style="color: red;font-size: 14px;">({{ __("message.newMessagePage.Necessary") }})</span>
            </h6>
            <input type="number" onKeyPress="return changeborder(this,10,0);"
            onkeyup="return changeborder(this,10,0);"
            @if (@Auth::user()->meli_code!="")
            hidden
            @endif
            onfocus="changeborder(this,10,0);" value="{{ old('username',@Auth::user()->meli_code) }}" class="form-control" type="text" name="username" id="username">
        </div>
        <div class="col-sm-4">
            <h6>{{ __("message.newMessagePage.orderSubject") }}
                <span style="color: red;font-size: 14px;">({{ __("message.newMessagePage.Necessary") }})</span>
            </h6>
            <select class="form-control h6" id="suborder" name='suborder' onclick="changeborder(this,0,0);">
                <option value=''>{{ __("message.newMessagePage.selectFirstOpsion") }}</option>
                @foreach ($suborder as $item)
                <option  @if (old('suborder')==$item->suborder->id)
                    selected
                @endif value="{{ $item->suborder->id }}">{{ $item->suborder->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 pt-5">
            <h6>{{ __("message.newMessagePage.BodyMessage") }}
                <span  style="color: red;font-size: 14px;">({{ __("message.newMessagePage.Necessary") }})</span>
            </h6>
            <textarea onkeyup="changeborder(this,5,0);" onkeypress="changeborder(this,10,0);" onfocus="changeborder(this,10,0);" id="text" name="text" class="form-control" aria-required="true" aria-invalid="false" rows="6" >{{ old('text') }}</textarea>
        </div>

        <div class="col-sm-4 pt-5">
            <h6>{{ __("message.newMessagePage.titleUploadFile") }}</h6>
            <div class="mx-auto border border-dark mx-auto m-2 text-center align-center" style="height: 100%;width: 100%;max-height: 155px;">
                <input type="text" name="filepath" id="filepath" hidden>
                <div class="divchooser" id="divfilechooser">
                    <input type="file" id="file_upload" style="opacity: 0;height: 100%;width: 100%;" onchange="uploadFiles();"/>
                </div>
                <h6 id="titleUploadfile" hidden>{{ __("message.newMessagePage.onUploadFile") }}</h6>
                <button id="btnloadfile" class="btn btn-primary mx-auto" type="button" disabled hidden>
                    {{ __("message.newMessagePage.onUpload") }}
                    <span class="spinner-border spinner-border-sm" ></span>
                </button>
                <button id="btnsuccessfile" type="button" class="btn btn-outline-success btn-rounded waves-effect" disabled hidden>
                    {{ __("message.newMessagePage.UploadSuccess") }}
                </button>
                <button id="btndeletefile" type="button" class="btn btn-outline-danger" hidden>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                    </svg>
                    {{ __("message.newMessagePage.deletFile") }}
                </button>

            </div>
        </div>
        <div class="col-sm-4 pt-5">
            <h6>{{ __("message.newMessagePage.titleUploadVoice") }}</h6>
            <div class="mx-auto border border-dark mx-auto text-center align-center" style="height: 100%;width: 100%;max-height: 155px;">
                <input type="text" name="audiopath" id="audiopath" hidden>
                <div class="divchooser2" id="divaudiochooser">
                    <input type="file" id="audio_upload" style="opacity: 0;height: 100%;width: 100%;"  accept="audio/*" capture="microphone"  onchange="uploadaudios();"/>
                </div>
                <h6 id="titleUploadaudio" hidden>{{ __("message.newMessagePage.onUploadVoice") }}</h6>
                <button id="btnloadaudio" class="btn btn-primary mx-auto" type="button" disabled hidden>
                    {{ __("message.newMessagePage.onUpload") }}
                    <span class="spinner-border spinner-border-sm" ></span>
                </button>
                <button id="btnsuccessaudio" type="button" class="btn btn-outline-success btn-rounded waves-effect" disabled hidden>
                    {{ __("message.newMessagePage.UploadSuccess") }}
                </button>
                <button id="btndeleteaudio" type="button" class="btn btn-outline-danger" hidden>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
                    </svg>
                    {{ __("message.newMessagePage.deleteVoice") }}
                </button>

            </div>
        </div>

    </div>

    <div class="mx-auto text-center pt-2">
        @guest
            <div class="col pt-5 mx-auto">
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!}
            </div>

        @endguest
        <button id="addbtn" type="button" onclick="submitfun()" class="btn btn-primary mx-auto mb-5" disabled>{{ __("message.newMessagePage.addButton") }}</button>
    </div>
   </div>
</form>

<script>
    var textaudio = "{{old('audiopath')}}";
    audiouploaded(textaudio);
    var textfile = "{{old('filepath')}}";
    fileuploaded(textfile);
    function submitfun(){
        @guest()
        let capchaRES=document.getElementById('g-recaptcha-response');
        if(capchaRES.value!=''){
            if(confirm('{{ __("message.newMessagePage.confrimAddButtonText") }}')){formnewticket.submit()}
        }else{
            toast_dialog_error('{{ __("message.newMessagePage.capchaError") }}');
        }
        @else
        if(confirm('{{ __("message.newMessagePage.confrimAddButtonText") }}')){formnewticket.submit()}

        @endguest



    }
    function IsAlphaNumeric(e,value) {
    changeborder(value,0,0);
        var x = event.key;
        x=x.charCodeAt(0);
        // alert(x);
        // var ra=document.getElementById('nickname');
        // var r=ra.value;
            var persianchar=[32,66,68,84,92,247,96,1590,1589,
            1579,1602,1601,1594,1593,1607,1582,1581,
            1580,1670,1662,1588,1587,1740,1576,1604,1575,
            1578,1606,1605,1705,1711,1592,1591,1586,1585,
            1584,1583,1574,1608,1569,1688];

            var target = persianchar.find(item =>item==x);
            if(target){
            return true;
            }
            return false;

}
    function changeborder($item,$max,$min){
        let check=false;
        $item.style="border: 1px solid #ddd;";

        if($max<=0){
            if($item.value.length>=1){
                $item.style="border: 1px solid #ddd;";
                check= true;
            }else{
                $item.style="border: 1px solid #ff0000;";
                check= true;
            }

        }else{
            if(($item.value.length+1)<=($max)){
                $item.style="border: 1px solid #ff0000;";
                check= true;
            }


        }
        activeBTNadd();
                return check;

}
    function deleteziro(item){
        let val=item.value;
        if(val.length>0&&val[0]==0){
            val=val.substring(1);
        }
        item.value=val;
    }

    document.getElementById("g-recaptcha-response").addEventListener("click", function() {
  alert("Hello World!");
});


function activeBTNadd(){

    let username=document.getElementById('username');
    let text=document.getElementById('text');
    let phone=document.getElementById('phone');
    deleteziro(phone);
    let name=document.getElementById('name');
    let suborder=document.getElementById('suborder');
    let addbtn=document.getElementById('addbtn');
    if(name.value.length>2&&text.value.length>4&&
    name.value.length>2&&phone.value.length==10&&
    username.value.length==10&&suborder.value!=""){
        addbtn.disabled=false;
    }else{
        addbtn.disabled=true;
    }
}

</script>
@endsection
