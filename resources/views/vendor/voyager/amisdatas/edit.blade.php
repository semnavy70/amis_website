@extends('voyager::master')

@section('page_title','KRAVANH Custom')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-wallet"></i>Edit Data
        </h1>
       
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
      
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('msg'))
                            <div class="alert alert-success" id="msg">
                                {{ session('msg') }}
                            </div>
                        @endif
                        <form role="form" class="" action="{{ route('voyager.amisdata.update',['amis_data' => $amis_data->dataid])}}" method="POST" enctype="multipart/form-data">
                            
                            {{ csrf_field() }}
                            <!-- CSRF TOKEN -->
                           <input type="hidden" name="_method" value="PUT"/>
                            <div class="panel-body">
                                <div class="form-group ">
                                    <label for="name">Value</label>
                                    <input required="" type="text" value="{{ $amis_data->value1 }}" class="form-control" name="value1" placeholder="value1" value="">
                                </div>
                            </div><!-- panel-body -->
    
                            <div class="panel-footer">
                                <button type="submit" class="btn btn-primary save">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


