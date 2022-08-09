@extends('layout')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Card Details</h1>
        </div>

        <div class="row">
            <div class="card" style="width:400px">
                <div class="card-body">
                   @if($card->name)
                        <h6 class="card-title"><Storng>Name:</Storng>{{$card->name ?? ""}}</h6>
                    @endif
                    @if($card->desc)
                    <p class="card-text"><Strong>Description:</Strong>{{$card->desc ?? ""}}</p>
                        @endif
                </div>
            </div>
        </div>
    </main>
@endsection
