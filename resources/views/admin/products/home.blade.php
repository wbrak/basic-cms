@extends('admin.master')

@section('title', Lang::get('Products'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
        <a href="{{ route('Products') }}"><i class="fas fa-shopping-cart"></i> @lang('Products')</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-shopping-cart"></i> @lang('Products')</h2>
                <a class="btn btn-danger btn-back" href="{!! route('ProductAdd') !!}"><i class="fas fa-plus"></i> @lang('Add Product')</a>
            </div>

            <div class="inside">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">@lang('Image')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Friendly Url')</th>
                        <th scope="col">@lang('Category')</th>
                        <th scope="col">@lang('Description')</th>
                        <th scope="col">@lang('Price')</th>
                        <th scope="col">@lang('Last Modification')</th>
                        <th scope="col">@lang('Actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr @if($product->status == "0") class="table-danger" @endif>
                            <td><img src="{{ asset('storage/products/'.$product->file_path.'/'.$product->image) }}" class="table-img"></td>
                            <td data-toggle="tooltip" data-placement="top" title="Detalle"><a href="{{ url('admin/product/'.$product->id.'/detail') }}">{{ $product->name }}</a></td>
                            <td>{{ $product->slug }}</td>
                            <td>{{ $product->cat->name }}</td>
                            <td>{!! $product->content !!}</td>
                            <td>{{ $product->price }} €</td>
                            <td>{{ $product->created_at }}</td>
                            <td>

                                <div class="opts">

                                    <a href="{{ url('admin/product/'.$product->id.'/edit') }}"><button class="btn btn-warning btn-edit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></button></a>

                                    <a type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#staticBackdrop{{ $product->id }}"><i class="fas fa-trash-alt"></i></a>

                                    <div class="modal fade" id="staticBackdrop{{ $product->id }}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Aviso Importante</h5>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estas seguro de eliminar {{ $product->name }} ? Esta acción no tiene vuelta atras.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                    {!! Form::open(['method' => 'DELETE', 'action' => ['Admin\ProductController@deleteProduct', $product->id]]) !!}
                                                    {!! Form::submit('Eliminar', ['class'=>'btn btn-success']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="nav-pag">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
@endsection
