<section class="section">
  <div class="section-header">
    <h1>Input New Product</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php echo form_open($action) ?>
            <div id="kategori">
              <div class="form-group row mb-4" id="data_kategori-0">
                <label for="barang_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori Produk</label>
                <div class="col-sm-12 col-md-7"> 
                  <select name="barang_kategori[]" onchange="selectCategory(0);" id="barang_kategori-0" <?php echo error_border(form_error('barang_kategori')) ?> class="form-control select2">
                    <option value="">Pilih Kategori</option>";
                    <?php foreach ($kategori as $list) {
                      echo "<option value=".$list['kategori_id']." ".set_select('barang_kategori',isset($row['barang_kategori']) ? $row['barang_kategori'] : '',$list['kategori_id'] == $row['barang_kategori']).">".$list['kategori_nama']."</option>";
                    } ?>
                  </select>
                  <?php echo error(form_error('barang_kategori')) ?>
                </div>
              </div>
              <?php echo $this->uri->segment(2) == 'edit' ? getCategoryTree($row['barang_kategori']) : null; ?>
            </div>


            <?php echo input_text('barang_barcode', isset($row['barang_barcode']) ? $row['barang_barcode'] : ''); ?>
            <?php echo input_text('barang_nama', isset($row['barang_nama']) ? $row['barang_nama'] : ''); ?>
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