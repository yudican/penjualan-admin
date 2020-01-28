<section class="section">
          <div class="section-header">
            <h1><?php echo $this->uri->segment(2) == 'edit' ? 'Update' : 'Input'; ?> Promo</h1>
          </div>
          <div class="row">
              <div class="col-12">
               <div class="col-md-8 mx-auto">
                <?php echo alert($this->session->flashdata('error')) ?>
               </div>
                <div class="card">
                
                  <div class="card-body">
                    <?php echo form_open($action) ?>
                      <?php echo input_hidden('promo_barang', $this->uri->segment(3)); ?>
                      <?php echo input_text('promo_value', isset($row['promo_value']) ? $row['promo_value'] : $this->session->flashdata('value')); ?>
                      <?php echo input_date('promo_startdate', isset($row['promo_startdate']) ? $row['promo_startdate'] : ''); ?>
                      <?php echo input_date('promo_enddate', isset($row['promo_enddate']) ? $row['promo_enddate'] : ''); ?>
                         
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button name="save" value="save" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </section>