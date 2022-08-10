@extends('layout')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">List</h1>
        </div>

        <div class="row">
            @if (is_array($lists) || is_object($lists))
            @foreach($lists as $list)
                <div class="col-4 py-2">
                    <a href="{{route('list.show',$list->id)}}" >
                        <div class="card bg-secondary">
                            <div class="card-body">
                                <h6 class="card-title text-white ">{{$list->name ?? ""}}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            @endif
                <div class="col-4 py-2">

                    <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="card">
                            <div class="card-body justify-content-center">
                                <h6 class="card-title">Create New List</h6>
                            </div>
                        </div>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

                </div>
        </div>
    </main>
@endsection
