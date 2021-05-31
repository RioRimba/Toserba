<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\barangModel;
use Illuminate\Support\Facades\Validator;

class barangController extends Controller
{
    public function index($value=""){
    	$dt=barangModel::get();
    	return response()->json($dt);
    }
    public function search($kata_kunci){
    	$dt=barangModel::where('nama_barang','like','%'.$kata_kunci.'%')->get();
    	return response()->json($dt);
    }
    public function add(Request $req){
    	$validator = validator::make($req->all(),[
    		'nama_barang'=>'required',
    		'stock'=>'required',
    		'harga'=>'required',
    	]);
    	if($validator->fails()){
    		$data['status']=false;
    		$data['message']=$validator->errors();
    		return response()->json($data);
    	}
    	$simpan = barangModel::create([
    		'nama_barang'	=>$req->nama_barang,
    		'stock'			=>$req->stock,
    		'harga'			=>$req->harga,
    	]);
    	if($simpan){
    		$data['status']=true;
    		$data['message']="Sukses Menambahkan Barang";
    	}else{
    		$data['status']=false;
    		$data['message']=['error'=>["Gagal Menambahkan Barang"]];
    	}
        return response()->json($data);
    }
    public function detail($id){
        $detail=barangModel::where('id_barang',$id)->first();
        return response()->json($detail);
    }
    public function editbarang($id,request $req){
        $validator = validator::make($req->all(),[
            'nama_barang'=>'required',
            'stock'=>'required',
            'harga'=>'required',
        ]);
        if($validator->fails()){
            $data['status']=false;
            $data['message']=$validator->errors();
            return response()->json($data);
        }
        $simpan = barangModel::where('id_barang',$id)->update([
            'nama_barang'   =>$req->nama_barang,
            'stock'         =>$req->stock,
            'harga'         =>$req->harga,
        ]);
        if($simpan){
            $data['status']=true;
            $data['message']="Sukses Mengupdate Barang";
        }else{
            $data['status']=false;
            $data['message']=['error'=>["Gagal Mengupdate Barang"]];
        }
        return response()->json($data);
    }
    public function deletebarang($id)
    {
        $hapus = barangModel::where('id_barang',$id)->delete();
        if($hapus){
            $data['status']=true;
            $data['message']="Sukses Menghapus Barang";
        }else{
            $data['status']=false;
            $data['message']="Gagal Menghapus Barang";
        }
        return response()->json($data);
    }
}
