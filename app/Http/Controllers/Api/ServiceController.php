<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Menampilkan semua data layanan untuk tabel
        $services = Service::all();
        return response()->json(['success' => true, 'data' => $services]);
    }

    public function store(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'service_name' => 'required|string|max:255', 
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        // Simpan ke database
        $service = Service::create($request->all());

        return response()->json([
            'success' => true, 
            'message' => 'Layanan berhasil ditambahkan', 
            'data' => $service
        ], 201);
    }

    public function show(Service $service)
    {
        return response()->json(['success' => true, 'data' => $service]);
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_name' => 'required|string|max:255', // <--- GANTI JADI INI
            'price' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $service->update($request->all());

        return response()->json(['success' => true, 'message' => 'Layanan diupdate', 'data' => $service]);
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return response()->json(['success' => true, 'message' => 'Layanan berhasil dihapus']);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Gagal! Layanan ini tidak bisa dihapus karena sudah dipakai di riwayat transaksi.'
            ], 500);
        }
    }
}