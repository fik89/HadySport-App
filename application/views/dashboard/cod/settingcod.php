
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Tambah Lokasi COD
            <span class="action pull-right">
                <button class="btn btn-sm btn-primary " data-toggle="modal" data-target="#inputCod" id="plush"><i class="fa fa-plus"></i> Tambah</button>
            </span>
        </h3>
        <div class="row">
            <div id="finputcod"></div>
            <div class="panel panel-green">
                <div class="panel-heading">
                    Tambah cod / cod
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width:100%" id="dataTables-datacod">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Lokasi</th>
                                    <th>Ongkir</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="__tb">
                                <?php $i=1;foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->idcod; ?></td>
                                        <td><?php echo $value->lokasi; ?></td>
                                        <td><?php echo $value->ongkir; ?></td>
                                        <td><?php echo $value->deskripsi; ?></td>
                                        <td><?php echo $value->status; ?></td>
                                        <td align="center">
                                            <button class="btn btn-sm btn-danger" title="delete" onclick="DeleteCod('<?=$value->idcod?>')"><i class="fa fa-trash"></i></button>
                                            <button class="btn btn-sm btn-warning edt" onclick="showEdit('<?=$value->idcod?>')" title="update" data-toggle="modal" data-target="#inputCod" style="margin-left:3px;"><i class="fa fa-pencil"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="inputCod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="margin: 0">Input Lokasi COD
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
          <span aria-hidden="true">&times;</span>
        </button>
        </h5>
      </div>
      <div class="modal-body">
        <input type="hidden" name="" id="id">
        <div class="form-group">
            <label >Lokasi</label>
            <input type="text" class="form-control" id="m-lokasi"> 
        </div>
        <div class="form-group">
            <label >Ongkir</label>
            <input type="text" class="form-control" id="m-ongkir"> 
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" id="m-desc" rows="2" ></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Active</label>
            <select class="form-control" id="Act">
              <option >Active</option>
              <option >Non Active</option>
            </select>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary upd" onclick="UpdateCod()">Update</button> 
        <button type="button" class="btn btn-primary sv" onclick="createCod()">Save</button> 
        
      </div>
    </div>
  </div>
</div>
<!-- --------- -->

<script>
    $('.upd').hide();
    $('#plush').click(function(){
        $('.upd').hide();
        $('.sv').show(); 
    });
    function fInputcod() {
        $.ajax({
            url: "<?php echo base_url('d/Home/f_input_cod'); ?>",
            method: "POST",
            success: function (data) {
                $('#finputcod').html(data);
                prov();
            }
        });
    }

    function updatecod(id) {
        $.ajax({
            url: "<?php echo base_url('d/Home/f_edit_cod'); ?>",
            method: "POST",
            data: {"id": id},
            success: function (data) {
                $('#data').html(data);
            }
        });
    }
    
    function deletecod_(id) {
        swal({
            title: "Hapus Lokasi COD ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('d/Home/delete_cod'); ?>",
                            method: "POST",
                            data: {"idcod": id},
                            success: function (data) {
                                $('#alert').html(data);
                                dataCod();
                            }
                        });
                        swal("Terhapus!", "Lokasi COD Terhapus", "success");
                    } else {
                        swal("", "", "error");
                    }
                });

    }

    function createCod(){
        var lokasi = $("#m-lokasi").val();
        var ongkir = $("#m-ongkir").val();
        var desc   = $("#m-desc").val();
        var Act    = $("#Act").val();    
        $.ajax({
            url: "<?php echo base_url('d/Home/create_cod_m'); ?>",
            method: "POST",
            data: {lokasi:lokasi,ongkir:ongkir,desc:desc,Act:Act},
            success: function (data) {
                    swal({
                      text: "Input Berhasil",
                      icon: "success",
                      button: "Aww yiss!",
                    }); 
                $('#inputCod').modal('toggle');      
                $('#__tb').html(data);
            }
        });
    }
    
    function showEdit(id){
        $.ajax({
            url: "<?php echo base_url('d/Home/showEdit'); ?>",
            dataType: "JSON",
            method: "POST",
            data: {id:id},
            success: function (data) {
                $("#m-lokasi").val(data.lokasi);
                $("#m-ongkir").val(data.ongkir);
                $("#m-desc").val(data.deskripsi);
                $("#Act").val(data.status);  
                $('#id').val(data.idcod);
                $('.upd').show();
                $('.sv').hide(); 
            }
        });
 
    }
    function UpdateCod(){
        var id = $('#id').val();
        var lokasi = $("#m-lokasi").val();
        var ongkir = $("#m-ongkir").val();
        var desc   = $("#m-desc").val();
        var Act    = $("#Act").val();   
         $.ajax({
            url: "<?php echo base_url('d/Home/Update_Cod_m'); ?>",
            method: "POST",
            data: {lokasi:lokasi,ongkir:ongkir,desc:desc,Act:Act,id:id},
            success: function (data) {
                // console.log(data);
                 swal({
                      text: "Input Berhasil",
                      icon: "success",
                      button: "Aww yiss!",
                    }); 
                $('#inputCod').modal('toggle');      
                $('#__tb').html(data);
            }
        });
    } 

    function DeleteCod(id){
        swal({
            title: "Hapus Lokasi COD ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('d/Home/delete_cod_m'); ?>",
                            method: "POST",
                            data: {id: id},
                            success: function (data) {
                                swal("Terhapus!", "Lokasi COD Terhapus", "success");
                                $('#__tb').html(data);
                            }
                        });
                    } else {
                        swal("", "", "error");
                    }
                });

    }   
</script>