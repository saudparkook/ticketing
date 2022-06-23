@extends('headerAndFooter')
@section('body')
<div class="row">
  <div class="container col-sm-6 mt-5 mb-5">
    <div class="centerhorzental row  border border-dark rounded">
        <div class="col-sm-10 mt-3">
            <h3 class="text-center">
                {{ __('message.addUserPage.title') }}
            </h3>
        </div>
        <form id="myForm" class=" mx-auto "
         method="POST" action="{{route('adduser')}}" enctype="multipart/form-data" >

            @csrf
            <div class="col-sm-10 text-center mx-auto">


                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.usertype') }}
                    </a>
                    <select class="form-control h5" id="role" name='role'>
                      <option >{{ __('message.addUserPage.selectFirstOpsion') }}</option>
                      @foreach ($userAccess as $item)
                      <option value="{{ $item->id }}">{{ $item->title }}</option>
                      @endforeach

                  </select>
                </div>
                <div class="input-group pt-3">
                  <a class="col flex-d pt-4 h5 text-black text-left">
                    {{ __('message.addUserPage.firstname') }}
                  </a>
                  <input type="text"
                  @if (old('name'))
                  value="{{old('name')}}"
                  @endif
                  class="form-control h5" id="name" placeholder="{{ __('message.addUserPage.firstname') }}"
                  name="name">
              </div>
                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.username') }}
                    </a>
                    <input type="text"
                    @if(old('username'))
                    value="{{old('username')}}"
                    @endif
                    class="form-control h5" id="username" placeholder="{{ __('message.addUserPage.username') }}"
                     name="username">
                </div>
                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.natoinalcode') }}
                    </a>
                    <input type="text"
                    @if(old('meli_code'))
                    value="{{old('meli_code')}}"
                    @endif
                    class="form-control h5" id="meli_code" placeholder="{{ __('message.addUserPage.natoinalcode') }}" onkeypress="clsAlphaNoOnly(event)"
                     name="meli_code">
                </div>
                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.phone') }}
                    </a>
                    <input type="text"
                    @if(old('phone'))
                    value="{{old('phone')}}"
                    @endif
                    class="form-control h5" id="phone" placeholder="{{ __('message.addUserPage.phone') }}" onkeypress="clsAlphaNoOnly(event)"
                     name="phone">
                </div>

                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.password') }}
                    </a>
                    <input type="password"
                    value="{{old('password')}}"
                    class="form-control h5" id="pwd" placeholder="{{ __('message.addUserPage.password') }}"
                      name="password">
                </div>

                <div class="input-group pt-3">
                    <a class="col flex-d pt-4 h5 text-black text-left">
                        {{ __('message.addUserPage.confrimPassword') }}
                    </a>
                    <input type="password"
                    value="{{old('password_confirmation')}}"
                    class="form-control h5" id="password_confirmation "
                     placeholder="{{ __('message.addUserPage.confrimPassword') }}" name="password_confirmation">
                </div>
                <div class="input-group pt-3">
                    <div class="form-check form-switch mx-auto">
                        <input class="form-check-input h5 text-black " type="checkbox" id="sms" name="sms"
                        checked
                        >
                        <label class="form-check-label h5 text-black " for="sms">{{ __('message.addUserPage.reciveSms') }}</label>
                    </div>
                </div>

                 <button type="button" onclick="refsubmit()";
                  class="btn mt-4 btn-success h5 mx-auto"> {{ __('message.addUserPage.addButton') }} </button>
                 <a type="button" href="{{ route('dashbord') }}"
                  class="btn mt-4 btn-primary h5 mx-auto"> {{ __('message.addUserPage.backButton') }} </a>
            </div>

        </form>
    </div>
</div>


</div>



<script>


  function refsubmit(){
    if(confirm('{{ __('message.addUserPage.confrimAddButtonText') }}')){
    var form=document.getElementById("myForm");
              form.submit();

    }
}

function clsAlphaNoOnly (e) {  // Accept only alpha numerics, no special characters
    var regex = new RegExp("^[a-zA-Z0-9 ]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }

    e.preventDefault();
    return false;
}

</script>

    @endsection
