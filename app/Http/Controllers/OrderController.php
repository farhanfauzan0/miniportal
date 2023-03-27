<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    function index(Request $request)
    {
        $data = DB::table('portal_order')
            ->select('portal_order.*', 'pms.name as status', 'pmp.name as pesanan')
            ->leftjoin('portal_master_status as pms', 'pms.id', 'portal_order.status_id')
            ->leftjoin('portal_master_pesanan as pmp', 'pmp.id', 'portal_order.pesanan_id')
            ->get();
        $datapesanan = DB::table('portal_master_pesanan')->get();
        $datastatus = DB::table('portal_master_status')->get();


        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->setRowAttr([
                    'style' => 'font-size: 13px; text-align: left;'
                ])
                ->editColumn('action', function ($datas) {

                    $html = "<button class='btn btn-sm btn-danger' onclick='deleteConfirmation($datas->id)'>Hapus</button>
                    <button class='btn btn-sm btn-info button-edit' data-id='$datas->id'>Edit</button>";
                    return $html;
                })
                ->editColumn('deadline', function ($datas) {
                    return Carbon::parse($datas->deadline)->format('d-m-Y');
                })
                ->editColumn('omset', function ($datas) {
                    return number_format($datas->omset);
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('order.index', ['datapesanan' => $datapesanan, 'datastatus' => $datastatus]);
    }

    function insert(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "pemesan" => "required",
            "pesanan" => "required",
            "jumlah_pesanan" => "required",
            "status" => "required",
            "deadline" => "required",
            "omset" => "required"
        ]);
        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput, periksa kembali data anda!', 'icon_a' => 'error']);
        }

        try {
            DB::table('portal_order')->insert([
                'pemesan' => $request->pemesan,
                'pesanan_id' => $request->pesanan,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'status_id' => $request->status,
                'deadline' => $request->deadline,
                'omset' => str_replace('.', "", $request->omset),
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput!', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }

    function edit(Request $request)
    {
        $data = DB::table('portal_order')->whereid($request->id)->first();
        return response()->json($data);
    }

    function update(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "pemesan" => "required",
            "pesanan" => "required",
            "jumlah_pesanan" => "required",
            "status" => "required",
            "deadline" => "required",
            "omset" => "required"
        ]);

        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diedit, periksa kembali data anda!', 'icon_a' => 'error']);
        }
        try {
            DB::table('portal_order')->whereid($request->id)->update([
                'pemesan' => $request->pemesan,
                'pesanan_id' => $request->pesanan,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'status_id' => $request->status,
                'deadline' => $request->deadline,
                'omset' => str_replace('.', "", $request->omset),
                'updated_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diedit!', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diedit!', 'icon_a' => 'error']);
        }
    }

    function delete(Request $request)
    {
        try {
            DB::table('portal_order')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
}
