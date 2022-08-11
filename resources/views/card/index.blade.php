@extends('layouts.app')
@section('content')

    <div class="section-header">
        <h1>Card Details</h1>

    </div>

    <div class="section-body">
        <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
               <div class="card-wrap">
                   <div class="card-body py-2"  >
                     @if($card->name) <h6><strong>Name:</strong>{{$card->name ?? ""}}</h6> @endif
                      @if($card->desc)<p>{{$card->desc ?? ""}}</p>@endif

                       </div>
                  </div>
               </div>
           </div>
        </div>

    </div>


@endsection


