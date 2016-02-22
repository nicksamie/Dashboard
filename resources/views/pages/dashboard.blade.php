@extends('layouts.master')

@section('title', 'Dashboard')

@section('breadcrumb')
	<section class="content-header">
		
          <ol class="breadcrumb">
            <li><a href="{{URL::to('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
    </section>
@stop

@section('content')
	<h1>Dashboard<small>Control panel</small></h1>
  <h2> {{Auth::user()->id}}</h2>
  <h2> {{Auth::user()->firstname}}</h2>
    <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>1</h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
@stop

