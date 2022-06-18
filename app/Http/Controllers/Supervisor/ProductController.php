<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Requests\Supervisor\Product\ProductCreateRequest;
use App\Http\Requests\Supervisor\Product\ProductDeleteRequest;
use App\Http\Requests\Supervisor\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        return view('supervisor.pages.products.index');
    }

    public function create()
    {
        $categories = Category::select('id','name')->get();
        return view('supervisor.pages.products.create',compact('categories'));
    }

    public function store(ProductCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $product = Product::create([
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name),
            'name' => $request->name,
            'description' => $request->description
        ]);
        foreach ($request->image as $key => $value){
            ProductImage::create([
                'product_id' => $product->id,
                'type' => $key == 0 ? 'main' : 'sub',
                'image' => $value,
            ]);
        }
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('supervisor.products');
    }

    public function edit($id)
    {
        $categories = Category::select('id','name')->get();
        $row = Product::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        return view('supervisor.pages.products.edit', compact('row','categories'));
    }

    public function update(ProductUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Product::findOrFail($request->row_id);
        $row->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
            'slug' => Str::slug($request->name),
        ]);
        foreach ($request->image as $key => $value){
            ProductImage::create([
                'product_id' => $request->row_id,
                'type' => 'sub',
                'image' => $value,
            ]);
        }

        session()->flash('success', 'تم التعديل بنجاح');
        return back();
    }

    public function delete(ProductDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Product::find($request->row_id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return response()->json(['message' => 'Success']);
    }

    public function deleteImage(Request $request)
    {
        ProductImage::find($request->row_id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return response()->json(['message' => 'Success']);
    }

    public function deleteMulti(Request $request)
    {
        $ids_array = explode(',', $request->ids);
        foreach ($ids_array as $id) {
            $delete = $this->destroy($id);
            if (!$delete) {
                session()->flash('success', 'حدث خطأ ما');
                return redirect()->back();
            }
        }
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }


    public function getData()
    {
        $model = Product::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return '<a class="symbol symbol-50px"><span class="symbol-label" style="background-image:url(' . $row->MainImage->image . ');"></span></a>';
            })
            ->editColumn('category', function ($row) {
                if($row->Category){
                    return '<b class="badge badge-primary">'.$row->Category->name.'</b>';
                }else{
                    return '<b class="badge badge-primary">'."-".'</b>';
                }
            })

            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->translatedFormat("Y-m-d (H:i) A");
            })
            ->addColumn('select',function ($row){
                return '<div class="form-check form-check-sm form-check-custom form-check-solid me-3 ">
                    <input class="form-check-input checkboxes" type="checkbox"  value="'.$row->id.'" />
                </div>';
            })
            ->addColumn('actions', function ($row) {
                $buttons = '';
                $buttons .= '<a href="' . route('supervisor.products.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select','category','image','created_at'])
            ->make();

    }
}
