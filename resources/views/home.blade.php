@extends('headerAndFooter')
@section('body')

    <div  class="row shadow border border-1 mx-auto rounded mt-3">

        @foreach (__('message.dashborditem') as $key=>$item)

        @if (array_search($key,$rollconfig))
            <div class="col-sm-5 mx-auto text-center m-4 p-4">
               <a class="btn text-dark" href="{{ route($key) }}">
                <div class="input-group mx-auto text-center">
                    <div class="col mx-auto text-center">
                        <img class="img-fluid" width="100" src="{{ url($item[0]) }}" alt="">
                        <h4>
                            {{ $item[1] }}
                        </h4>
                    </div>
                    <div class="col mx-auto text-center my-auto">
                        <h6>
                            <b>
                                {{ $item[2] }}
                            </b>
                        </h6>
                    </div>

                </div>
               </a>
            </div>
        @endif
        <br>
        @endforeach


    </div>

    @endsection
