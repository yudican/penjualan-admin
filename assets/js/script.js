var variant = document.getElementById('variant')
var base_url = $('meta[name=base-url]').attr("content");


$(document).ready(function() {
  $(variant).on('click', function() {
    $('#form-variant').html(`
      <div class="col-md-6 mx-auto" id="option">
        <div class="form-group">
          <div class="d-block">
            <label for="ukuran" class="control-label">Ukuran</label>
            <div class="float-right">
              <a href="auth-forgot-ukuran.html" class="text-small">
                Forgot ukuran?
              </a>
            </div>
          </div>
          <input id="ukuran" type="text" class="form-control" name="variant_option[]" tabindex="2">
        </div>
        <div class="form-group">
          <div class="d-block">
            <label for="warna" class="control-label">Warna</label>
            <div class="float-right">
              <a href="auth-forgot-warna.html" class="text-small">
                Forgot warna?
              </a>
            </div>
          </div>
          <input id="warna" type="text" class="form-control" name="variant_option" tabindex="2">
        </div>
        </div>
        <button id="add-button" type="button" class="btn btn-primary">Simpan Dan Lanjut</button>
    `)
  });

    // var maxField = 10; //Input fields increment limitation
    var addButton = document.getElementById('add-button'); //Add button selector
    // var wrapper = $('#option'); //Input field wrapper
    // var x = 1; //Initial field counter is 1
    // var val = 2;
    //Once add button is clicked
    $(addButton).on('click', function(){
      alert('ok')
        //Check maximum number of input fields
        
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove-button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});