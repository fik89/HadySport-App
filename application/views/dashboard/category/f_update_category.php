<div class="row">
    <div class="panel panel-green">
        <div class="panel-heading">
            Edit Kategori <?php echo $data->categoryName;?>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#general" data-toggle="tab">General</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="general"><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" class="form-horizontal" id="editcategory">
                                 <input class="form-control" name="idcategory" id="idcategory" type="hidden" value="<?php echo $data->idcategory;?>">
                               <div class="form-group">
                                    <label for="categoryname" class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="categoryname" id="categoryname" type="text" value="<?php echo $data->categoryName;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="parent" class="col-sm-2 control-label">Parent <span class="text-info" data-toggle="tooltip" title="Jika Kategori merupakan parent pilih parent"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                    <div class="col-sm-10">
                                         <select class="form-control" name="parent" id="parent">
                                             <option value="0">Parent</option>
                                             <option selected="" value="<?php echo $dataparent['idcategory']; ?>"><?php echo $dataparent['categoryName']; ?></option>
                                        <?php echo $category;?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categorydesc" class="col-sm-2 control-label">Deskipsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="textarea form-control" rows="7" name="categorydesc" id="categorydesc" required=""><?php echo $data->categoryDescription;?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metatagtitle" class="col-sm-2 control-label">Meta Tag Title <span class="text-info" data-toggle="tooltip" title="gunakan keyword sesuai nama kategori"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="metatagtitle" id="metatagtitle" type="text" value="<?php echo $data->categoryMetaTag;?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metatagdesc" class="col-sm-2 control-label">Meta Deskripsi <span class="text-info" data-toggle="tooltip" title="Deskripsikan sedetail mungkin jika kategori merupakan parent"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" name="metatagdesc" id="metatagdesc" required=""><?php echo $data->categoryMetaDescription; ?></textarea>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="status" class="col-sm-2 control-label">Status <span class="text-info" data-toggle="tooltip" title="Status inactive maka tidak akan ditampilkan system"><i class="fa fa-question-circle fa-fw"></i></span></label>
                                    <div class="col-sm-10">
                                         <select class="form-control" name="status" id="status">
                                             <option selected="" value="<?php echo $data->categoryStatus;?>"><?php echo $data->categoryStatus;?></option>
                                        <option value="active">Active</option>
                                        <option value="inActive">Inctive</option>
                                    </select>
                                    </div>
                                </div>
                                <button type="reset" class="btn btn-default">Reset</button>
                                <input type="button" onclick="updateCategory();" class="btn btn-success pull-right" value="Update">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function updateCategory() {
        var form = $('form').get(0);
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/Category/update_category') ?>',
            method: "POST",
            data: new FormData(form),
            contentType: false,
            processData: false,
            success: function (resp) {
                $('#alert').html(resp);
                $('#loader').hide();
                dataCategory();
            }
        });
    }
</script>