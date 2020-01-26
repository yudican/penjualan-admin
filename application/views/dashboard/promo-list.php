<section class="section">
  <div class="section-header">
    <h1>List Promo</h1>
  </div>
  <div class="card">
    <div class="card-header">
      <a href="<?php echo site_url('promo/add') ?>"><button class="btn btn-success">add new promo</button></a>
    </div>
    <div class="card-body p-0">
      <table class="table" id="tableList">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Value</th>
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
           "sAjaxSource": "<?php echo site_url('promo/list'); ?>",
           "fnRowCallback": function( nRow, aoData, iDisplayIndex ) {
               var index = iDisplayIndex +1;
               $('td:eq(0)',nRow).html(index);
               return nRow;
            },
           "columns": [
               { "data": "nomor",orderable:false,searchable:false },
               { "data": "promo_barang", "name": "promo.promo_barang" },
               { "data": "barang_nama", "name": "promo.barang_nama" },
               { "data": "promo_startdate", "name": "promo.promo_startdate" },
               { "data": "promo_enddate", "name": "promo.promo_enddate" },
               { "data": "promo_value", "name": "promo.promo_value" },
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
          url: '<?php echo site_url('promo/delete_data/') ?>'+id,
          dataType: 'JSON',
          success: function(data) {
            var table = $('#tableList').DataTable(); 
            table.ajax.reload( null, false );
            swal('Success, Data Promo Telah Di Hapus', {
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

