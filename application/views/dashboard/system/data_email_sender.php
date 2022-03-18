 <div class="row">
    <div class="action pull-right">
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Mail Sender
                </h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <td>protocol</td>
                                <td>smtp_host</td>
                                <td>smtp_port</td>
                                <td>smtp_user</td>
                                <td>smtp_pass</td>
                                <td>mailtype</td>
                                <td>charset</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataemailsender as $value) { ?>
                            <tr>
                                <td><input class="form-control" name="protocol<?php echo $value->id;?>" id="protocol<?php echo $value->id;?>" value="<?php echo $value->protocol; ?>">
                                </td>
                                <td><input class="form-control" name="smtp_host<?php echo $value->id;?>" id="smtp_host<?php echo $value->id;?>" value="<?php echo $value->smtp_host; ?>">
                                </td>
                                <td><input class="form-control" name="smtp_port<?php echo $value->id;?>" id="smtp_port<?php echo $value->id;?>" value="<?php echo $value->smtp_port; ?>">
                                </td>
                                <td><input class="form-control" name="smtp_user<?php echo $value->id;?>" id="smtp_user<?php echo $value->id;?>" value="<?php echo $value->smtp_user; ?>">
                                </td>
                                <td><input class="form-control" type="password" name="smtp_pass<?php echo $value->id;?>" id="smtp_pass<?php echo $value->id;?>" value="<?php echo $value->smtp_pass; ?>">
                                </td>
                                <td><input class="form-control" name="mailtype<?php echo $value->id;?>" id="mailtype<?php echo $value->id;?>" value="<?php echo $value->mailtype; ?>">
                                </td>
                                <td><input class="form-control" name="charset<?php echo $value->id;?>" id="charset<?php echo $value->id;?>" value="<?php echo $value->charset; ?>">
                                </td>


                                <td align="center">
                                   <button class="btn btn-sm btn-primary" title="update setting" onclick="updateEmailSender('<?php echo $value->id; ?>');"><i class="fa fa-refresh"></i></button>
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
<script type="text/javascript">
   function updateEmailSender(id) {
    var protocol = $('#protocol' + id).val();
    var smtp_host = $('#smtp_host' + id).val();
    var smtp_port = $('#smtp_port' + id).val();
    var smtp_user = $('#smtp_user' + id).val();
    var smtp_pass = $('#smtp_pass' + id).val();
    var mailtype = $('#mailtype' + id).val();
    var charset = $('#charset' + id).val();
    $.ajax({
        url: "<?php echo base_url('d/System/update_email_sender'); ?>",
        method: "POST",
        data: {"id": id, "protocol": protocol, "smtp_host":smtp_host, "smtp_port":smtp_port, "smtp_user":smtp_user, "smtp_pass":smtp_pass, "mailtype":mailtype, "smtp_user":smtp_user, "charset":charset},
        success: function (data) {
            $('#alert').html(data);
            dataEmailSender();
        }
    });
}
</script>