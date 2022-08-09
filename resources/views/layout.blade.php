@php
        $data = \Illuminate\Support\Facades\Session::get('data');
        if($data){
         $url = 'https://api.trello.com/1/members/'.$data['user_id'].'/organizations?key='.$data['api_key'].'&token='.$data['api_token'];

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, 0);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

           $response = curl_exec ($ch);
           $err = curl_error($ch);  //if you need
           curl_close ($ch);
           $organizations =  $response ? json_decode($response) : [];
        }else{
            $organizations = [];
        }

@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Trello Board</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->

    <!-- Custom styles for this template -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">{{env('APP_NAME')}}</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="#">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3 sidebar-sticky">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span>Work Space</span>
                </h6>
                <ul class="nav flex-column">
                    @if (is_array($organizations) || is_object($organizations))
                    @foreach($organizations  as $organization)
                        <li class="nav-item">
                            <a class="nav-link @if(route('board',$organization->id) === url()->current()) active @endif" aria-current="page" href="{{route('board',$organization->id)}}">
                               {{$organization->displayName}}
                            </a>
                        </li>
                    @endforeach
                   @endif
                </ul>

            </div>
        </nav>

        @yield('content')
    </div>
</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/form.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>

