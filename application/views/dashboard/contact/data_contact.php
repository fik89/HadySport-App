<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Data Pesan
        </h3>
        <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Data Pesan Masuk 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" id="dataTables-dataContact">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>HP</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->email; ?></td>
                                        <td><?php echo $value->phone; ?></td>
                                        <td><?php echo $value->message; ?></td>
                                        <td><?php echo $value->date_create; ?></td>
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