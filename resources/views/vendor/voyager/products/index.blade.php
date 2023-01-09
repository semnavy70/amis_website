@extends('voyager::master')

@section('page_title','KRAVANH Custom')

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-wallet"></i> Production
    </h1>

    <a href="{{ route('voyager.products.create')}}" class="btn btn-success btn-add-new">
        <i class="voyager-plus"></i> <span>{{ __('voyager.generic.add_new') }}</span>
        </a>

</div>
@stop

@section('content')

<div class="page-content browse container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <form action="{{ route('excel_data')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <input type="file" name="excel">
                            </div>
                            <div class="col-md-9">
                                <input type="submit" value="Submit" style="margin-top: 20px;">
                            </div>
                        </div>



                    </form>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>N</th>
                                <th>Name</th>
                                <th>Code</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->code}}</td>

                                <td>
                                    <a href="javascript:;" data-toggle="modal" data-target="#delete_modal-{{$item->id}}" data-title="Delete" class="btn btn-sm btn-danger pull-right delete" id="delete">
                                        <i class="voyager-trash"></i>
                                        </a>

                                    <a href="{{ route('voyager.products.edit',['products' => $item->id])}}" title="Edit" class="btn btn-sm btn-primary pull-right edit">
                                        <i class="voyager-edit"></i>
                                    </a>
                                    <a href="{{ route('voyager.products.browse',['id' => $item->id])}}" title="Browse" class="btn btn-sm btn-success pull-right browse">
                                        <i class="voyager-credit-cards"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal modal-danger fade" tabindex="-1" id="delete_modal-{{$item->id}}" role="dialog" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete this product?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="https://amis.org.kh/admin/products/{{$item->id}}" id="delete_form" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Yes, Delete it! product">
                                            </form>
                                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>

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

