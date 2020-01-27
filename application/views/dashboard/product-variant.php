  <style>
    .variant{
      padding: 20px;
      border: 3px dashed blue;
      cursor: pointer!important;
    }
  </style>
  <section class="section">
    <div class="section-header d-flex justify-content-between">
      <h1>Input Variant</h1>
      <a href="<?php echo site_url('product/image/'.$this->uri->segment(3)) ?>"></a>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="col-md-8 mx-auto">
          <?php echo alert($this->session->flashdata('error')) ?>
          </div>
          <div class="card">
          
            <div class="card-body">
            <div class="col-md-6 mx-auto" data-id="<?php echo $this->uri->segment(3); ?>" id="variant">
              
              <?php echo form_open($action,['id' => 'form-variant']) ?>
                <?php if ($product['barang_variant'] == 1) { ?>
                  <?php $no=1; foreach ($variant as $rows) { ?>
                    <div class="form-group" id="variant-<?php echo $rows['variant_id'] ?>">
                      <div class="d-block">
                        <label for="<?php echo $rows['variant_nama'] ?>" class="control-label" id="label-<?php echo $rows['variant_id'] ?>"><?php echo $rows['variant_nama'] ?></label>
                        <?php echo $no > 2 ? '<a href="#" data-id="'.$rows['variant_id'].'" onclick="return removeOption('.$rows['variant_id'].');" class="text-danger" id="hapus">hapus</a>' : null ?>
                        <div class="float-right">
                          <a href="#" data-id="<?php echo $rows['variant_id'] ?>" class="text-small" onclick="return changeVariant('<?php echo $rows['variant_id'] ?>','<?php echo $rows['variant_nama'] ?>')">
                            ubah
                          </a>
                        </div>
                      </div>
                      <input type="hidden" class="form-control" name="variant_id[]" value="<?php echo $rows['variant_id'] ?>" tabindex="2">
                      <input type="text" class="form-control" placeholder="variant 1, variant2, variant 3, dll..." name="variant_value[]" tabindex="2" required>
                    </div>
                  <?php $no++;  } ?>
                <?php }else{ ?>
                  <div class="variant">
                    <h4 class="text-center text-uppercase" style="margin-bottom:0;">Aktifkan Variant</h4>
                  </div>  
                <?php } ?>
              </div>
              
              <div class="form-group" style="display: <?php echo $product['barang_variant'] == 1 ? 'block;' : 'none;' ?>" id="add-btn">
                <div class="form-group mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-md-6 mx-auto">
                    <button class="btn btn-danger" type="submit">Simpan</button>
                    <button type="button" id="add-button" data-id="<?php echo $this->uri->segment(3); ?>" class="btn btn-primary">add</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </section>