@extends('layouts.app')
@section('content')
    <div class="section-header">
        <h1>Create New Board</h1>

    </div>

    <div class="section-body">
       <div class="row">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('boards.store')}}" class="ajaxform" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="board_name" class="form-label">Board Name</label>
                                <input type="text" name="name"   class="form-control" placeholder="Enter Board Name" id="board_name" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" placeholder="Enter Description"   class="form-control custom-textarea" cols="10" rows="5"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary basicbtn">Create</button>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>

@endsection
