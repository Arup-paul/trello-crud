@extends('layout')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Update Board</h1>
        </div>

        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="{{route('boards.update',$board->id)}}" class="ajaxform_without_reset" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="board_name" class="form-label">Board Name</label>
                        <input type="text" name="name"   class="form-control" value="{{$board->name}}" id="board_name" >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" placeholder="Enter Description"   class="form-control" cols="10" rows="5">{{$board->desc}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary basicbtn">Update</button>
                </form>
            </div>

        </div>

    </main>
@endsection
