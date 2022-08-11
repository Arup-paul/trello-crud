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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.style')
    <style>
        textarea#description{
            height: 200px;
        }
    </style>


</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">

            </form>
            <ul class="navbar-nav navbar-right">
                <li ><a href="{{route('logout')}}"   class="nav-link   nav-link-lg nav-link-user">
                        Logout</a>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="#">{{env('APP_NAME')}}</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="#"{{env('APP_NAME')}}</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">WORK SPACE</li>
                    @if (is_array($organizations) || is_object($organizations))
                        @foreach($organizations  as $organization)
                    <li class="@if(route('board',$organization->id) === url()->current()) active @endif">
                        <a class="nav-link " href="{{route('board',$organization->id)}}">
                            <i class="fas fa-fire"></i>
                            <span> {{$organization->displayName}}</span>
                        </a>
                    </li>
                       @endforeach
                    @else
                        <li><a href="#">No Workspace Here</a></li>
                    @endif

                </ul>

            </aside>
        </div>

        <div class="main-content">
            <section class="section">
              @yield('content')
            </section>
        </div>

    </div>
</div>
@yield('modal')
@include('layouts.script');
</body>
</html>
