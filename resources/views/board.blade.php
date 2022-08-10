@extends('layout')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Board</h1>
        </div>

            <div class="row">
                <div class="col-4 py-2">
                        <a href="{{route('boards.create')}}" class="text-decoration-none">
                            <div class="card">
                                <div class="card-body justify-content-center">
                                    <h6 class="card-title">Create New Board</h6>
                                </div>
                            </div>
                        </a>
                </div>
                @if(is_array($boards) || is_object($boards))
                    @foreach($boards as $board)
                     <div class="col-4 py-2">
                             <div class="card bg-success">
                                 <div class="card-body">
                                     <h6 class="card-title text-white ">{{$board->name ?? ""}}</h6>
                                     <p class="card-text text-white">{{$board->desc ?? ''}}</p>
                                     <a href="{{route('boards.show',$board->id)}}" class="btn btn-info">View</a>
                                     <a href="{{route('boards.edit',$board->id)}}" class="btn btn-primary">Edit</a>
                                     <a href="javascript:void(0)"
                                        class="btn btn-danger delete-confirm"
                                        data-action={{ route('boards.destroy', $board->id) }} >Delete</a>
                                 </div>
                             </div>
                     </div>
                    @endforeach
              @endif
            </div>
    </main>
@endsection
