@extends('layouts.settingLayout')
@section('content')
<div class="content container-fluid-nw" style="width: 100%;">
    <div id="select">
        <h2>Settings</h2>
        <h6 class="mb-4">Configure electronic ink tag settings</h6>
        <hr />
    </div>
    <div class="container setting_page">  
        <div class="row">
            <!-- Text input-->
            <label class="col-md-3 control-label">Logged In As:</label>  
            <div class="col-md-6 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input  name="current_user_email" value="<?php echo $data['current_user'];?>" placeholder="First Name" class="form-control"  type="text" readonly>
                    <span>The current logged in user</span>
                </div>
            </div>
        </div>
        <!-- Text input-->
        <div class="row">
            <label class="col-md-3 control-label" >Server IP Address:</label> 
            <div class="col-md-6 inputGroupContainer server_ip">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input name="ms_ip" value="<?php echo $data['server_address'];?>" class="form-control server_addr_input"  type="text" placeholder="192.168.1.1">
                    <span>The IP address of the server</span>
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="row ip_range">
            <label class="col-md-3 control-label">IP Address Range:</label>  
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="ip_from" value="<?php echo $data['ip_from'];?>" class="form-control"  type="text" placeholder="192.168.1.1">
                </div>
                <div class="ip_range_desc">The IP address range of eInk tags to scan in</div>
            </div>

            <span class="control-label to">to</span> 
            <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                    <input name="ip_to" value="<?php echo $data['ip_to'];?>" class="form-control" type="text" placeholder="192.168.1.100">
                </div>
            </div>
        </div>
		
		<!--
        <div class="row ip_range">
            <label class="col-md-3 control-label">CIDR Range:</label>  
            <div class="col-md-2 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input name="cidr_range" value="<?php /*echo $data['cidr_range'];*/ ?>" class="form-control" type="text" placeholder="24">
                </div>
                <div class="ip_range_desc">The classless inter-domain routing range</div>
            </div>
        </div>
		-->

        <!-- Text input-->
        <div class="row">
          <label class="col-md-3 control-label">Store Location:</label>  
            <div class="col-md-9 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="address" value="<?php echo $data['store_location'];?>" class="form-control" type="text" readonly>
                    <span>The location of the store this system is being ran from</span>
                </div>
            </div>
        </div>

        <!-- Text input-->
        <div class="row sys_id">
            <label class="col-md-3 control-label">System Identification:</label>  
            <div class="col-md-3 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="system_id" value="<?php echo $data['system_id'];?>" class="form-control"  type="text" readonly>
                </div>
                <div class="sys_id_desc">The system identification which is used for license purposes</div>
            </div>
        </div>

        <!-- Text input-->
        <div class="row sys_id">
            <label class="col-md-3 control-label">System Version:</label>  
            <div class="col-md-3 inputGroupContainer">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                    <input name="system_version" value="<?php echo $data['system_ver'];?>" class="form-control"  type="text" readonly>
                </div>
                <div class="sys_id_desc">The system version</div>
            </div>
        </div>

        <!-- Submit input-->
        <div class="row">
            <input class="form-control submit_setting" value="+ Save" onclick="saveSetting()" type="submit">
        </div>
    </div><!-- /.container -->
</div>
</div>
<br />
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        setTimeout(function(){
            document.getElementById('logout-form').submit();
        }, {{Config::get('session.lifetime')}}*60*1000);
    });
    var saveSetting =function() {

        var cur_user    = $( "input[name=current_user_email]" ).val();
        var ms_ip       = $( "input[name=ms_ip]" ).val();
        var ip_from     = $( "input[name=ip_from]" ).val();
        var ip_to       = $( "input[name=ip_to]" ).val();
		//var cidr_range  = $( "input[name=cidr_range]" ).val();
        var address     = $( "input[name=address]" ).val();
        var system_id   = $( "input[name=system_id]" ).val();
        var system_ver  = $( "input[name=system_version]" ).val();

        $.ajax({
            type: "POST",
            url: "/settings/update",
            data: JSON.stringify({ 
                cur_user:   cur_user,
                ms_ip:      ms_ip,
                ip_from:    ip_from,
                ip_to:      ip_to,
                //cidr_range: cidr_range,
                address:    address,
                system_id:  system_id,
                system_ver: system_ver,
            }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){
                if(data.status == 'redirect') {
                    window.location.replace('/notices');
                }
                else if(data.status == 'success') {
                    swal({
                        title: 'Success',
                        text: data.message,
                        icon: data.status,
                    });
                } else {
                    swal({
                        title: 'Failed',
                        text: data.message,
                        icon: data.status,
                    });
                }
            }
        });
    }

    $('input[name=ms_ip]').mask('0ZZ.0ZZ.0ZZ.0ZZ', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });
    $('input[name=ip_to]').mask('0ZZ.0ZZ.0ZZ.0ZZ', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });
	$('input[name=ip_from]').mask('0ZZ.0ZZ.0ZZ.0ZZ', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });
	//$('input[name=cidr_range]').mask('0Z', { translation: { 'Z': { pattern: /[0-9]/, optional: true } } });
    
</script>
@endsection