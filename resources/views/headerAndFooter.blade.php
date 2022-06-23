<!DOCTYPE html>
<html lang="fa" dir="{{ __('setting.rtl') }}"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
@font-face {
  font-family: iransans;
  src: url({{ url('fonts/isw.ttf') }});
}
*{
    font-family: iransans;
}
.header {
    background-size: cover;
    background-position: center center;
    background-color: {{$setting["startheader"]}}; /* For browsers that do not support gradients */
    background-image: linear-gradient({{$setting["startheader"]}}, {{$setting["endheader"]}});
}



.a-tag{
    color: #000000;
    text-decoration: none !important;
    font-weight: bold;
    margin-right: 15px;
}
.a-tag2{
    color: #000000;
    text-decoration: none !important;
    font-weight: bold;
    margin-left: 15px;
}
.astyle{
    background-color: #00000013;
    color: #021ec0;
    text-decoration: none !important;
    font-weight: bold;
}
 .footerclass{
    background-image: url("{{ url('images/footer.png') }}");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
   }
   .vertical-center {
  min-height: 450px;  /* Fallback for browsers do NOT support vh unit */
  align-items: center;
}
</style>
<script>
    function toast_dialog_error(txt){
        Swal.fire({
            html: txt,
            icon: "error",
            confirmButtonText : "{{ __('message.confirmButtonText') }}",
            buttonsStyling: false,
            customClass : {
                confirmButton: "btn font-weight-bold btn-primary"
            }
        });
    }
    function toast_dialog(txt){
        Swal.fire({
            text: txt,
            icon: "success",
            confirmButtonText : "{{ __('message.confirmButtonText') }}",
            buttonsStyling: false,
            customClass : {
                confirmButton: "btn font-weight-bold btn-primary"
            }
        });
    }

    function refhref(link,message){
        if(confirm(message))
        {
            location.href=link;
        }
    }
    function ticketsubmit(element){
        link='{{ url('showticket') }}/'+element.value;
        window.open(link);


    }
    function changevalue(item,message){
        item.innerHTML=message;
    }
    </script>
</head>
<body>
<div class="header">
    {{-- start mobile menu --}}
    <div  class="header-mobile align-items-center header-mobile-fixed d-block d-sm-none" >
        <nav class="navbar navbar-light fixed-top header">
            <div class="container-fluid">
                <div class="col">
                    <a class="my-auto astyle rounded p-2 display-h6"   href="{{ route('dashbord') }}" >{{ __('message.textHomeButton') }}</a>

                </div>
                <a class="navbar-brand header" href="#">
                <img width="45" src="{{ url(RollConfig::imageForHeader) }}" alt="">
              </a>
              <div class="col" dir="{{ __('setting.ltr') }}">
                <button class="navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                  </button>
              </div>
              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasNavbarLabel">THA holding</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="{{ __('message.hedearMenu')[0][2]['href'] }}">{{ __('message.hedearMenu')[0][2]['text'] }}</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ __('message.hedearMenu')[0][3]['href'] }}">{{ __('message.hedearMenu')[0][3]['text'] }}</a>
                    </li>

                  </ul>
                  <form class="d-flex pt-2 mb-2">
                    <input name="searchcode" id="searchcode" class="form-control me-2" type="search" placeholder="{{ __('message.placeholderSearch') }}" aria-label="Search">
                    <button class="btn btn-outline-success" onclick="ticketsubmit(searchcode)">{{ __('message.searchButton') }}</button>
                  </form>
                  @if (Auth::guest())
                      <a class="btn btn-primary mt-2 mx-auto" href="{{ route('login')}}">{{ __('message.loginButtonText') }}</a>

                  @else
                    <div class="input-group my-auto">
                            <b class=" m-3 my-auto">{{ Auth::user()->name }}</b>
                            <a href="{{ route('editprofile',Auth::user()->id)}}" class="btn btn-primary m-3 my-auto">{{ __('message.textUserEditButton') }}</a>

                            <form id="exitform" class=" p-3 my-auto" action="{{ route('logout')}}" method="post">
                                @csrf
                                <button type="button" onclick="if(confirm('{{ __('message.confrimExitButtonText') }}')){exitform.submit()}" class="btn btn-danger mx-auto my-auto">{{ __('message.exitButtonText') }}</button>
                            </form>
                    </div>

                  @endif
                </div>
              </div>
            </div>
          </nav>

    </div>
    {{-- end mobile menu --}}
    <div class="d-flex flex-column flex-root d-none d-sm-block ">
            @guest
                <div class="input-group">
                    <div  class="col my-auto text-center">
                            @foreach (__('message.hedearMenu')[1] as $item)
                            <a style="{{ $item['style'] }}" class="{{ $item['class'] }}" href="{{ $item['href'] }}" >{{ $item['text'] }}</a>
                            @endforeach

                    </div>
                    <div class="text-center mx-auto">
                        <img width="140" class="mx-auto m-2" src="{{ url(RollConfig::imageForHeader) }}" alt="">
                    </div>
                    <div class="col my-auto text-center">
                        <div class="input-group">
                            @foreach (__('message.hedearMenu')[0] as $item)
                            <a style="{{ $item['style'] }}" class="{{ $item['class'] }}" href="{{ $item['href'] }}" >{{ $item['text'] }}</a>
                            @endforeach
                        </div>

                    </div>
                </div>
            @else
                <div class="input-group">
                    <div  class="col my-auto " style="margin-right: 150px;">

                            <a class="a-tag my-auto astyle rounded p-2 " href="{{ route('dashbord') }}" >{{ __('message.textHomeButton') }}</a>

                    </div>
                    <div class="text-center mx-auto">
                        <img width="140" class="mx-auto m-2" src="{{ url(RollConfig::imageForHeader) }}" alt="">
                    </div>
                    <div class="col my-auto">
                        <div class="list-group list-group-horizontal-sm float-start " style="padding-left: 150px;">

                                <a class=" a-tag my-auto btn btn-primary text-white"
                                href="{{ route('editprofile',Auth::user()->id)}}" >{{ __('message.textUserEditButton') }}</a>
                                <a class="a-tag my-auto">
                                    <form id="exitformpc" action="{{ route('logout')}}" method="post">
                                    @csrf
                                    <button type="button" onclick="if(confirm('{{ __('message.confrimExitButtonText') }}')){exitformpc.submit()}" class="btn btn-danger">{{ __('message.exitButtonText') }}</button>
                                    </form>
                                </a>
                        </div>

                    </div>
                </div>
            @endguest
    </div>
</div>
    @include('error')
    <div class="container mx-auto mt-5">

        @yield('body')

    </div>

    <br>
    <br>

    @guest
    @php
        echo __('footer.footer');
    @endphp
    @endguest

        </body>
        </html>
