<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\CategoryLogs;
use App\Models\Products;
use App\Models\ToDoes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DataTableController extends Controller
{

    public function load(Request $request)
    {
        $type = $request->type;

        switch ($type) {
            case 'users_list':
                $status = ($_GET["status"] != '') ? ($_GET["status"]) : ('');
                if ($status == ''){
                    $users = User::where('id', '!=', Auth::user()->id);
                } else {
                    $users = User::where('id', '!=', Auth::user()->id)->where('is_active', $status);
                }
                return DataTables::eloquent($users)->toJson();

            case 'to_do_list':
                $status = ($_GET["status"] != '') ? ($_GET["status"]) : ('');
                if ($status == ''){
                    $toDoes = ToDoes::where('recording_id', Auth::user()->id);
                } else {
                    $toDoes = ToDoes::where('recording_id', Auth::user()->id)->where('is_active', $status);
                }
                return DataTables::eloquent($toDoes)->toJson();

            case 'products_list':
                $status = ($_GET["status"] != '') ? ($_GET["status"]) : ('');
                if ($status == ''){
                    $products = Products::on();
                } else {
                    $products = Products::where('is_active', $status);
                }
                return DataTables::eloquent($products)->toJson();

            case 'categories_list':
                $user = ($_GET["user"] != '') ? ($_GET["user"]) : ('');
                if ($user == ''){
                    $categories = Categories::on();
                } else {
                    return 1;
                }
//                dd($categories, $user);
                return DataTables::eloquent($categories)->toJson();
        }
    }

}
