@extends('welcome')

@section('content')
    <div class="justify-center text-center align-items:center">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card trello-area">
                        <div class="card-body">
                            <h2>Trello Authorization</h2>
                            @if(Session::has('message'))
                                <p class="alert alert-danger">{{ Session::get('message') }}</p>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" required name="api_key" class="form-control" placeholder="Enter Api Key">
                                </div>
                                <div class="mb-3">
                                    <input type="text" required name="api_token" class="form-control"  placeholder="Enter Api Token">
                                </div>
                                <button type="submit" class="btn btn-primary">Authorization</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
