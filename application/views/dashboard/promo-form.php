<section class="section">
  <div class="section-header">
    <h1>Input New Promo</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php echo form_open($action) ?>
            <?php echo input_select('promo_barang', isset($row['promo_barang']) ? $row['promo_barang'] : '', 'barang','barang_id','barang_nama'); ?>
            <?php echo input_date('promo_startdate', isset($row['promo_startdate']) ? $row['promo_startdate'] : ''); ?>
            <?php echo input_date('promo_enddate', isset($row['promo_enddate']) ? $row['promo_enddate'] : ''); ?>
            <?php echo input_text('promo_value', isset($row['promo_value']) ? $row['promo_value'] : ''); ?>
                
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
              <div class="col-sm-12 col-md-7">
                <button class="btn btn-primary">Simpan</button>
                <a href="<?php echo site_url('promo') ?>" class="btn btn-danger">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>