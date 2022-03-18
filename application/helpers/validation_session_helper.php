<?php

function valid_admin() {
    if (empty($_SESSION['iduser'])) {
        $report['status'] = 0;
        $report['message'] = '<script>swal("","Session Expired","error")</script>';
    } else if ($_SESSION['tipeuser'] != 1) {
        $report['status'] = 0;
        $report['message'] = '<script>swal("","Access Forbidden","error")</script>';
    } else {
        $report['status'] = 1;
        $report['message'] = 'OK';
    }
    return $report;
}
function valid_user() {
    if (empty($_SESSION['iduser'])) {
        $report['status'] = 0;
        $report['message'] = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your Session was Expired, please re login.</div>';
    } else if ($_SESSION['tipeuser'] == 1) {
        $report['status'] = 0;
        $report['message'] = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Your Session was Expired, please re login.</div>';
    } else {
        $report['status'] = 1;
        $report['message'] = 'OK';
    }
    return $report;
}
