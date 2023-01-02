<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProdukController extends Controller
{
    public function index()
    {
        return Produk::all();
    }

    public function create(Request $request)
    {
        $data = $request->only(
            'namaProduk',
            'harga',
            'gambar',
            'stok',
            'keterangan',
            'idProduk'
        );

        $validator = Validator::make($data,[
            'namaProduk' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'idProduk' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->messages()
            ]);
        }

        $nameFile = $request->file('gambar')->getClientOriginalName();
        $path = $request->file('gambar')->storeAs('images', $nameFile, 'public');

        $produk = Produk::create([
            'nama_produk' => $request->namaProduk,
            'harga' => $request->harga,
            'gambar' => asset($path),
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'id_produk' => $request->idProduk
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'produk created',
            'data' => $produk
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only(
            'namaProduk',
            'harga',
            'gambar',
            'stok',
            'keterangan',
            'idProduk'
        );

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'produk updated',
            'data' => $request->all()
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        Produk::findOrFail($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => "produk with id $id deleted",
        ], Response::HTTP_OK);
    }
}