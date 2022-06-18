<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Requests\Supervisor\Category\CategoryCreateRequest;
use App\Http\Requests\Supervisor\Category\CategoryDeleteRequest;
use App\Http\Requests\Supervisor\Category\CategoryUpdateRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('supervisor.pages.categories.index');
    }

    public function create()
    {
        return view('supervisor.pages.categories.create');
    }

    public function store(CategoryCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Category::create(array_merge($validator,['slug' => Str::slug($validator['name'])]));
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('supervisor.categories');
    }

    public function edit($id)
    {
        $row = Category::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        return view('supervisor.pages.categories.edit', compact('row'));
    }

    public function update(CategoryUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Category::findOrFail($request->row_id);
        $row->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'slug' => Str::slug($request->name),
        ]);

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('supervisor.categories');
    }

    public function delete(CategoryDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Category::find($request->row_id)->delete();
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
        Category::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = Category::query();

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('icon', function ($row) {
                return '<i class="'.$row->icon.'"></i>';
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
                $buttons .= '<a href="' . route('supervisor.categories.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','icon','select', 'created_at'])
            ->make();

    }
}
