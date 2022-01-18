@extends('layouts.app')
@section('content')

<div class="content container-fluid-nw" style="position: relative; padding-left: 0; padding-right: 0; width: 100%;">
    <div class="row">
        <div class="col-sm-12">
            <div id="select" class="tag_page">
                <h2>Tags</h2>
                <h6 class="mb-4">Currently connected electronic ink tags</h6>
                <hr />
                <table class="table table-bordered tag-datatable flex-table table-hover" style="display: none">
                    <a href="/tag/search" class="btn tag-add btn-success a_add_btn"><i class="fas fa-plus"></i>&nbspAdd</a>
                    {{-- <button class="btn btn-success custom_search_btn"><i class="fas fa-sync-alt"></i>&nbsp;Refresh</button> --}}
                    <button class="btn btn-success custom_search_btn"><img id="refresh_img" src="{{asset('images/icons/refresh_animation.gif')}}" style="vertical-align: text-top"><i id="refresh_icon" class="fas fa-sync-alt" style="display: none"></i> &nbsp;Refresh</button>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Sale Mode</th>
                            <th>Half Price Mode</th>
                            <th>Half Price Value</th>
                            <th>Action</th>
                            <!-- <th>IP Address</th> -->
                            <!-- <th>MAC Address<th>
                            <th>Unit Quantity</th>
                            <th>Unit Measurement</th>
                            <th>Breakdown Price</th>
                            <th>Breakdown Unit</th>
                            <th>Barcode Data</th>
                            <th>Barcode ID</th>
                            <th>Sub Barcode ID</th>
                            <th>QR Code Data</th>                 -->
                            <!-- <th>a</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </p>
            </div>
            <div class="modal " tabindex="-1" id="detailModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Tag Information</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="mt-8 ml-lg-8">

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">

                                            <div class="row align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Number
                                                </div>
                                                <div class="col-6 col-md-6" id="detailNo">
                                                    <p id="detailNo">1</p>
                                                </div>
                                                <p id="name_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>
                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Product Name
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailName">Sodo</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    IP Address
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailIpAddr">192.168.121.1</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    MAC Address
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailMacAddr">XX:XX:XX:XX:XX:XX</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Product Price
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailProductprice">$3.5.0</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Unit Quantity
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailUnitquantity">650</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Unit Measurement
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailUnitmeasure">Litres</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>                        

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Breakdown Price
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBreakdownprice">$1.50</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Breakdown Unit
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBreakdownunit">Litres</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Breakdown Divisor
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBreakdowndivisor">$1.50</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Breakdown Unit Quantity
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBreakdownunitquantity">Litres</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Barcode Data
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBarcodedata">Yes</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Barcode ID
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailBarcodeid">1234</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Sub Barcode ID
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailSubbarcodeid">5678</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    QR Code Data
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailQRcode">Yes</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Sale Mode
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailSalemode">Yes</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Half Price Mode
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailHalfmode">False</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>

                                            <div class="row pt-3 align-items-center">
                                                <div class="col-6 col-md-6">
                                                    Half Price Value
                                                </div>
                                                <div class="col-6 col-md-6">
                                                    <p id="detailHalfprice">0</p>
                                                </div>
                                                <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12 col-lg-12 d-flex align-items-center flex-column tag_detail_info">
                                            <div class="selectMethod d-flex flex-column align-items-center">
                                                <!-- <div class="w-100 my-2">
                                                    <h5 class="text-center"><strong>Enter it Manually</strong></h5>
                                                </div> -->
                                                <div class="template_area">
                                                    <div class="row justify-content-between p-2">
                                                        <div style="width: 100%;">
                                                            <p class="screen_product_name">Quilton Pocket 4 Ply Hypo Allergenic Tissues - 6 Pack</p>
                                                            <div style="position: absolute;left: 202px;top: 6px;">
                                                                <img src="/vendor1/images/QR.BMP" alt="" width="50" height="50">
                                                            </div>

                                                            <div style="position: absolute;bottom:50px;">
                                                                <p class="screen_product_wqty">$3.33 / 100 Sheets</p>
                                                                <!--<p style="position: absolute;bottom:-35px; border: 1px solid black; text-transform: uppercase;text-align: center;">BARCODE</p>-->
                                                                <div style="position: absolute;bottom:-30px;">
                                                                    <img src="/vendor1/images/BARCODE.BMP" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div style="position: absolute;bottom: 16%;right: 48px;"><h1
                                                                    class="screen_product_price">2</h1></div>
                                                            <div style="position: absolute;bottom: 32%;right: 8px;"><h1
                                                                    class="screen_product_price_sub">50</h1></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal " tabindex="-1" id="activeTag">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Connecting to the tag</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row h5 justify-content-center">
                                    Attempting to connect to the&nbsp;<span id="tag_name" style="font-weight: bold">NULL</span>&nbsp;tag on&nbsp;<span id="tag_ip" style="font-weight: bold"></span>
									<br />
									<br />
                                </div>
                                <div class="row justify-content-center wait"></div>
								<br />
								<br />
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#DataTables_Table_0_wrapper').css('display','none');
        setTimeout(function(){
            document.getElementById('logout-form').submit();
        }, {{Config::get('session.lifetime')}}*60*1000);
    });
    var table = $('.tag-datatable').DataTable({
        language: {
            "info": "Showing _START_ of _TOTAL_ entries",
            "paginate": {
              "previous": "Prev"
            },
            "processing":null,
            // "processing": `<div class="spinner" id="ajax">
            //     <div class="spinner-item"></div>
            //     <div class="spinner-item"></div>
            //     <div class="spinner-item"></div>
            //     <div class="spinner-item"></div>
            //     <div class="spinner-item"></div>
            // </div>`,
        },

        "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if(iTotal == 0)
                return "Showing 0 of 0 entries";
            return "Showing "+iStart+" of "+iTotal+" entries";
        },
        "initComplete": function( settings, json ) {
            $('#DataTables_Table_0_processing').addClass('dataTables_processing_before_loading');
        },
        "dom":  "<'row'<'col-sm-12 col-md-12 col-12 cus_filter'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6 col-md-4 col-6'i><'col-sm-6 col-md-4 col-6'p><'col-sm-4 col-md-4 col-12'l>>",
        processing: true,
        serverSide: true,
        autoWidth: false,
        //responsive: true,
        ajax: {
            url: "{{ route('tag.dataTable') }}",

            type: "POST",
            data: { _token: '{!! csrf_token() !!}' }       
        },
        columns: [
            {
                data: 'DT_RowIndex',
                orderable: false, 
                searchable: false,
                target:0
            },            
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'product_name', name: 'product_name'},
            {data: 'product_price', name: 'product_price'},
            {data: 'sale_mode', name: 'sale_mode'},
            {data: 'half_price_mode', name: 'half_price_mode'},
            {data: 'half_price_value', name: 'half_price_value', render:function(data, type, row, meta){
                return (row.product_price.substr(1)*1/2);
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'ip_address', name: 'ip_address', visible: false, orderable: false, searchable: false},
            {data: 'mac_address', name: 'mac_address', visible: false, orderable: false, searchable: false},
            {data: 'unit_quantity', name:'unit_quantity', visible: false, orderable: false, searchable: false},
            {data: 'unit_of_measurement', name:'unit_of_measurement', visible: false, orderable: false, searchable: false},
            {data: 'breakdown_price', name:'breakdown_price', visible: false, orderable: false, searchable: false},
            {data: 'breakdown_unit', name:'breakdown_unit', visible: false, orderable: false, searchable: false},
            {data: 'barcode_data', name:'barcode_data', visible: false, orderable: false, searchable: false},
            {data: 'barcode_id', name:'barcode_id', visible: false, orderable: false, searchable: false},
            {data: 'sub_barcode_id', name:'sub_barcode_id', visible: false, orderable: false, searchable: false},
            {data: 'qr_code_data', name:'qr_code_data', visible: false, orderable: false, searchable: false},
        ],
        'aaSorting': [[1, 'asc']],
        "initComplete": function(){ 
            $('#refresh_img').css("display",'none');
            $('#refresh_icon').css("display",'inline-block');   
            $('#DataTables_Table_0_wrapper').css('display','block');
            $(".tag-datatable").show(); 
        }
    });
    $('.flex-table.table-bordered').css('width','100%');
    $('.flex-table.table-bordered').css('margin','0px auto 20px auto');
    $('#DataTables_Table_0_processing').removeClass('dataTables_processing_before_loading');

    $('.tag-datatable').on( 'draw.dt', function () {
        $('#DataTables_Table_0_processing').addClass('dataTables_processing_after_loading');
    } );
    async function show(theRow){
        //display detail
        $('#detailNo').html(theRow.ID);
        $('#detailName').html(theRow.product_name);
        $('#detailIpAddr').html(theRow.ip_address);
        $('#detailMacAddr').html(theRow.mac_address);
        $('#detailProductprice').html(theRow.product_price);
        $('#detailUnitquantity').html(theRow.unit_quantity);
        $('#detailUnitmeasure').html(theRow.unit_of_measurement);
        $('#detailBreakdownprice').html(theRow.breakdown_price);
        $('#detailBreakdownunit').html(theRow.breakdown_unit);
        $('#detailBreakdowndivisor').html(theRow.breakdown_divisor);
        $('#detailBreakdownunitquantity').html(theRow.breakdown_quantity);
        $('#detailBarcodedata').html(theRow.barcode_data);
        $('#detailBarcodeid').html(theRow.barcode_id);
        $('#detailSubbarcode').html(theRow.sub_barcode_id);
        $('#detailQRcode').html(theRow.qr_code_data);
        $('#detailSalemode').html(theRow.sale_mode);
        $('#detailHalfmode').html(theRow.half_price_mode);
        $('#detailHalfprice').html(theRow.half_price_value);
        
        //draw card
        $('.screen_product_name').html(theRow.product_name + ' - ' + theRow.unit_quantity + '&nbsp;' + theRow.unit_of_measurement);
        $('.screen_product_wqty').html(theRow.breakdown_price + ' / '+ theRow.breakdown_quantity + '&nbsp;' + theRow.breakdown_unit);
        var price = theRow.product_price.replace('$','');
        $('.screen_product_price').html(price.substr(0,price.indexOf('.')));
        $('.screen_product_price_sub').html(price.substr(price.indexOf('.')));


        $('#detailModal').modal('show');

    }
    $('.tag-datatable tbody').on('click', 'td', function (e) {

        // e.stopPropogation();
        if ($(this).index() == 6 ) { // provide index of your column in which you prevent row click here is column of 4 index
             return;
        }
        var $row = $(this).parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        show(theRow);
        // var data = table.row( this ).data();
        // alert( 'You clicked on '+data[0]+'\'s row' );
    } );

    $('body').on('click', '.detail_view', function(e) {

        if ($(this).index() == 6 ) { // provide index of your column in which you prevent row click here is column of 4 index
             return;
        }

        var $row = $(this).parent().parent()  // this is the row you wanted
        var theRow =  table.row($row).data();

        show(theRow);
    });

    $('body').on('click', '.delete', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var $row = $(this).parent().parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        let me = $(this),
            url = me.attr('href'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure you want to delete "'+theRow.product_name+'"?',
            text: "You will need to re-add this tag again afterwards",
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
                    success: function(){
                        $('.tag-datatable').DataTable().ajax.reload();
                        swal({
                            title: 'Deleted!',
                            text: 'Tag successfully deleted',
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

    $('.tag-add').click((e) => {
        e.preventDefault();
        $('.content').css('position: relative; padding-left: 0; padding-right: 0; width: 100%;')
        $('.content').html(`<h2>&nbsp;&nbsp;&nbsp;Scanning...</h2>
            <h6 class="mb-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Scanning for electronic ink tags on the network</h6>
            <hr />
            <div class="container" style="width: fit-content; margin:0 auto;">
                <div class="spinner" id="ajax">
                        <div class="spinner-item"></div>
                        <div class="spinner-item"></div>
                        <div class="spinner-item"></div>
                        <div class="spinner-item"></div>
                        <div class="spinner-item"></div>
                    </div>
                </div>
            </div>
        `);
        $.get("{{route('tag.search')}}", function(a, b){
            $('.content').html(a);
        })
    });

    $('.custom_search_btn').click((e) => {
        $('#refresh_img').css("display",'inline-block');
        $('#refresh_icon').css("display",'none');   
        table.ajax.reload(()=>{
            $('#refresh_img').css("display",'none');
            $('#refresh_icon').css("display",'inline-block');   
            // $('#DataTables_Table_0 tr td:nth-child(3)').css({'max-width': '100px','overflow': 'hidden','text-overflow': 'ellipsis','white-space': 'nowrap'})

        },true);
    });

    $('.cus_filter input').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );

    $('#DataTables_Table_0_wrapper > div.row:first-Child div').removeClass("col-sm-12 col-md-6");
    $('body').on('click', '.edit', function(e) {
        var $row = $(this).parent().parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        $('#tag_ip').html(theRow.ip_address);
        $('#tag_name').html(theRow.product_name);

		$.ajax({
            url: "{{ route('tag.checkConnection') }}",
            type: "POST",
            data: { _token: '{!! csrf_token() !!}',
                    ip:theRow.ip_address
                    },
            beforeSend: function() {
                $('.wait').html('<div class="spinner" id="ajax"><div class="spinner-item"></div><div class="spinner-item"></div><div class="spinner-item"></div><div class="spinner-item"></div><div class="spinner-item"></div></div>');
            },
            success: function (response) {
                if(response == 'alive'){
                    var senddata = {...theRow};
                    delete senddata.action;
                    window.location.href = "http://"+theRow.ip_address+"#{{csrf_token()}}&{{ url('/') }}&tagvalue="+JSON.stringify(senddata);
                    //window.location.href = "http://localhost/ESP32#{{csrf_token()}}&{{ url('/') }}&tagvalue="+JSON.stringify(senddata);
                    $('#activeTag').modal('hide');
                }
                else
                    $(".wait").html('<div class="h3" style="font-weight:noral;padding:30px 0px">The connection failed</div>');
			},
			error: function(jqXHR, textStatus, errorThrown) {
			   console.log(textStatus, errorThrown);
			}
		});



        $('#activeTag').modal('show');
    });
</script>
@endpush