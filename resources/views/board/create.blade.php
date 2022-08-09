@extends('layout')
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Create New Board</h1>
        </div>

        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="{{route('boards.store')}}" class="ajaxform" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="board_name" class="form-label">Board Name</label>
                        <input type="text" name="name"   class="form-control" placeholder="Enter Board Name" id="board_name" >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" placeholder="Enter Description"   class="form-control" cols="10" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary basicbtn">Create</button>
                </form>
            </div>

        </div>

    </main>
@endsection
