<!doctype html>
<html>
    <head>
        <title>Dashboard - @yield('title')</title>
        @include('layouts.styles')

        <style>
            #main {
                /* background-color: blue; */
            }

            #sidebar {
                width: 20%; 
                /* background-color: green; */
            } 
            #content{
                width: 80%; 
                /* background-color: green; */
            }
            /* style="width: 20%; background-color:red;" */
        </style>
    </head>
<body class="skin-blue sidebar-mini">

    <div class="container">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <header class="row">
            @include('layouts.header')
        </header>

        <div id="main" class="row">
             <!-- sidebar content -->
            <div id="sidebar" class="col-sm-4">
                @include('layouts.sidebar')
            </div> 
           
            
            <!-- main content -->
            <div id="content" class="col-sm-8">
                <div>
                    @yield('message')
                </div>
                
                <!-- Breadcrumb -->
                <div>
                    @yield('breadcrumb')
                </div>

                <div>
                    @yield('content')
                </div>

                <div>
                    @yield('schematable')
                </div>
            </div>

            
        </div>

    </div>

     @include('layouts.scripts')
     
    </body>
</html>