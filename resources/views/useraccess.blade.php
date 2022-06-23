@extends('headerAndFooter')
@section('body')

<div class="row mx-auto p-5" style="text-align: center;">
    <div class="col-sm-3 mx-auto">
        <a href="{{ route('adduseraccess') }}" class="btn btn-primary">{{ __('message.userَAccessPage.textAdduserAccessButton') }}</a>
    </div>
</div>


    <div class=" row mx-auto">

        <table style="text-align: center;" class="table table-striped">
            <thead class="thead-dark">
                <tr style="text-align: center;">

                    @foreach (__('message.userَAccessPage.table') as $key=>$item)
                    <th style="text-align: center;" scope="col">{{ $item}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $x=1;
                @endphp
                @foreach ($get as $useraccess)
                <tr>
                    <td>{{$x}}</td>
                    <td>{{$useraccess->title}}</td>
                    <td>{{__('message.allpage')[$useraccess->homepage]}}</td>
                    <td>
                        <button class="btn btn-info">
                            <a style="color: white;" href="{{route('edituseraccess',$useraccess->id)}}">{{ __('message.userَAccessPage.textEditButton') }}</a>
                        </button>
                </td>


                @php
                    $x++;
                @endphp
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>










@endsection
