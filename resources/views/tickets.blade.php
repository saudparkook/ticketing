@extends('headerAndFooter')
@section('body')
<div class="row pt-5">
    <h4 class="text-center">
        {{ __('message.ticketsPage.title') }}
    </h4>
</div>
<div class="row mt-2 mx-auto pt-4 pb-4 border border-dark shadow" style="text-align: center;">


<div class="col pt-4 pb-4 ">
    <div class="col-sm-5 mx-auto">
        <input type="text" class="form-control text-center col-sm-7" placeholder="{{ __('message.ticketsPage.placeholderShowFromCode') }}" name="code" id="code">
            <button type="button" onclick="ticketsubmit(code)"
            class="btn btn-success mx-auto mr-5 ml-5 p-2 mt-3 col-sm-3">{{ __('message.ticketsPage.ShowFromCodeButton') }}</button>
    </div>

</div>
</div>
@auth
<div class="row mt-4 mx-auto pt-4 pb-4 border border-dark shadow table-responsive" style="text-align: center;">
    @if (array_search('allmessages',$rollconfig))
    <form action="{{ route('tickets') }}">
        <div class="col-sm-5 mx-auto">
            <div class="input-group">
                <input type="text" value="{{ $search }}" class="form-control text-center " placeholder="{{ __('message.ticketsPage.placeholderSearch') }}" name="search" id="search">
                <select name="typestatus" id="typestatus" class="form-control text-center ">
                    @foreach (__('message.ticketsPage.typestatus') as $key=>$item)
                    <option
                    @if ($request['typestatus']==$key)
                        selected
                    @endif
                     value="{{$key}}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
            class="btn btn-primary mx-auto mr-5 ml-5 p-2 mt-2 mb-3 col-sm-3">جستجو</button>
        </div>
    </form>
    @endif
    <table style="text-align: center;" class="table table-striped">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                @foreach (__('message.ticketsPage.table') as $key=>$item)
                <th style="text-align: center;" scope="col">{{ $item}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $pc=20;
                    $x=($tickets->currentPage()*$pc)-($pc-1);

            @endphp
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{$x}}</td>
                <td>{{$ticket->getorder->name}}</td>
                <td>{{$ticket->getuser->name}}</td>
                <td>{{$ticket->code}}</td>
                <td>
                    @if ($ticket->status>=0)
                    {{ __('message.ticketsPage.typestatus')[($ticket->status+1)] }}
                    @elseif($ticket->status<0)
                        <b class="text-danger">{{ __('message.ticketsPage.typestatus')['4'] }}</b>
                    @endif

                </td>
                <td>
                    {{ $ticket->messages->count() }}
                </td>
                <td>
                    <a target="showticket" class="btn btn-primary" href="{{ route('showticket',$ticket->code) }}" role="button">مشاهده</a>
                    @if($ticket->status>=0)
                        <button class="btn btn-warning" onclick="refhref('{{ route('cancelMessage',$ticket) }}','آیا مایل به بستن این تیکت هستید؟')"  role="button">بستن تیکت</button>
                    @endif
                </td>

            @php
                $x++;
            @endphp
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@if (count($tickets)>0)
<div class="row mx-auto mt-2 mb-10" >
    <div class="col-lg mx-auto">
        @if ($tickets->previousPageUrl()!='')
            <a class="btn btn-primary" href="{{ $tickets->previousPageUrl() }}">قبلی</a>
        @endif
        @if ($tickets->currentPage()-1>=1)
        <a class="btn btn-primary" href="{{ $tickets->previousPageUrl() }}">{{ $tickets->currentPage()-1 }}</a>
        @endif
        <a class="btn btn-white" >صفحه : {{ $tickets->currentPage() }}</a>

        @if (($tickets->currentPage()+1)<=($tickets->total()/$pc))
        <a class="btn btn-primary" href="{{ $tickets->nextPageUrl() }}">{{ $tickets->currentPage()+1 }}</a>
        @endif

        @if ($tickets->nextPageUrl()!='')
        <a class="btn btn-primary" href="{{ $tickets->nextPageUrl() }}">بعدی</a>
        @endif

    </div>
    <div class="col-lg mx-auto">
        تمام  آیتم ها  : {{ $tickets->total()  }}

    </div>

</div>
<br>
@endif
@endauth


@endsection
