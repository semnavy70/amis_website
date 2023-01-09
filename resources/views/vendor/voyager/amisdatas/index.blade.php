@extends('voyager::master')

@section('page_title','KRAVANH Custom')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-wallet"></i> AMIS Data
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

                        <form action="{{ route('excel_amiss')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="file" name="excel">
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>



                        </form>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Transactioncode</th>
                                    <th>Commoditycode</th>
                                    <th>Gradecode</th>
                                    <th>Marketcode</th>
                                    <th>Datasourcecode</th>
                                    <th>Origincode</th>
                                    <th>Dataseriescode</th>
                                    <th>Unitcode</th>
                                    <th>Date</th>
                                    <th>Value1</th>
                                    <th>Username</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($amis_data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $item->transactioncode}}</td>
                                        <td>{{ $item->commoditycode}}</td>
                                        <td>{{ $item->gradecode}}</td>
                                        <td>{{ $item->marketcode}}</td>
                                        <td>{{ $item->datasourcecode}}</td>
                                        <td>{{ $item->origincode}}</td>
                                        <td>{{ $item->dataseriescode}}</td>
                                        <td>{{ $item->unitcode}}</td>
                                        <td>{{ $item->date}}</td>
                                        <td>{{ $item->value1}}</td>
                                        <td>{{ $item->username}}</td>

                                        <td>
                                            {{--<a href="javascript:;" data-toggle="modal" data-target="#delete_modal" data- title="Delete" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id}}" data-url="{{ route('voyager.amisdatas.destroy',['amis_data' => $item->id ]) }}" id="delete">--}}
                                                {{--<i class="voyager-trash"></i>--}}
                                            {{--</a>--}}

                                            <a href="{{ route('voyager.amisdata.edit',['amis_data' => $item->dataid])}}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                                <i class="voyager-edit"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                            {{$amis_data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

