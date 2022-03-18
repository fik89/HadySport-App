<div class="row">
    <h3 class="page-header">Setting Data Toko</h3>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
              Setting Data Toko          
          </div>
          <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#company" data-toggle="tab">Profil Toko</a>
                </li>
                <li>
                    <a href="#bank" data-toggle="tab" onclick="dataListBank();">Daftar Bank</a>
                </li>
                <li>
                    <a href="#mailsender" data-toggle="tab" onclick="dataEmailSender();">Email Sender</a>
                </li>
                <li>
                    <a href="#shiping" data-toggle="tab" onclick="dataShipingGateway();">Setting Shiping Gateway</a>
                </li>
                <li>
                    <a href="#order" data-toggle="tab" onclick="orderSetting();">Setting Order</a>
                </li>
                <li>
                    <a href="#pajak" data-toggle="tab" onclick="settingPajak();">Setting Pajak</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="company">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        Data Profil
                                    </h4>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                                <?php foreach ($profile as $value) { ?>
                                                    <tr>
                                                        <th>Nama Toko</th>
                                                        <td><?php echo $value->companyName; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Alamat</th>
                                                        <td><?php echo $value->address1; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Telepon</th>
                                                        <td><?php echo "$value->phone1 / $value->phone2" ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>What's App</th>
                                                        <td><?php echo $value->waPhone; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Email</th>
                                                        <td><?php echo $value->email; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Facebook</th>
                                                        <td><?php echo $value->fbLink; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Instagram</th>
                                                        <td><?php echo $value->igLink; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Twitter</th>
                                                        <td><?php echo $value->twittLink; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Youtube</th>
                                                        <td><?php echo $value->ytLink; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Deskripsi Toko</th>
                                                        <td><?php echo $value->companyDescription; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Meta Tag Deskripsi</th>
                                                        <td><?php echo $value->tagcompanyDescription; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <th>Aksi</th>
                                                        <td align="center">
                                                            <button class="btn btn-sm btn-warning" title="update" onclick="updateProfile('<?php echo $value->id; ?>');"><i class="fa fa-pencil"></i></button>
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
                    <div id="fupdateprofile"></div> 
                </div>
                <div class="tab-pane fade" id="bank">
                    <div id="databank"></div>
                    <div id="inputbank"></div>  
                </div>
                <div class="tab-pane fade" id="mailsender">
                    <div id="dataemailsender"></div>
                </div>
                <div class="tab-pane fade" id="shiping">
                    <div id="datashipinggateway"></div>
                </div>
                <div class="tab-pane fade" id="order">
                    <div id="dataordersetting"></div>
                </div>
                <div class="tab-pane fade" id="pajak">
                    <div id="datapajak"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

    function settingPajak(){
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/System/data_setting_pajak') ?>',
            method: "GET",
            success: function (resp) {
                $('#datapajak').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    function updateProfile() {
        $('#loader').show();
        $.ajax({
            url: '<?php echo base_url('d/System/f_update_company_profile') ?>',
            method: "GET",
            success: function (resp) {
                $('#fupdateprofile').html(resp);
                $('#loader').hide();
                $('[data-toggle="tooltip"]').tooltip();
                $(".textarea").wysihtml5();
            }
        });
    }
    function dataListBank(){
      $('#loader').show();
      $.ajax({
        url: '<?php echo base_url('d/System/data_bank') ?>',
        method: "GET",
        success: function (resp) {
            $('#databank').html(resp);
            $('#loader').hide();
            $('[data-toggle="tooltip"]').tooltip();
            $(".textarea").wysihtml5();
            $('#dataTables-databank').DataTable();
        }
    });
  }

  function dataEmailSender(){
      $('#loader').show();
      $.ajax({
        url: '<?php echo base_url('d/System/data_email_sender') ?>',
        method: "GET",
        success: function (resp) {
            $('#dataemailsender').html(resp);
            $('#loader').hide();
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
  }
  
  function dataShipingGateway(){
      $('#loader').show();
      $.ajax({
        url: '<?php echo base_url('d/System/data_shiping_gateway') ?>',
        method: "GET",
        success: function (resp) {
            $('#datashipinggateway').html(resp);
            $('#loader').hide();
            $('[data-toggle="tooltip"]').tooltip();
            getProvinsi();
        }
    });
  }

  function orderSetting(){
      $('#loader').show();
      $.ajax({
        url: '<?php echo base_url('d/System/data_order_setting') ?>',
        method: "GET",
        success: function (resp) {
            $('#dataordersetting').html(resp);
            $('#loader').hide();
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
  }

</script>
