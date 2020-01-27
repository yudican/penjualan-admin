<section class="section">
          <div class="section-header">
            <h1>Input New Kategori</h1>
          </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <?php echo form_open($action) ?>
                      <?php echo input_text('kategori_nama', isset($row['kategori_nama']) ? $row['kategori_nama'] : ''); ?>
                      <?php echo input_select('kategori_jenis', isset($row['kategori_jenis']) ? $row['kategori_jenis'] : '', 'kategori','kategori_id','kategori_nama'); ?>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button class="btn btn-primary">Simpan</button>
                          <a href="<?php echo site_url('kategori') ?>" class="btn btn-danger">Batal</a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </section>