@extends('layouts.app')
@section('content')

<div class="section-header">
    <h1>Board</h1>

</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <a href="{{route('boards.create')}}" class="text-decoration-none">
                <div class="card card-statistic-1">
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Create New Board</h4>
                        </div>
                        <div class="card-body" id="total_customers">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @if(is_array($boards) || is_object($boards))
            @foreach($boards as $board)
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-wrap">
                            <div class="card-body py-2"  >
                                <h6>{{$board->name ?? ""}}</h6>
                                <p>{{$board->desc ?? ''}}</p>
                                <a href="{{route('boards.show',$board->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                 <a href="{{route('boards.edit',$board->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                 <a href="javascript:void(0)"
                                    class="btn btn-danger delete-confirm"
                                    data-action={{ route('boards.destroy', $board->id) }} ><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>


</div>
@endsection
