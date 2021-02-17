<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends Controller
{
    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    /**
     * @return Factory|View
     */
    public function getAllProducts()
    {
        $products = Product::with(['cat'])->orderBy('id', 'desc')->paginate(10);
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getProductDetail($id)
    {
        $product = Product::findOrfail($id);
        $categories = Category::where('module', '3')->pluck('name', 'id');
        $data = ['categories' => $categories, 'product' => $product];
        return view('admin.products.detail', $data);
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function getProductEdit($id)
    {
        $product = Product::findOrfail($id);
        $categories = Category::where('module', '3')->pluck('name', 'id');
        $data = ['categories' => $categories, 'product' => $product];
        return view('admin.products.edit', $data);
    }

    public function postProductEdit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'price'   => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $product = Product::findOrfail($id);
            $ipp = $product->file_path;
            $ip = $product->image;
            $product->category_id = $request->input('category');
            $product->name = e($request->input('name'));
            if($request->hasFile('img')):
                $path = '/'.date('Y-m-d');
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $upload_path = Config::get('filesystems.disks.products.root');
                $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                $file_file = $upload_path.'/'.$path.'/'.$filename;
                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->reference = e($request->input('reference'));
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            $product->status = e($request->input('status'));
            $product->quantity = e($request->input('quantity'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'products');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                    unlink($upload_path.'/'.$ipp.'/'.$ip);
                    unlink($upload_path.'/'.$ipp.'/t_'.$ip);
                endif;
                Alert::success(Lang::get('Updated Product'), Lang::get('The product has updated successfully'));
                return back();
            endif;
        endif;
    }

    public function getProductAdd()
    {
        $categories = Category::where('module', '3')->pluck('name', 'id');
        $data = ['categories' => $categories];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'img'     => 'required',
            'price'   => 'required',
            'content' => 'required'
        ]);

        if($validator->fails()):
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.products.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));

            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path.'/'.$path.'/'.$filename;

            $product = new Product;
            $product->category_id = $request->input('category');
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->reference = e($request->input('reference'));
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));
            $product->status = '0';
            $product->quantity = e($request->input('quantity'));

            if($product->save()):
                if($request->hasFile('img')):
                    $fl = $request->img->storeAs($path, $filename, 'products');
                    $img = Image::make($file_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);
                endif;
                Alert::success('Producto Creado', 'El producto se ha creado correctamente.');
                return redirect('/admin/products');
            endif;
        endif;
    }

    public function deleteProduct($id){
        $product = Product::findOrfail($id);
        if($product->delete()):
            Alert::success('Producto Eliminado', 'El producto seleccionado se ha eliminado correctamente.');
            return back();
        endif;
    }
}
