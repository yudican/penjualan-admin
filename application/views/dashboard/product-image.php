<style>
body {
  background-color: #f5f5f5;
}

.imagePreview {
  width: 100%;
  height: 200px;
  background-position: center center;
  background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
  background-color: #fff;
  background-size: cover;
  background-repeat: no-repeat;
  display: inline-block;
  box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
}

.btn-primary {
  display: block;
  border-radius: 0px;
  box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
  margin-top: -5px;
}

.imgUp {
  margin-bottom: 15px;
}

.del {
  position: absolute;
  top: 0px;
  right: 15px;
  width: 30px;
  height: 30px;
  text-align: center;
  line-height: 30px;
  background-color: rgba(255, 255, 255, 0.6);
  cursor: pointer;
}

.imgAdd {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: #4bd7ef;
  color: #fff;
  box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
  text-align: center;
  line-height: 30px;
  margin-top: 0px;
  cursor: pointer;
  font-size: 15px;
}
</style>
<section class="section">
  <div class="section-header">
    <h1>Input Image</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="col-md-8 mx-auto">
        <?php echo alert($this->session->flashdata('error')) ?>
      </div>
      <div class="card">

        <div class="card-body">
          <?php echo form_open_multipart($action) ?>
            <br>
            <div class="container">
              <div class="row">
                <div class="col-sm-2 col-md-3 imgUp">
                  <div class="imagePreview"></div>
                  <label class="btn btn-primary">
                    Pilih Gambar<input type="file" class="uploadFile img" name="product_image[]" value="Upload Photo"
                      style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div><!-- col-2 -->
                <i class="fa fa-plus imgAdd"></i>
              </div><!-- row -->
            </div><!-- container -->
            <div class="col-sm-12 col-md-12">
              <button name="save" value="save" class="btn btn-primary float-right">Simpan Dan Lanjut</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>