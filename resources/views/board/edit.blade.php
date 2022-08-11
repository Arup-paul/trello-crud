@extends('layouts.app')
@section('content')
    <div class="section-header">
        <h1>Update Board</h1>

    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
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
            </div>
        </div>
    </div>

@endsection
