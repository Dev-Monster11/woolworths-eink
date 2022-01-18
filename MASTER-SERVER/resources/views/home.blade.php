@extends('layouts.app')
@section('content')
<div class="content container-fluid-nw" style="width: 100%;">
    <div id="select">
        <h2>Overview</h2>
        <h6 class="mb-4">General overview of the electronic ink system</h6>
        <hr />
    </div>
    <div class="container overview_page">
        <div id="sys_msg_section">
            <table class="table">
                <thead>
                    <tr>
                        <th>System Messages</th>
                    </tr>
                </thead>
                <tr>
                    @php
                        if($cur_sys_status == 0) {
                    @endphp
                        <td id="sys_status" onclick="location.href='/notices'">All systems normal and optional <i class="fas fa-check"></i></td>
                    @php 
                       } else {
                    @endphp
                        <td id="sys_status" onclick="location.href='/notices'">This system has errors that need to be checked <i class="fas fa-times" style="color:red"></i></td>
                    @php 
                       }
                    @endphp
                </tr>
                <tr>
                    <td id="cur_con_tag" onclick="location.href='/tag'">Number of connected tags: {{$tagcount}}<i class="fas fa-tag"></i></td>
                </tr>
                <tr>    
                    <td id="current_user_email" onclick="location.href='/settings'">
                        @if($user['name'] == 'Administrator')
                            You are logged in as {{$user['email']}} (Administrative rights are permitted)<span><i class="fas fa-angle-right"></i></span>
                        @else
                            You are logged in as {{$user['email']}} (Administrative rights not permitted)<span><i class="fas fa-angle-right"></i></span>
                        @endif  
                    </td>
                </tr>
            </table>
        </div>
        <div id="notice_section">
            <table class="table overview_notice_page table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Serverity</th>
                        <th width="65%">Error</th>
                        <th width="10%" style="min-width: 135px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="tag_img_section">
            <div class="row tag_list">
                <div id="tr_tag" class="col-md-6">
                    <div class="tag_header">
                        Most Recently Added Tag
                    </div>
                    <div class="tag_body">
                        <div class="row tag_info">
                            <div class="template_area_realtime">
                                <div class="row justify-content-between p-2">
                                    <div style="width: 100%;">
                                        <p class="screen_product_name">{{$la_tag['product_name'] . ' - ' . $la_tag['unit_quantity'] . ' '. $la_tag['unit_of_measurement']}}</p>
                                        <div style="position: absolute;left: 202px;top: 6px;">
                                            <img src="/vendor1/images/QR.BMP" alt="" width="50" height="50">
                                        </div>

                                        <div style="position: absolute;bottom:50px;">
                                            <p class="screen_product_wqty">{{$la_tag['breakdown_price'] . ' ' . $la_tag['breakdown_divisor'] . ' '. $la_tag['breakdown_quantity'] . ' '. $la_tag['breakdown_unit']}}</p>
                                            <!--<p style="position: absolute;bottom:-35px; border: 1px solid black; text-transform: uppercase;text-align: center;">BARCODE</p>-->
                                            <div style="position: absolute;bottom:-30px;">
                                                <img src="/vendor1/images/BARCODE.BMP" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="position: absolute;bottom: 16%;right: 48px;">
                                            <h1 class="screen_product_price">
                                                <?php $price = $la_tag['product_price']; 
                                                $price = str_replace('$','',$price); 
                                                $buffer = explode('.',$price); 
                                                echo $buffer[0]; ?>
                                                </h1>
                                            </div>
                                        <div style="position: absolute;bottom: 32%;right: 8px;"><h1
                                                class="screen_product_price_sub">{{$buffer[1]}}</h1></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="mre_barcode"></span>
                    </div>
                </div>
                <div id="tl_tag" class="col-md-6">
                    <div class="tag_header">
                        Last Recently Edited Tag
                    </div>
                    <div class="tag_body">
                        <div class="row tag_info">
                            <div class="template_area_realtime">
                                <div class="row justify-content-between p-2">
                                    <div style="width: 100%;">
                                        <p class="screen_product_name">{{$lu_tag['product_name'] . ' - ' . $lu_tag['unit_quantity'] . ' '. $lu_tag['unit_of_measurement']}}</p>
                                        <div style="position: absolute;left: 202px;top: 6px;">
                                            <img src="/vendor1/images/QR.BMP" alt="" width="50" height="50">
                                        </div>

                                        <div style="position: absolute;bottom:50px;">
                                            <p class="screen_product_wqty">{{$lu_tag['breakdown_price'] . ' ' . $lu_tag['breakdown_divisor'] . ' '. $lu_tag['breakdown_quantity'] . ' '. $lu_tag['breakdown_unit']}}</p>
                                            <!--<p style="position: absolute;bottom:-35px; border: 1px solid black; text-transform: uppercase;text-align: center;">BARCODE</p>-->
                                            <div style="position: absolute;bottom:-30px;">
                                                <img src="/vendor1/images/BARCODE.BMP" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div style="position: absolute;bottom: 16%;right: 48px;">
                                            <h1 class="screen_product_price">
                                                <?php $price = $lu_tag['product_price']; 
                                                $price = str_replace('$','',$price); 
                                                $buffer = explode('.',$price); 
                                                echo $buffer[0]; ?>
                                                </h1>
                                            </div>
                                        <div style="position: absolute;bottom: 32%;right: 8px;"><h1
                                                class="screen_product_price_sub">{{$buffer[1]}}</h1></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="mre_barcode"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="detailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Notice Information</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-3">TagName</div>
                            <div class="col-md-9 col-sm-9 col-9 d_tagname">
                            </div>
                        </div>                            
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-3">Error</div>
                            <div class="col-md-9 col-sm-9 col-9 d_error">
                            </div>
                        </div>                            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
