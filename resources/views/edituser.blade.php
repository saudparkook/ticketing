@extends('headerAndFooter')
@section('body')
{{-- <script src="{{ url('assets/select2/ajax.js') }}" type="text/javascript"></script> --}}

<div class="row">

  <div class="container col-sm-6 mt-5 mb-5">
    <div class="centerhorzental row  border border-dark rounded">

        <div class="col-sm-10 mt-3">
            <h3 class="text-center">

                    {{ __('message.editUserPage.title') }}

            </h3>
        </div>
        <form id="myForm" class="centerhorzental "
         method="POST" action="{{route('editprofile',$user->id)}}" enctype="multipart/form-data">
         @method('PUT')
            @csrf
            <div class="col-sm-10 text-center">

              <div class="input-group pt-4">
                <a class="col flex-d h5 pt-4 text-black text-left">
                    {{ __('message.editUserPage.username') }}
                </a>
                <input type="text" style="background-color: #dadada;"
                value="{{$user->username}}"
                class="form-control h5" id="username"
                placeholder="{{ __('message.editUserPage.username') }}"
                name="username" disabled>
            </div>
            <div class="input-group pt-3">
                <a class="col flex-d pt-4 h5 text-black text-left">
                    {{ __('message.editUserPage.natoinalcode') }}
                </a>
                <input type="text"
                value="{{$user->meli_code}}"
                class="form-control h5" id="meli_code" placeholder="{{ __('message.editUserPage.natoinalcode') }}" onkeypress="clsAlphaNoOnly(event)"
                 name="meli_code">
            </div>
            @if (array_search("useraccess",$rollconfig)&&array_search("changeoderuser",$rollconfig))
                <div class="input-group pt-3">
                    <a class="col flex-d h5 pt-4 text-black text-left">
                        {{ __('message.editUserPage.usertype') }}
                    </a>
                    <select class="form-control h5" id="role" name='role'>
                      <option >{{ __('message.editUserPage.selectFirstOpsion') }}</option>
                      @foreach ($userAccess as $item)
                      <option value="{{ $item->id }}"  @if ($user->access==$item->id)
                        selected
                        @endif>{{ $item->title }}</option>
                      @endforeach


                  </select>
                </div>
                @endif
                <div class="input-group pt-3">
                  <a class="col flex-d pt-4 h5 text-black text-left">
                    {{ __('message.editUserPage.firstname') }}
                  </a>
                  <input type="text"
                  value="{{$user->name}}"
                  class="form-control h5" id="name" placeholder="{{ __('message.editUserPage.firstname') }}"
                  name="name">
              </div>
                <div class="input-group pt-3">
                  <a class="col flex-d pt-4 h5 text-black text-left">
                    {{ __('message.editUserPage.phone') }}
                  </a>
                  <input type="text"
                  value="{{$user->phone}}"
                  class="form-control h5" id="phone" placeholder="{{ __('message.editUserPage.phone') }}"
                  name="phone">
              </div>

                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.editUserPage.password') }}
                    </a>
                    <input type="password"
                    class="form-control h5" id="pwd" placeholder="{{ __('message.editUserPage.password') }}"
                      name="password">
                </div>

                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.editUserPage.confrimPassword') }}
                    </a>
                    <input type="password"
                    class="form-control h5" id="password_confirmation "
                     placeholder="{{ __('message.editUserPage.confrimPassword') }}" name="password_confirmation">
                </div>
                <div class="input-group pt-3">
                    <div class="form-check form-switch mx-auto">
                        <input class="form-check-input h5 text-black " type="checkbox" id="sms" name="sms"
                        @if ($user->sms==1)
                        checked
                        @endif
                        >
                        <label class="form-check-label h5 text-black " for="sms">{{ __('message.editUserPage.reciveSms') }}</label>
                    </div>
                </div>


            </div>
           <div class="row mx-auto pt-3">
            <button type="button" onclick="submitform();"
            class="btn m-2 btn-info text-white h5 mx-auto">{{ __('message.editUserPage.editButton') }}</button>
           <a
           @if (url()->previous()==route('editprofile',$user->id))
           href="{{ route('dashbord') }}"
           @else
              href="{{ url()->previous() }}"
           @endif
            class="btn btn-primary m-2 mb-4 h5 mx-auto">{{ __('message.editUserPage.backButton') }}</a>
           </div>
        </form>
    </div>
</div>

</div>


    <script>

function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}


             function submitform() {
              if(confirm('{{ __('message.editUserPage.confrimEditButtonText') }}')){
                var form=document.getElementById("myForm");
              form.submit();
              }


          }

    </script>


@endsection

