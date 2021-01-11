@extends('admin.master')

@section('title', Lang::get('Add Product'))

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{!! url('/admin') !!}"><i class="fas fa-home"></i> @lang('Dashboard') /</a>
        <a href="{{ route('Products') }}"><i class="fas fa-shopping-cart"></i> @lang('Products') /</a>
        <a href="{{ route('ProductAdd') }}"><i class="fas fa-plus"></i> @lang('Add Product')</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-plus"></i> @lang('Add Product')</h2>
                <a class="btn btn-danger btn-back" href="{{ route('Products') }}"><i class="fas fa-undo-alt"></i> @lang('Back to Products')</a>
            </div>

            <div class="inside">
                {!! Form::open(['url' => '/admin/product/add', 'files'=> true ]) !!}

                <div class="row">

                    <div class="col-md-6">
                        <label for="name">@lang('Name')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="far fa-keyboard"></i>
                           	</span>
                            </div>
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="reference">@lang('Reference')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-barcode"></i>
                           	</span>
                            </div>
                            {!! Form::text('reference', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="img">@lang('Outstanding Image')</label>
                        <div class="custom-file">
                            {!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile', 'accept' => 'image/*', 'required']) !!}
                            <label class="custom-file-label" for="customFile"><i class="far fa-image"></i> @lang('Find file')</label>
                        </div>
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-2">
                        <label for="price">@lang('Price')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-euro-sign"></i>
                           	</span>
                            </div>
                            {!! Form::number('price', null, ['class' => 'form-control', 'min' => '0.00', 'step
                                ' => 'any', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="indiscount">@lang('Off sale?')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-toggle-on"></i>
                           	</span>
                            </div>
                            {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'custom-select', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="discount">@lang('Discount')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   %
                           	</span>
                            </div>
                            {!! Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step
                                ' => 'any', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="category">@lang('Category')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-folder-open"></i>
                           	</span>
                            </div>
                            {!! Form::select('category', $categories, 0, ['class' => 'custom-select', 'required']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="status">@lang('Status')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
		                           <span class="input-group-text" id="basic-addon1">
		                           	   <i class="fas fa-toggle-on"></i>
		                           	</span>
                            </div>
                            {!! Form::select('status', ['0' => 'Borrador', '1' => 'Publico'], null, ['class' => 'custom-select']) !!}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label for="quantity">@lang('Quantity')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                           <span class="input-group-text" id="basic-addon1">
                           	   <i class="fas fa-equals"></i>
                           	</span>
                            </div>
                            {!! Form::number('quantity', 0, ['class' => 'form-control', 'min' => '0.00', 'required']) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="content">@lang('Description')</label>
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'contenido', 'required']) !!}
                        <script>
                            // Replace the textarea #example with SCEditor
                            var textarea = document.getElementById('contenido');
                            sceditor.create(textarea, {
                                format: 'bbcode',
                                style: 'minified/themes/content/default.min.css'
                            });
                        </script>
                    </div>
                </div>
                {!! Form::submit(Lang::get('Add Product'), ['class' => 'btn btn-success mtop16']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection
