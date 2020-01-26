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
      <button name="save" value="save" class="btn btn-primary float-right">Lewati</button>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="col-md-8 mx-auto">
          <?php echo alert($this->session->flashdata('error')) ?>
          </div>
          <div class="card">
          
            <div class="card-body">
              <?php echo form_open($action,['id' => 'form-variant']) ?>
                <div class="col-md-4 mx-auto" data-id="1" id="variant">
                  <div class="variant">
                    <h4 class="text-center text-uppercase" style="margin-bottom:0;">Aktifkan Variant</h4>
                  </div>
                </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
  </section>