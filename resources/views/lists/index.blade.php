@extends('layouts.app')
@section('content')

    <div class="section-header">
        <h1>List</h1>

    </div>

    <div class="section-body">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">

                <a href="#" class="text-decoration-none" data-toggle="modal" data-target="#exampleModal">
                    <div class="card">
                        <div class="card-body justify-content-center">
                            <h6 class="card-title">Create New List</h6>
                        </div>
                    </div>
                </a>

                <!-- Modal -->


            </div>
            @if(is_array($lists) || is_object($lists))
                @foreach($lists as $list)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-wrap">
                                <div class="card-body py-2"  >
                                    <h6>{{$list->name ?? ""}}</h6>
                                    <a href="{{route('list.show',$list->id)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>


    </div>


@endsection
@section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create List</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('list.store')}}" class="ajaxform_with_redirect" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="boardId" value="{{$id}}">
                            <input type="text" required name="name" class="form-control" placeholder="Enter List Name">
                        </div>
                        <button type="submit" class="btn btn-primary basicbtn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
