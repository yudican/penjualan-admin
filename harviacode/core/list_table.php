<?php

  $string = "<section class=\"section\">
              <div class=\"section-header\">
                <h1>".ucfirst($table_name)." List</h1>
              </div>
              <div class=\"card\">
                <div class=\"card-header\">
                <?php echo anchor(site_url('".$c_url."/create'), 'Create', 'class=\"btn btn-primary\"'); ?>
                </div>";
                $string .= "<div class=\"card-body p-0\">
                  <table class=\"table\" id=\"".$table_name."\">
                  <thead>
                    <tr>
                      <th width=\"80px\">No</th>";
    foreach ($non_pk as $row) {
        $string .= "\n\t\t    <th>" . label($row['column_name']) . "</th>";
    }
    $string .= "\n\t\t    <th width=\"200px\">Action</th>
                    </tr>
                </thead>";
                $string .= "<tbody>
                
                    </tbody>
                  </table>
                </div>
              </div>
            </section>";
            $column_non_pk = array();
            foreach ($non_pk as $row) {
                $column_non_pk[] .= "{\"data\": \"".$row['column_name']."\", \"name\": \"".$table_name.".".$row['column_name']."\"}";
            }
            $col_non_pk = implode(',', $column_non_pk);
            $string .= "<script src=\"<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>\"></script>
                        <script src=\"<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>\"></script>
                        <script src=\"<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>\"></script>";
            $string .= "<script type=\"text/javascript\">
            
            $(document).ready(function () {
                var table = $('#".$table_name."').dataTable({
                    \"bProcessing\": false,
                    \"bServerSide\": true,
                    \"sAjaxSource\": \"<?php echo site_url('".$c_url."/listData'); ?>\",
                    \"fnRowCallback\": function( nRow, aoData, iDisplayIndex ) {
                        var index = iDisplayIndex +1;
                        $('td:eq(0)',nRow).html(index);
                        return nRow;
                     },
                    \"columns\": [
                        { \"data\": \"nomor\",orderable:false,searchable:false },
                        ".$col_non_pk.",
                        { \"data\": \"actions\",orderable:false,searchable:false}
                    ],
                    \"bJQueryUI\": true,
                    \"sPaginationType\": \"full_numbers\",
                    \"iDisplayStart \": 20,
                    \"fnServerData\": function (sSource, aoData, fnCallback)
                    {
                        $.ajax
                                ({
                                    \"dataType\": \"json\",
                                    \"type\": \"POST\",
                                    \"url\": sSource,
                                    \"data\": aoData,
                                    \"success\": fnCallback
                                });
                    },
                    \"order\": [
                        [0, \"asc\"]
                    ]
                });
                
           });
         
           $('#".$table_name."').on('click', '.hapus_record',function() {
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
                   url: '<?php echo site_url('".$table_name."/delete/') ?>'+id,
                   dataType: 'JSON',
                   success: function(data) {
                     var table = $('#".$table_name."').DataTable(); 
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
         </script>";
         $hasil_view_list = createFile($string, $target."views/dashboard/" . $v_list_file);

?>