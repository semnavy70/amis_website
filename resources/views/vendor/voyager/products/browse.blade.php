@extends('voyager::master')

@section('page_title','KRAVANH Custom')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-wallet"></i> {{$product->name}}
        </h1>

        {{--<a href="{{ route('voyager.amisdata.create')}}" class="btn btn-success btn-add-new">--}}
            {{--<i class="voyager-plus"></i> <span>{{ __('voyager.generic.add_new') }}</span>--}}
        {{--</a>--}}

    </div>
@stop

@section('content')

    <div class="page-content browse container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Provice</th>
                                    <th>Type</th>
                                    <th>2010</th>
                                    <th>2011</th>
                                    <th>2012</th>
                                    <th>2013</th>
                                    <th>2014</th>
                                    <th>2015</th>
                                    <th>2016</th>
                                    <th>2017</th>
                                    <th>2018</th>
                                    <th>2019</th>
                                    <th>2020</th>
                                    <th>2021</th>
                                    <th>2022</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->province_code}}</td>
                                        <td>{{ $item->type}}</td>
                                        <td>{{ $item->y2010}}</td>
                                        <td>{{ $item->y2011}}</td>
                                        <td>{{ $item->y2012}}</td>
                                        <td>{{ $item->y2013}}</td>
                                        <td>{{ $item->y2014}}</td>
                                        <td>{{ $item->y2015}}</td>
                                        <td>{{ $item->y2016}}</td>
                                        <td>{{ $item->y2017}}</td>
                                        <td>{{ $item->y2018}}</td>
                                        <td>{{ $item->y2019}}</td>
                                        <td>{{ $item->y2020}}</td>
                                        <td>{{ $item->y2021}}</td>
                                        <td>{{ $item->y2022}}</td>
                                    </tr>


                                @endforeach

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

