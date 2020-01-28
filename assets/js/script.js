var variant = document.getElementById('variant')
var base_url = $('meta[name=base-url]').attr("content");
var add_btn = $('#add-btn');


$(document).ready(function() {
  
  $(variant).on('click', '.variant', function() {
    var id = variant.dataset.id;
    $('#add-btn').removeAttr('style')
    let data = {ukuran: 'ukuran', warna:'warna', multiple:true}
    variantActive(id,data)
  });

    var maxField = 10; //Input fields increment limitation
    var addButton = document.getElementById('add-button'); //Add button selector
    
    var x = 1; //Initial field counter is 1
    var val = 2;
    //Once add button is clicked
    $(addButton).on('click', function(){
        //Check maximum number of input fields
        let id = addButton.dataset.id
        let data = {variant_nama: 'new variant'}
        if(x < maxField){ 
          x++; //Increment field counter
          variantNew(id,data)
        }
    });
    
    // //Once remove button is clicked
  });

  function removeOption(id) {
    $.ajax({
      url:base_url+'product-variant/delete-variant/'+id,
      method: "POST",
      data: {id:id},
      cache: false,
      dataType: 'json',
      success(data) {
        $('#variant-'+id).remove(); //Add field html
      },
      error() {
        console.log('error');
      },
    });
  }


function variantNew(id,dataPost) {
  $.ajax({
    url:base_url+'product-variant/new-variant/'+id,
    method: "POST",
    data: dataPost,
    cache: false,
    dataType: 'json',
    success(data) {
      $('#variant').append(`<div class="form-group"">
                                <div class="d-block">
                                  <label for="New Variant" class="control-label">New Variant </label>
                                  <a href="#" data-id="2" class="text-danger" id="hapus">hapus</a>
                                  <div class="float-right">
                                    <a href="javascript:void(0);" data-id="`+data.id+`" class="text-small" onclick="return changeVariant(`+data.id+`)">
                                      ubah
                                    </a>
                                  </div>
                                </div>
                                <input id="warna" type="text" class="form-control" name="variant_option" tabindex="2">
                              </div>`); //Add field html
       // $('#crop-modal').addClass('bd-example-modal-lg');
    },
    error() {
      console.log('error');
    },
  });
}
function variantActive(id,dataPost) {
  $.ajax({
    url:base_url+'product-variant/active/'+id,
    method: "POST",
    data: dataPost,
    cache: false,
    dataType: 'json',
    success(data) {
      $('#variant').html(`
        <div class="form-group">
          <div class="d-block">
            <label for="ukuran" class="control-label">Ukuran</label>
            <div class="float-right">
              <a href="auth-forgot-ukuran.html" class="text-small">
                ubah
              </a>
            </div>
          </div>
          <input type="hidden" class="form-control" name="variant_id[]" value="<?php echo $rows['variant_id'] ?>" tabindex="2">
          <input type="text" class="form-control" placeholder="variant 1, variant2, variant 3, dll..." name="variant_value[]" tabindex="2" required>
        </div>
        <div class="form-group">
          <div class="d-block">
            <label for="warna" class="control-label">Warna</label>
            <div class="float-right">
              <a href="auth-forgot-warna.html" class="text-small">
                ubah
              </a>
            </div>
          </div>
          <input type="hidden" class="form-control" name="variant_id[]" value="<?php echo $rows['variant_id'] ?>" tabindex="2">
          <input type="text" class="form-control" placeholder="variant 1, variant2, variant 3, dll..." name="variant_value[]" tabindex="2" required>
        </div>
    `)
       // $('#crop-modal').addClass('bd-example-modal-lg');
    },
    error() {
      console.log('error');
    },
  });
}

function changeVariant(id,val) {
  swal({
    title: 'Nama Variant Option',
    content: {
    element: 'input',
    attributes: {
      placeholder: 'ex: ukuran',
      type: 'text',
      required: true,
      value: val
    },
    },
  }).then((data) => {
    $.ajax({
      url:base_url+'product-variant/update-variant/'+id,
      method: "POST",
      data: {variant_nama:data},
      cache: false,
      dataType: 'json',
      success(response) {
        $('#label-'+id).text(data || val); //Add field html
        swal.close()
         // $('#crop-modal').addClass('bd-example-modal-lg');
      },
      error() {
        console.log('error');
      },
    });
  });
}


//input image
$(".imgAdd").click(function(){
  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" name="product_image[]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del" , function() {
	$(this).parent().remove();
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
        var imgId= $(this).data('id')
        $('#img-'+imgId).html(`<input type="hidden" name="gambar_id[]" value="`+imgId+`" />`)
    		var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
              uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
      
    });
});


function selectCategory(dataV){
  var val = $('#barang_kategori-'+dataV).val();
  $.ajax({
    url:base_url+'product/get-category/'+val,
    method: "POST",
    data: {kategori:val},
    cache: false,
    dataType: 'json',
    success(response) {
      var html = ``
      var data = ``
      for (let i = 0; i < response.data.length; i++) {
        data += `<option value="`+response.data[i].kategori_id+`">`+response.data[i].kategori_nama+`</option>`
        console.log(response.data)
      }
        html += `<div class="form-group row mb-4" id="data_kategori-`+val+`">
                <label for="barang_kategori" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Kategori Produk</label>
                <div class="col-sm-12 col-md-7"> 
                  <select name="barang_kategori[]" onchange="selectCategory(`+val+`);" id="barang_kategori-`+val+`" class="form-control select2">
                    <option value="">Pilih Sub Kategori</option>
                    `+
                    data
                    +`
                    </select>
                  <?php echo error(form_error('barang_kategori')) ?>
                </div>
              </div>`

      if (response.data.length > 0) {
        $('#kategori').append(html); //Add field html
      }else{
        $('#data_kategori-'+dataV).nextAll().remove()
      }
      
       // $('#crop-modal').addClass('bd-example-modal-lg');
    },
    error() {
      console.log('error');
    },
  });
}
