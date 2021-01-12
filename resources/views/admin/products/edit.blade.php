@extends('admin.master')

@section('title', 'Editar Producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('Products') }}"><i class="fas fa-shopping-cart"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('admin/product/'.$product->id.'/edit') }}"><i class="far fa-edit"></i> Editar</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-edit"></i> Editar Producto</h2>
                        <a class="btn btn-back btn-danger mtop16" href="{{ route('Products') }}"><i class="fas fa-undo-alt"></i> Volver Productos</i></a>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/product/'.$product->id.'/edit', 'files'=> true ]) !!}

                        <div class="row">

                            <div class="col-md-6">
                                <label for="name">Nombre del producto:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="far fa-keyboard"></i>
		                           	</span>
                                    </div>
                                    {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="category">Categoría:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="far fa-keyboard"></i>
		                           	</span>
                                    </div>
                                    {!! Form::select('category', $categories, $product->category_id, ['class' => 'custom-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="img">Imagen Destacada:</label>
                                <div class="custom-file">
                                    {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                                    <label class="custom-file-label" for="customFile">Buscar fichero</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-3">
                                <label for="price">Precio:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-euro-sign"></i>
		                           	</span>
                                    </div>
                                    {!! Form::number('price', $product->price, ['class' => 'form-control', 'min' => '0.00', 'step
                                        ' => 'any']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="indiscount">¿En descuento?:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-euro-sign"></i>
		                           	</span>
                                    </div>
                                    {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $product->in_discount, ['class' => 'custom-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="discount">Descuento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   %
		                           	</span>
                                    </div>
                                    {!! Form::number('discount', $product->discount, ['class' => 'form-control', 'min' => '0.00', 'step
                                        ' => 'any']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="status">Estado:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-toggle-on"></i>
		                           	</span>
                                    </div>
                                    {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], $product->status, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="content">Descripción</label>
                                {!! Form::textarea('content', $product->content, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        {!! Form::submit('Editar Producto', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
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

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="far fa-images"></i> Galeria de Imagenes</h2>
                    </div>
                    <div class="inside product_gallery">


                        <div class="btn-submit">
                            <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                        </div>

                        <div class="tumbs">

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
