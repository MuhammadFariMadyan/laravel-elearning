@extends('admin.layout.master')
@section('breadcrump')
          <h1>
             Not Find Page
            <small>Check Your URL</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
@stop
@section('content')
<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Whoops! page not found .</h3>
        <p>
            Not Find Page
            Back<a href='{{ url('/') }}'>Back to Dashboard}</a> Search
        </p>
        <form class='search-form'>
            <div class='input-group'>
                <input type="text" name="search" class='form-control' placeholder="Search"/>
                <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                </div>
            </div><!-- /.input-group -->
        </form>
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection
