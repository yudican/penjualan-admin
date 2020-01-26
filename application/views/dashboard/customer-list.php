<section class="section">
  <div class="section-header">
    <h1>List Customer</h1>
  </div>
  <div class="card">
    <div class="card-body p-0">
      <table class="table" id="tableList">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Umur</th>
            <th scope="col">Tentang</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
    
        </tbody>
      </table>
    </div>
  </div>
</section>

<script type="text/javascript">
   $(document).ready(function () {
       var table = $("#tableList").dataTable({
           "bProcessing": false,
           "bServerSide": true,
           "sAjaxSource": "<?php echo site_url('customer/list'); ?>",
           "fnRowCallback": function( nRow, aoData, iDisplayIndex ) {
               var index = iDisplayIndex +1;
               $('td:eq(0)',nRow).html(index);
               return nRow;
            },
           "columns": [
               { "data": "nomor",orderable:false,searchable:false },
               { "data": "customer_foto", "name": "customer.customer_foto" },
               { "data": "customer_nama", "name": "customer.customer_nama" },
               { "data": "customer_gender", "name": "customer.customer_gender" },
               { "data": "customer_birthday", "name": "customer.customer_birthday" },
               { "data": "customer_about", "name": "customer.customer_about" },
               { "data": "actions",orderable:false,searchable:false}
               
               
           ],
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "iDisplayStart ": 20,
           "fnServerData": function (sSource, aoData, fnCallback)
           {
               $.ajax
                       ({
                           "dataType": "json",
                           "type": "POST",
                           "url": sSource,
                           "data": aoData,
                           "success": fnCallback
                       });
           },
           "order": [
               [0, "asc"]
           ]
       });
       
  });

  $("#tableList").on('click', '.hapus_record',function() {
    let id = $(this).data('id');
    swal({
      title: 'Konfirmasi Hapus',
      text: 'Yakin akan hapus data ini?',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'ajax',
          method: 'post',
          url: '<?php echo site_url('kategori/delete_data/') ?>'+id,
          dataType: 'JSON',
          success: function(data) {
            var table = $('#tableList').DataTable(); 
            table.ajax.reload( null, false );
            swal('Success, Member Telah Di Hapus', {
              icon: 'success',
            });
          },
          error: function() {
            swal('Gagal', 'Opps!, Suatu masalah sedang terjadi', 'error');
          }
        });
      } else {
      swal('Cancel, Tidak ada perubahan data dalam aksi ini');
      }
    });
  });
</script>

