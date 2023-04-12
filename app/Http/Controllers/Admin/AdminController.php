<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Admin())->query();
        $this->table = (new Admin())->getTable();

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName); //cắt chuỗi
        $arr = array_map('ucfirst', $arr); // viết hoa chữ cái đầu
        $title = implode(' - ', $arr); // nối nhau bằng dấu '-'

        View::share('title', $title);
    }

    public function index(Request $request)
    {
        $selectedPhone = $request->get('phone');

        $query = $this->model->clone()
            ->where('role', '=', 1)
            ->latest();

        if ( ! empty($selectedPhone) && $selectedPhone !== 'All') {
            $query->where('phone', $selectedPhone);
        }//kiểm tra có phone trên thanh địa chỉ hay không nếu có thì lấy phone rồi trả về dữ liệu

        $data = $query->paginate(10)->withQueryString();

        $phones = $this->model->clone()
            ->where('role', '=', 1)
            ->pluck('phone');

        return view('admin.index', [
            'data'          => $data,
            'phones'        => $phones,
            'selectedPhone' => $selectedPhone,
        ]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(StoreRequest $request)
    {
        $this->model->create($request->validated());

        return redirect()->route('admins.index')
            ->with('success', 'Thêm admin thành công');
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit', [
            'each' => $admin
        ]);
    }

    public function update(UpdateRequest $request, $adminId)
    {
        $this->model->where('id', $adminId)->update(
            $request->validated()
        );

        return redirect()->route('admins.index')
            ->with('success', 'Cập nhật thông tin admin thành công!');
    }

    public function destroy(Admin $admin)
    {
        if (isSuperAdmin()) {
            return redirect()->back()
                ->with('error', 'Không được làm thế, dừng lại đi');
        } else {
            $admin->delete();

            return redirect()->back()->with('success', 'Đã xoá thành công admin');
        }
    }
}
