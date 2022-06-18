<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Supervisor\SupervisorCreateRequest;
use App\Http\Requests\Admin\Supervisor\SupervisorDeleteRequest;
use App\Http\Requests\Admin\Supervisor\SupervisorUpdateRequest;
use App\Models\Supervisor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('admin.pages.supervisors.index');
    }

    public function create()
    {
        return view('admin.pages.supervisors.create');
    }

    public function store(SupervisorCreateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Supervisor::create($validator);
        session()->flash('success', 'تم الإضافة بنجاح');
        return redirect()->route('admin.supervisors');
    }

    public function edit($id)
    {
        $row = Supervisor::findOrFail($id);
        if (!$row) {
            session()->flash('error', 'الحقل غير موجود');
            return redirect()->back();
        }
        return view('admin.pages.supervisors.edit', compact('row'));
    }

    public function update(SupervisorUpdateRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $row = Supervisor::findOrFail($request->row_id);

        $row->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'active' => $request->active,
        ]);
        if ($request->has('password')) {
            $row->update(['password' => $request->password]);
        }
        if ($request->has('image') && is_file($request->image)) {
            $row->update(['image' => $request->image]);
        }
        $row->save();

        session()->flash('success', 'تم التعديل بنجاح');
        return redirect()->route('admin.supervisors');
    }

    public function delete(SupervisorDeleteRequest $request)
    {
        $validator = $request->validated();
        if (!is_array($validator) && $validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        Supervisor::find($request->row_id)->delete();
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
        Supervisor::findOrFail($id)->delete();
        session()->flash('success', 'تم الحذف بنجاح');
        return back();
    }

    public function getData()
    {
        $model = Supervisor::query()->where('id', '>', 1);

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->editColumn('image', function ($row) {
                return '<a class="symbol symbol-50px"><span class="symbol-label" style="background-image:url(' . $row->image . ');"></span></a>';
            })
            ->editColumn('active', function ($row) {
                if ($row->active == 1) {
                    return "<b class='badge badge-success'>مفعل</b>";
                } else {
                    return "<b class='badge badge-danger'>غير مفعل</b>";
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
                $buttons .= '<a href="' . route('admin.supervisors.edit', [$row->id]) . '" class="btn btn-primary btn-circle btn-sm m-1" title="تعديل">
                            <i class="fa fa-edit"></i>
                        </a>';
                $buttons .= '<a class="btn btn-danger btn-sm delete btn-circle m-1" data-id="' . $row->id . '"  title="حذف">
                            <i class="fa fa-trash"></i>
                        </a>';
//                }
                return $buttons;
            })
            ->rawColumns(['actions','select','image', 'active', 'suspend', 'created_at'])
            ->make();

    }
}
