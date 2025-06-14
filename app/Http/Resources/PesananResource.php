<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PesananResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->whenLoaded('user'),
            'nama_pelanggan' => $this->nama_pelanggan,
            'nomor_whatsapp' => $this->nomor_whatsapp,
            'alamat_pengiriman' => $this->alamat_pengiriman,
            'total_harga' => $this->total_harga,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
            'status' => $this->status,
            'nomor_resi' => $this->nomor_resi,
            'tanggal_pesanan' => $this->tanggal_pesanan,
            'catatan' => $this->catatan,
            'catatan_admin' => $this->catatan_admin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'items' => $this->whenLoaded('items', function () {
                return $this->items->map(function ($pupuk) {
                    return [
                        'id' => $pupuk->id,
                        'nama_pupuk' => $pupuk->nama_pupuk,
                        'slug' => $pupuk->slug,
                        'deskripsi' => $pupuk->deskripsi,
                        'harga' => $pupuk->harga,
                        'stok' => $pupuk->stok,
                        'kategori_pupuk' => $pupuk->kategoriPupuk,
                        'gambar_utama_url' => $pupuk->gambar_utama_url,

                        // Data dari tabel pivot item_pesanan
                        'jumlah' => $pupuk->pivot->jumlah,
                        'harga_saat_pesanan' => $pupuk->pivot->harga_saat_pesanan,
                    ];
                });
            }),
        ];
    }
}