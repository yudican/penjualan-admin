let save = document.querySelector('#btn-save'),
cropped = document.querySelector('.cropped'),
flip = document.querySelector('.flip');
var cropper;
var flipHor = 1;
var flipVer = -1;
function togleModal(id, img,width,height,name,url,type) {
    
    $('#crop-modal').modal('show');
    // $('#crop-modal').addClass('bd-example-modal-lg');
    $('#tittle').text(type+' Foto')
    $('.pop').popover("hide");
    if(type === 'crop'){
        $('#rotate').hide()
    }

    $(".cropp").html(`  <div>
                            <form style="max-height:450px;" id="form-modal" class="d-flex justify-content-center" style="width: 100%;" action="`+url+`" method="POST">
                                <img style="max-width:100%;" src="`+img+`" id="image-`+id+`"/>
                                <input type="hidden" id="id" name="id" value="`+id+`" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                                <input type="hidden" id="file_name" name="file_name" value="`+name+`" />
                                <input type="hidden" name="source" id="source" value="`+img+`"/>
                            </form>
                            <div class="mt-3">
                                <div class="btn-group" style="padding-right:10px;">
                                    <button type="button" onclick="return putar(-90);" class="btn btn-primary"><i class="fa fa-undo-alt"></i></button>
                                    <button type="button" onclick="return putar(90);" class="btn btn-primary"><i class="fa fa-redo-alt"></i></button>
                                </div>
                                <div class="btn-group" style="padding-right:10px;" id="option-flip">
                                    <button type="button" onclick="return flip_h();" class="btn btn-primary"><i class="fa fa-arrows-alt-h"></i></button>
                                    <button type="button" onclick="return flip_v();" class="btn btn-primary"><i class="fa fa-arrows-alt-v"></i></button>
                                </div>
                                <div class="btn-group" style="padding-right:10px;">
                                    <button type="button" id="btn-save" class="btn btn-primary"><i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>`);
    const image = document.getElementById('image-'+id);
    cropper = new Cropper(image, {
        aspectRatio: 'NaN',
        responsive: true,
        autoCropArea: 1,
        minContainerHeight: 400,
        minContainerWidth: 350,
        minCanvasHeight: 400,
        minCanvasWidth: 350,
        crop(event) {
            //  console.log(event.detail.x);
            //  console.log(event.detail.y);
            //  console.log(event.detail.width);
            //  console.log(event.detail.height);
            //  console.log(event.detail.rotate);
            flipHor = event.detail.scaleX;
            flipVer = event.detail.scaleY;
            //  console.log(event.detail.scaleX);
        },
    });
    // var contData = cropper.getContainerData(); //Get container data
    // console.log(contData)
    // cropper.setCropBoxData({ height: 300, width: 230  }) //set data
}

 function putar(val) {
   cropper.rotate(val);
 }


 $('#crop-modal').on('click','#btn-save',function(){
   // get result to data uri
   var frm = $('#form-modal');
    var url= frm.attr('action');
    var file= $('#file_name').val();
    var id= $('#id').val();
    let imgSrc = cropper.getCroppedCanvas({ width: 204 }).toDataURL();
   
    $.ajax({
      url:url,
      method: "POST",
      data: {croppedImage: imgSrc, filename:file},
      processData: true,
      cache: false,
      contentType: "application/x-www-form-urlencoded",
      dataType: 'json',
      beforeSend: function() {
         swal({
           title: "Saving File",
           text: "Please wait",
           icon: base_url('/assets/img/loader/spinner.gif'),
           closeOnClickOutside: false,
           button: false
         });
     },
      success(data) {
        console.log(data)
        swal.close(); 
         $('#new-image-'+id).html(`  <div class="center">
                                         <img class="tengah" src="`+data.img+`" alt="" class="imagecheck-image">
                                     </div>`);
         $('#crop-modal').modal('hide');
         // $('#crop-modal').addClass('bd-example-modal-lg');
      },
      error() {
        console.log('Upload error');
      },
    });
 });

 function flip_h(){
   cropper.scale(flipHor == 1 ? -1 : 1,flipHor ? 1 : -1); // Flip both horizontal and vertical
 };
 function flip_v(){
   cropper.scale(flipVer ? 1 : -1, flipVer == 1 ? -1 : 1); // Flip both horizontal and vertical
 };

 function base_url(params) {
  var getUrl = window.location;
  var baseurl = getUrl.origin; //or
  var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1];
  return baseurl+params;
 }

 function option(id) {
    $('#popover-'+id).removeClass('hidden').delay(500)
   $('#popover-'+id).addClass('show-option')
 }
 function leave(id) {
   setTimeout(() => {
    $('#popover-'+id).addClass('hidden')
  }, 100);
  $('#popover-'+id).removeClass('show-option')
 }

 //tambah background
 
 var dataBg = [];
  function addBg(data) {
    $('#add_background').modal('show')
    $("#sort div").sort(function(a, b) {
      return parseInt(b.id) - parseInt(a.id);
    }).each(function() {
      var elem = $(this);
      // console.log(elem)
      elem.remove();
      $(elem).appendTo("#sort");
    });

    // var newData = JSON.parse(data)
    var dataArr = decode(data);
    for(i=0;i<dataArr.length;i++){
      dataBg.push(dataArr[i])
    }
    // console.log(dataArr)
  }
 function selectBg(id) {
    var arr = dataBg;
    var cek = dataBg.indexOf(id)
    if(cek == -1){
      dataBg.push(id)
    }else{
      jQuery.each(dataBg,function(i,item){
        if(arr[i] == id) {
          arr.splice(i, 1);
        }
      });
      dataBg =arr; 
    }
 }

 $('#add_background').on('click','#btn-save',function(){
  var frm = $('#bg-form');
  var url= frm.attr('action');
  $.ajax({
    url:url,
    method: "POST",
    data: {dataBg: dataBg},
    cache: false,
    dataType: 'json',
    beforeSend: function() {
       swal({
         title: "Saving Changes",
         text: "Please wait",
         icon: base_url('/assets/img/loader/spinner.gif'),
         closeOnClickOutside: false,
         button: false
       });
   },
    success(data) {
      console.log(data)
      swal.close(); 
      location.reload(true)
       $('#add_background').modal('hide');
       // $('#crop-modal').addClass('bd-example-modal-lg');
    },
    error() {
      console.log('Upload error');
    },
  });
 });

 function decode(str) {
  decodedString = atob(str);
  return JSON.parse(decodedString);
}

function showBgModal(){
  $('#background').modal('show');
}

function deleteBg(id,id2) {
  selectBg(id);
  $.ajax({
    type:"post",
    data:{id:id,dataBg: dataBg},
    url:base_url('/client/remove_bg/'+id2),
    cache:false,
    dataType: 'json',
    success: function(){
      $('label').remove('#background-'+id)
      location.reload(true)
      // console.log('ok')
    },
    error: function(){
      console.log("Error");

    }
  });
}

function cari() {
  var input, filter, card, p, a, i;
  input = document.getElementById("myFilter");
  filter = input.value.toUpperCase();
  card = document.getElementById("myItems");
  p = card.getElementsByTagName("p");
  for (i = 0; i < p.length; i++) {
      a = p[i].getElementsByTagName("a")[0];
      if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
          p[i].parentElement.style.display = "";
      } else {
          p[i].parentElement.style.display = "none";
      }
  }
}



