<div class="row">
    <div class="col-md-4">
        <div class="form-group border-bottom pb-4">
            <label for="barcode" class="form-label">Barcode (angka)</label>
            <div class="input-group">
                <input type="text" class="form-control" name="barcode" id="barcode_input" value="{{ old('barcode', $product->barcode) }}" placeholder="Scan atau ketik barcode" onkeyup="onBarcodeKey(event)">
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm btn-success" id="generateBarcodeBtn" onclick="generateBarcodeSingle({{ $product->id }})">Generate</button>
                </div>
            </div>
            <div id="barcode_preview" style="margin-top:8px;">
                @if($product->barcode)
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->barcode, 'C128') }}" alt="barcode" style="height:40px">
                    <div style="font-size:12px">{{ $product->barcode }}</div>
                @else
                    <div style="font-size:12px;color:#888;">No barcode</div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="price" class="form-label">Harga Jual Produk</label>
            <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" id="price">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="harga_beli" class="form-label">Harga Beli Produk</label>
            <input type="number" class="form-control" name="harga_beli" value="{{ old('harga_beli', $product->harga_beli) }}" id="harga_beli">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="rating" class="form-label">Rating Produk</label>
            <input type="number" step="0.01" min="0" max="5" class="form-control" name="rating" value="{{ old('rating', $product->rating) }}" placeholder="0.00 - 5.00" id="rating">
            <small class="form-text text-muted">Rating 0.00 - 5.00 (0 = belum ada rating)</small>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="discount_price" class="form-label">Harga Diskon</label>
            <input type="number" class="form-control" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" placeholder="Kosongkan jika tidak ada diskon" id="discount_price">
            <small class="form-text text-muted">Isi jika produk sedang diskon</small>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="discount_percent" class="form-label">Diskon (%)</label>
            <input type="number" min="0" max="100" class="form-control" name="discount_percent" value="{{ old('discount_percent', $product->discount_percent) }}" placeholder="0-100" id="discount_percent">
            <small class="form-text text-muted">Persentase diskon untuk badge</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group border-bottom pb-4">
            <label for="discount_starts_at" class="form-label">Diskon Mulai</label>
            <input type="datetime-local" class="form-control" name="discount_starts_at" value="{{ old('discount_starts_at', $product->discount_starts_at ? date('Y-m-d\TH:i', strtotime($product->discount_starts_at)) : '') }}" id="discount_starts_at">
            <small class="form-text text-muted">Tanggal mulai diskon</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group border-bottom pb-4">
            <label for="discount_ends_at" class="form-label">Diskon Berakhir</label>
            <input type="datetime-local" class="form-control" name="discount_ends_at" value="{{ old('discount_ends_at', $product->discount_ends_at ? date('Y-m-d\TH:i', strtotime($product->discount_ends_at)) : '') }}" id="discount_ends_at">
            <small class="form-text text-muted">Tanggal berakhir diskon</small>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="weight" class="form-label">Berat (kg)</label>
            <input type="number" step="0.01" class="form-control" name="weight" value="{{ old('weight', $product->weight) }}" placeholder="Contoh: 1.5 (untuk 1.5 kg)" id="weight">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="qty" class="form-label">Jumlah Produk</label>
            <input type="number" class="form-control" name="qty" value="{{ old('qty', $product->productInventory ? $product->productInventory->qty : null) }}" id="qty">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="length" class="form-label">Panjang</label>
            <input type="number" class="form-control" placeholder="cm" name="length" value="{{ old('length', $product->length) }}" id="length">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="width" class="form-label">Lebar</label>
            <input type="number" class="form-control" placeholder="cm" name="width" value="{{ old('width', $product->width) }}" id="width">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group border-bottom pb-4">
            <label for="height" class="form-label">Tinggi</label>
            <input type="number" class="form-control" placeholder="cm" name="height" value="{{ old('height', $product->height) }}" id="height">
        </div>
    </div>
</div>
