<section class="section">
  <div class="section-header">
    <h1>Input New Product</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php echo form_open($action) ?>
            <?php echo input_text('barang_sku', isset($row['barang_sku']) ? $row['barang_sku'] : ''); ?>
            <?php echo input_text('barang_nama', isset($row['barang_nama']) ? $row['barang_nama'] : ''); ?>
            <?php echo input_select('barang_kategori', isset($row['barang_kategori']) ? $row['barang_kategori'] : '', 'kategori','kategori_id','kategori_nama'); ?>
            <?php echo input_text('barang_stock', isset($row['barang_stock']) ? $row['barang_stock'] : ''); ?>
            <?php echo input_text('barang_type', isset($row['barang_type']) ? $row['barang_type'] : ''); ?>
            <?php echo input_text('barang_hrg_beli', isset($row['barang_hrg_beli']) ? $row['barang_hrg_beli'] : ''); ?>
            <?php echo input_text('barang_hrg_jual', isset($row['barang_hrg_jual']) ? $row['barang_hrg_jual'] : ''); ?>
            <?php echo input_textarea('barang_detail', isset($row['barang_detail']) ? $row['barang_detail'] : ''); ?>
                
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?php echo site_url('product') ?>" class="btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>