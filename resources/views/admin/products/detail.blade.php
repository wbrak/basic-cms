@extends('admin.master')

@section('title', Lang::get('Product Detail'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
        <a href="{{ route('Products') }}"><i class="fas fa-boxes"></i> @lang('Products') /</a>
        <a href="{{ url('admin/product/'.$product->id.'detail') }}"><i class="fas fa-edit"></i> @lang('Details')</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><img src="{{asset('storage/svg/048-shopping bag.svg')}}"> Detalle Producto</h2>
                        <a class="btn btn-back btn-danger mtop16" href="{{ route('Products') }}"><i class="fas fa-undo-alt"></i> Volver a Productos</i></a>
                    </div>

                    <div class="inside">

                        <div class="form-row">

                            <div class="col-md-6">
                                <fieldset disabled="">
                                    <label for="name">Nombre del producto</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
			                           <span class="input-group-text" id="basic-addon1">
			                           	   <i class="far fa-keyboard"></i>
			                           	</span>
                                        </div>
                                        {!! Form::text('name', $product->name, ['class' => 'form-control', 'readonly']) !!}
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-3">
                                <fieldset disabled="">
                                    <label for="category">Categoría</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
			                           <span class="input-group-text" id="basic-addon1">
			                           	   <i class="far fa-keyboard"></i>
			                           	</span>
                                        </div>
                                        {!! Form::text('category', $product->category_id, ['class' => 'form-control', 'readonly']) !!}
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-md-3">
                                <label for="price">Precio</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-euro-sign"></i>
		                           	</span>
                                    </div>
                                    {!! Form::text('price', $product->price, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="indiscount">¿En descuento?</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-euro-sign"></i>
		                           	</span>
                                    </div>
                                    {!! Form::text('indiscount', $product->in_discount, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="discount">Descuento</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   %
		                           	</span>
                                    </div>
                                    {!! Form::text('discount', $product->discount, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="status">Estado</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-toggle-on"></i>
		                           	</span>
                                    </div>
                                    {!! Form::text('status', $product->status, ['class' => 'form-control', 'readonly']) !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="content">Descripción</label>
                                {!! Form::textarea('content', $product->content, ['class' => 'form-control', 'readonly']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
                        <div class="inside">
                            <img src="{{ asset('storage/products/'.$product->file_path.'/'.$product->image) }}" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
