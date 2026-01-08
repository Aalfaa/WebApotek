@extends('layouts.app')

@section('content')
  <div id="pageLoader" class="fixed inset-0 bg-white flex items-center justify-center z-[9999]">
    <div class="w-10 h-10 border-4 border-gray-300 border-t-[var(--primary)] rounded-full animate-spin"></div>
  </div>

  @php
    $harga = (int)($obat->harga ?? 0);
    $diskon = (int)($obat->diskon_persen ?? 0);
    $hargaDiskon = ($harga > 0 && $diskon > 0) ? (int)($harga * (100 - $diskon) / 100) : $harga;
    $stok = (int)($obat->stok ?? 0);

    $productDesc = optional($obat->deskripsi->firstWhere('label', 'Product Description'))->nilai;
  @endphp

  <div class="max-w-6xl mx-auto px-4 py-6">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ url('/') }}" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white shadow-md border border-[var(--primary)]/20 hover:shadow-lg transition">
            <iconify-icon icon="mdi:arrow-left" class="text-xl text-gray-600"></iconify-icon>
        </a>
        <h1 class="text-md font-bold text-gray-800">Detail Produk</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-10">

      <div class="md:col-span-4 flex justify-center">
        <div class="w-full">

          <div class="rounded-xl overflow-hidden shadow-sm bg-white w-full aspect-square flex items-center justify-center relative">
            @if ($diskon > 0)
              <div class="absolute top-0 left-2 z-10">
                <div class="w-12 h-12 bg-[var(--primary)] text-white text-sm font-bold flex items-center justify-center rounded-b-full">
                  -{{ $diskon }}%
                </div>
              </div>
            @endif

            <div class="absolute inset-0 bg-gray-200 animate-pulse"></div>

            <img id="mainImg"
                src="{{ $gallery[0] }}"
                class="relative w-full h-full object-contain p-4 opacity-0 transition-opacity duration-300"
                onload="this.classList.remove('opacity-0'); this.previousElementSibling.style.display='none';"
                alt="{{ $obat->nama }}"
                loading="eager">
          </div>

          <div class="grid grid-cols-3 gap-3 mt-4">
            @foreach ($gallery as $img)
              <img data-img="{{ $img }}"
                  src="{{ $img }}"
                  class="thumb aspect-square w-full object-contain rounded-lg cursor-pointer hover:opacity-70 transition bg-white p-1"
                  alt="Thumbnail">
            @endforeach
          </div>

        </div>
      </div>

      <div class="md:col-span-5 space-y-2">

        <h1 class="text-[26px] font-semibold leading-tight">
          {{ $obat->nama }}
        </h1>

        @if ($harga > 0)
          <div class="flex items-end gap-2">
            <p class="text-[30px] font-bold text-[var(--primary-dark)]">
              Rp {{ number_format($hargaDiskon, 0, ',', '.') }}
            </p>

            @if ($diskon > 0)
              <p class="text-gray-500 line-through text-base pb-1">
                Rp {{ number_format($harga, 0, ',', '.') }}
              </p>
            @endif
          </div>
        @else
          <p class="text-gray-400 text-lg font-semibold">Harga belum tersedia</p>
        @endif

        <div class="border-b mb-3"></div>

            <div class="relative">
                <div id="descContent"
                    class="text-sm text-gray-700 space-y-4 clamp-12 transition-all">

                    @foreach ($obat->deskripsi as $d)
                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $d->label }}
                            </p>

                            <p>
                                {!! nl2br(e(str_replace('\\n', "\n", $d->nilai))) !!}
                            </p>
                        </div>
                    @endforeach

                </div>

                <div id="descFade"
                    class="pointer-events-none absolute bottom-0 left-0 w-full h-12
                            bg-gradient-to-t from-white to-transparent">
                </div>
            </div>

            <button id="toggleDesc"
                    class="mt-2 text-[var(--primary)] font-semibold hover:text-[var(--primary-dark)]">
                Lihat Selengkapnya
            </button>

        </div>

      <div class="md:col-span-3">
        <div class="bg-white border rounded-xl shadow p-5 top-28">
          <h3 class="font-semibold mb-3">Opsi Keranjang</h3>
          <h2 class="text-sm">Stok: {{$stok}}</h2>

          <div class="flex items-center gap-3 mb-4">
              <span class="text-sm text-gray-600">Jumlah:</span>
              <div class="flex items-center border rounded-lg overflow-hidden">
                  <button type="button" onclick="changeQty(-1)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">-</button>
                  <input type="number" id="inputQty" value="1" min="1" class="w-12 text-center text-sm outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                  <button type="button" onclick="changeQty(1)" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">+</button>
              </div>
          </div>

          <button onclick="addToCart({{ $obat->id }})" class="w-full py-3 rounded-lg bg-[var(--primary)] text-white font-medium
                        hover:bg-[var(--primary-dark)] transition shadow-md active:scale-95 transform-gpu">
            Tambah Keranjang
          </button>
        </div>
      </div>

    </div>

  </div>

  <script>
    function changeQty(val) {
        const input = document.getElementById('inputQty');
        let current = parseInt(input.value);
        if (current + val >= 1) {
            input.value = current + val;
        }
    }

    async function addToCart(obatId) {
        const qty = document.getElementById('inputQty').value;
        const btn = event.target;

        const originalText = btn.innerText;
        btn.innerText = "Menambahkan...";
        btn.disabled = true;

        try {
            const response = await fetch("{{ url('/api/keranjang/tambah') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    obat_id: obatId,
                    jumlah: qty
                })
            });

            const data = await response.json();

            if (response.status === 401) {
                alert("Silakan login terlebih dahulu untuk menambah keranjang.");
                window.location.href = "{{ route('login') }}";
            } else if (response.ok) {
                alert("Berhasil! Produk telah ditambahkan ke keranjang.");
                location.reload();
            } else {
                alert("Gagal: " + (data.message || "Terjadi kesalahan"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Koneksi bermasalah.");
        } finally {
            btn.innerText = originalText;
            btn.disabled = false;
        }
    }
  </script>
@endsection