</div>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            document.getElementById('logout-form').submit();
        }, {{Config::get('session.lifetime')}}*60*1000);
    });
    var table = $('.overview_notice_page').DataTable({
        language: {
            "info": "Showing _START_ of _TOTAL_ entries",
            "paginate": {
              "previous": "Prev"
            },
            "processing": `<div class="spinner" id="ajax">
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
            </div>`,
        },

        "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if(iTotal == 0)
                return "Showing 0 of 0 entries";
            return "Showing "+iStart+" of "+iTotal+" entries";
        },

        "initComplete": function( settings, json ) {
            $('#DataTables_Table_0 tr td:nth-child(3)').css({'max-width': '100px','overflow': 'hidden','text-overflow': 'ellipsis','white-space': 'nowrap'})
            $('#DataTables_Table_0_processing').addClass('dataTables_processing_before_loading_overview card');
        },

        processing: true,
        serverSide: true,
        "bPaginate": false,
        "bLengthChange": true,
        "bInfo": false,
        "bFilter": false,
        //responsive: true,
        ajax: {
            url: "{{ route('home.dataTable') }}",

            type: "POST",
            data: { _token: '{!! csrf_token() !!}' }       
        },
        columns: [
            {
                data: 'DT_RowIndex',
                orderable: false, 
                searchable: false,
                target:0,
                width:'5%'
            },            
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'serverity', name: 'Serverity',width:'20%',orderable: false,render: function(data, type, full, meta){
                var serverity_arr = ['Notice','Warning','Critical'];
                var color_arr = ['#008E0E','#FF6A00','#FF0000'];

                return serverity_arr[data] + '<div class="color" style="background-color:' + color_arr[data] + ';"></div>';}
            },
            {data: 'error', name: 'Error',orderable: false,width:'65%',target:1,render: function(data, type, full, meta){
                // return '<div style="max-width: 100px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">' + data + '</div>';
                return data;
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false,width:'10%'},
            {data: 'tag_name', name: 'tag_name', visible: false, orderable: false, searchable: false},
            {data: 'show', name: 'show', visible: false, orderable: false, searchable: false},
        ],
        'aaSorting': [[5, 'asc']]
    });
    $('#DataTables_Table_0_processing').css('margin','-81px auto 0px auto');
    $('#DataTables_Table_0_processing').css('min-width','409px');
    $('#DataTables_Table_0_processing').css('width','80%');
    $('#DataTables_Table_0_processing').removeClass('dataTables_processing_before_loading_overview');
    // $('.overview_notice_page').on( 'draw.dt', function () {
    //     $('#DataTables_Table_0_processing').addClass('dataTables_processing_after_loading');
    // } );

    $('body').on('click', '.detail_view', function(e) {
        var $row = $(this).parent().parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        swal({
            text: theRow.error.replace(/&quot;/g, '"') + '\n\n' + theRow.time,
            title: 'Notice details',
        });
    });

    $('.overview_notice_page tbody').on('click', 'td', function (e) {
        if ($(this).index() == 6 ) { // provide index of your column in which you prevent row click here is column of 4 index
             return;
        }
        var $row = $(this).parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        swal({
             // icon: 'success',
             text: theRow.error.replace(/&quot;/g, '"') + '\n\n' + theRow.time,
            title: 'Notice details',
        });
    } );

    $('body').on('click', '.delete', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let me = $(this),
            url = me.attr('href'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: "Are you sure you want to delete this notice?",
            text: "You will not be able to recover after this action",
            icon: "warning",
            buttons: [
                'No, cancel it',
                'Yes, I am sure'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm){
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data){
                        console.log(data);
                        $('.overview_notice_page').DataTable().ajax.reload(()=>{
                            $('#DataTables_Table_0 tr td:nth-child(3)').css({'max-width': '100px','overflow': 'hidden','text-overflow': 'ellipsis','white-space': 'nowrap'});
                        });
                        swal({
                            title: 'Deleted!',
                            text: 'Notice was successfully deleted',
                            icon: 'success'});
                    },
                    error: function(){
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                        })
                    }
                })
            }
        });
    });
</script>
@endpush