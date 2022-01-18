@extends('layouts.noticeLayout')
@section('content')

<div class="content container-fluid notice_page">
    <div id="select">
        <h2>Notices</h2>
        <h6 class="mb-4">Shows any warnings or errors from electronic ink tags in the store</h6>
        <hr />
        <div class="mainarea">
            <table class="table table-bordered notice-datatable flex-table table-hover" style="display: none">
                <button class="btn clearall btn-success " id="noticeclear"><i class="fas fa-times"></i>&nbsp;Clear All</button>
                <button class="btn btn-success custom_search_btn a_add_btn"><img id="refresh_img" src="{{asset('images/icons/refresh_animation.gif')}}" style="vertical-align: text-top"><i id="refresh_icon" class="fas fa-sync-alt" style="display: none"></i>&nbsp;Refresh</button>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Serverity</th>
                        <th>Error</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="modal " tabindex="-1" id="detailModal">
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
        $('#DataTables_Table_0_wrapper').css('display','none');
        setTimeout(function(){
            document.getElementById('logout-form').submit();
        }, {{Config::get('session.lifetime')}}*60*1000);
    });
    var table = $('.notice-datatable').DataTable({
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
            $('#refresh_img').css("display",'none');
            $('#refresh_icon').css("display",'inline-block');   
            $('#DataTables_Table_0_wrapper').css('display','block');
            $('table').show();
            $('#DataTables_Table_0 tr td:nth-child(3)').css({'max-width': '100px','overflow': 'hidden','text-overflow': 'ellipsis','white-space': 'nowrap'});
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
            url: "{{ route('notice.dataTable') }}",

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
            {data: 'serverity', name: 'Serverity',width:'15%',target:1,orderable:false,render: function(data, type, full, meta){
                var serverity_arr = ['Notice','Warning','Critical'];
                var color_arr = ['#008E0E','#FF6A00','#FF0000'];
                return serverity_arr[data] + '<div class="color" style="background-color:' + color_arr[data] + ';"></div>';}
            },
            {data: 'error', name: 'Error',width:'70%',render: function(data, type, full, meta){
                // return '<div style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 60%;">' + data + '</div>';}
                return data;}
            },
            {data: 'action', name: 'action', orderable: false, searchable: false,width:'10%'},
            {data: 'tag_name', name: 'tag_name', visible: false, orderable: false, searchable: false},
            {data: 'show', name: 'show', visible: false, orderable: false, searchable: false},
            {data: 'discover_date', name: 'discover_date', visible: false, orderable: false, searchable: false},
        ],
        'aaSorting': [[2, 'asc']]
    });
    $('.flex-table.table-bordered').css('margin','0px auto 20px auto');
    $('#DataTables_Table_0_processing').removeClass('dataTables_processing_before_loading');
    $('.notice-datatable').on( 'draw.dt', function () {
        $('#DataTables_Table_0_processing').addClass('dataTables_processing_after_loading');
    } );

    $('.notice-datatable tbody').on('click', 'td', function (e) {
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

    $('body').on('click', '.detail_view', function(e) {
        var $row = $(this).parent().parent()  // this is the row you wanted
        var theRow =  table.row($row).data();
        swal({
             // icon: 'success',
            text: theRow.error + '\n' + theRow.time,
            title: 'Notice details',
        });
    });

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
                    success: function(){
                        $('.notice-datatable').DataTable().ajax.reload();
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

    $('.custom_search_btn').click((e) => {
        $('#refresh_img').css("display",'inline-block');
        $('#refresh_icon').css("display",'none');   
        table.ajax.reload(()=>{
            $('#refresh_img').css("display",'none');
            $('#refresh_icon').css("display",'inline-block');   
            $('#DataTables_Table_0 tr td:nth-child(3)').css({'max-width': '100px','overflow': 'hidden','text-overflow': 'ellipsis','white-space': 'nowrap'});

        },true);
    });
    $('#noticeclear').click((e) => {
        swal({
            title: "Are you sure you want to clear all data?",
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
                    url: "{{route('notice.clearall')}}",
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(){
                        $('.notice-datatable').DataTable().ajax.reload();
                        swal({
                            title: 'Deleted!',
                            text: 'All of the data are successfully deleted!',
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
        });    });

    $('#DataTables_Table_0_wrapper > div.row:first-Child div').removeClass("col-sm-12 col-md-6");

    $('.cus_filter input').on( 'keyup', function () {
        table.search( this.value ).draw();
    } );
</script>
@endpush