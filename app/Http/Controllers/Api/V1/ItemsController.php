<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TypeItems;
use App\Models\Satuan;
use App\Models\Items;
use Illuminate\Validation\Rule;
use Encore\Admin\Layout\Content;


class ItemsController extends Controller
{
    public function Index()
    {
        // Ambil jumlah ikan per kolam berdasarkan pond_id
        // $jml_ikan = DB::table('detail_koi')
        //     ->selectRaw('count(*) as jml_ikan, pond_id')
        //     ->groupBy('pond_id')
        //     ->get();

        // Ambil data kolam
        $items = Items::all();

        // Kirim data ke view
        return view("admin.allitems", compact('items'));
    }


    public function SearchItem(Request $request)
    {
        $search = $request->search;

        $items = Items::where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
        })->get();

        return view('admin.allitems', compact('items', 'search'));
    }

    public function AddItems()
    {
        $typeid = TypeItems::all();
        $typeS = Satuan::all();

        return view("admin.additems", compact('typeid', 'typeS'));
    }

    public function StoreItem(Request $request)
    {
        $request->validate([
            'NamaBarang' => 'required|unique:databarang',
            'IdJenisBarang' => 'required',
            'JumlahStok' => 'required',
            'IdSatuan' => 'required',
        ]);

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Items::insert([
            'NamaBarang' => $request->NamaBarang,
            'IdJenisBarang' => $request->IdJenisBarang,
            'JumlahStok' => $request->JumlahStok,
            'IdSatuan' => $request->IdSatuan,
        ]);
        // dd($request->all());

        return redirect()->route('allitems')->with('message', 'Barang telah berhasil ditambah!');


    }

    public function EditItem($IdBarang)
    {

        $iteminfo = Items::findOrFail($IdBarang);
        $category_parent = $iteminfo->IdJenisBarang;
        $parent_title = Items::where('JenisBarang', $category_parent)->first();
        $typeid = TypeItems::all();
        $typeS = Satuan::all();

        return view('admin.edititem', compact('iteminfo', 'typeid', 'typeS', 'parent_title'));
    }

    public function UpdateItem(Request $request)
    {
        $itemid = $request->id;

        $request->validate([
            'name' => ['required', Rule::unique('items')->ignore($request->id),],
            'volume' => 'required'
        ]);

        $mytime = Carbon::now();
        $mytime->toDateTimeString();
        Items::findOrFail($itemid)->update([
            'name' => $request->name,
            'updated_at' => $mytime,
            'volume' => $request->volume,
        ]);

        return redirect()->route('allitems')->with('message', 'Update Informasi Barang Berhasil!');
    }

    public function DeleteItem($IdBarang)
    {
        Items::findOrFail($IdBarang)->delete();

        return redirect()->route('allitems')->with('message', 'Penghapusan Barang Berhasil!');
    }

    public function get_item_list()
    {
        $item = Items::get(); // Retrieve all records from the 'item' table

        return response()->json($item, 200);
    }

    public function updateRelayCondition(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'relay_condition' => 'required|boolean',
        ]);

        $item = Items::find($request->item_id);

        if ($item) {
            $item->relay_condition = $request->relay_condition;
            $item->save();

            return response()->json([
                'message' => 'Relay condition updated successfully.',
                'item' => $item,
            ], 200);
        }

        return response()->json([
            'message' => 'Items not found.',
        ], 404);
    }



    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Items';

    // /**
    //  * Make a grid builder.
    //  *
    //  * @return Grid
    //  */
    // protected function grid()
    // {
    //     $grid = new Grid(new Food());
    //     $grid->model()->latest();
    //     $grid->column('id', __('Id'));
    //     $grid->column('name', __('Name'));
    //      $grid->column('FoodType.title', __('Category'));
    //     $grid->column('price', __('Price'));
    //     //$grid->column('location', __('Location'));
    //     $grid->column('stars', __('Stars'));
    //     $grid->column('img', __('Thumbnail Photo'))->image('',60,60);
    //     $grid->column('description', __('Description'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
    //         return substr($val,0,30);
    //     });
    //     //$grid->column('total_people', __('People'));
    //    // $grid->column('selected_people', __('Selected'));
    //     $grid->column('created_at', __('Created_at'));
    //     $grid->column('updated_at', __('Updated_at'));

    //     return $grid;
    // }

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Food::findOrFail($id));



    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Food());
    //     $form->text('name', __('Name'));
    //       $form->select('type_id', __('Type_id'))->options((new FoodType())::selectOptions());
    //     $form->number('price', __('Price'));
    //     $form->text('location', __('Location'));
    //     $form->number('stars', __('Stars'));
    //     $form->number('people', __('People'));
    //     $form->number('selected_people', __('Selected'));
    //     $form->image('img', __('Thumbnail'))->uniqueName();
    //     $form->UEditor('description','Description');



    //     return $form;
    // }
}
