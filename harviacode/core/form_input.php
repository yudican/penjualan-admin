<?php

$string = "<section class=\"section\">
            <div class=\"section-header\">
              <h1>".ucfirst($table_name)." Form</h1>
            </div>
            <div class=\"row\">
                <div class=\"col-12\">
                  <div class=\"card\">
                    <div class=\"card-body\">
                      <?php echo form_open('\$action') ?>";
                      $string .= "\n\t\t\t\t\t\t\t\t<input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
                      foreach ($non_pk as $row) {
                        $string .= "\n\t\t\t\t\t\t\t\t<div class=\"form-group row mb-4\">
                        <label for=\"".$row["data_type"]."\" class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\">".label($row["column_name"])."</label>
                        <div class=\"col-sm-12 col-md-7\"> 
                          <input id=\"paper_name\" type=\"text\" class=\"form-control <?php echo error_border(form_error('".$row["column_name"]."')) ?>\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" name=\"".$row["column_name"]."\">
                          <?php echo error(form_error('".$row["column_name"]."')) ?>
                        </div>
                      </div>";
                    }
                        
                        
                    $string .= "<div class=\"form-group row mb-4\">
                          <label class=\"col-form-label text-md-right col-12 col-md-3 col-lg-3\"></label>
                          <div class=\"col-sm-12 col-md-7\">
                            <button class=\"btn btn-primary\">Simpan</button>
                            <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-danger\">Batal</a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>";

            $hasil_view_form = createFile($string, $target."views/dashboard/" . $v_form_file);