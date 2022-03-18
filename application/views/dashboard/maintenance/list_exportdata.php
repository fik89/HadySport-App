<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Export Data</h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Daftar Export Data
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <a href="JavaScript:void(0);"  data-toggle="modal" data-target="#modalinvoiceorder" class="list-group-item">
                            <i class="fa fa-file-pdf-o fa-fw"></i> Exportdata Invoice Order
                        </a>

                        <a href="JavaScript:void(0);"  data-toggle="modal" data-target="#modallabelshiping" class="list-group-item">
                            <i class="fa fa-barcode fa-fw"></i> Exportdata Label Shiping box
                        </a>

                        <a href="JavaScript:void(0);" onclick="choosePeriode();" data-toggle="modal" data-target="#modalltv" class="list-group-item">
                        <i class="fa fa-facebook fa-fw"></i> Export Ltv Customer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalinvoiceorder">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white text-center">
                Export / Cetak Invoice Order
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nomor Order / Invoice</label>
                    <input class="form-control" type="text" name="idorderinvoiceorder" id="idorderinvoiceorder">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-primary" onclick="exportInvoiceOrder();">Cetak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modallabelshiping">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white text-center">
                Export / Cetak Label Shiping
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nomor Order / Invoice</label>
                    <input class="form-control" type="text" name="idorderlabel" id="idorderlabel">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-primary" onclick="exportLabelShiping();">Cetak</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalltv">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-white text-center">
                Export /ltv
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih Periode</label>
                    <select class="form-control" name="periode" id="periode" onchange="choosePeriode();">
                        <option>Pilih Periode</option>
                        <option value="all">All Data</option>
                        <option value="bydate">Berdasarkan tanggal</option>
                    </select>
                </div>
                <div class="form-group" id="sdate">
                    <label>Tanggal Awal</label>
                    <input type="date" name="startdate" id="startdate">
                </div>
                <div class="form-group" id="ndate">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="enddate" id="enddate">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-primary" onclick="exportLtv();">Cetak</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function exportLabelShiping(){
        var id = $('#idorderlabel').val();
        window.open('<?php echo base_url('d/Exportdata/export_shiping_label_pdf?idorder=')?>'+id);
    }

    function exportInvoiceOrder(){
        var id = $('#idorderinvoiceorder').val();
        window.open('<?php echo base_url('d/Exportdata/export_invoice_pdf?idorder=')?>'+id);
    }

    function choosePeriode(){
       $('#ndate').hide();
       $('#sdate').hide();
       var period = $('#periode').val();
       if (period === "bydate"){
        $('#ndate').show("slow");
        $('#sdate').show("slow");
    }
}

    function exportLtv(){
       var sdate = $('#startdate').val();
       var ndate = $('#enddate').val();

        window.open('<?php echo base_url('d/Exportdata/export_ltv_excel?startdate=')?>'+ sdate +'&enddate='+ ndate);
    }

</script>