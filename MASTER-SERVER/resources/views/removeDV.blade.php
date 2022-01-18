@extends('layouts.removeDVLayout')
@section('content')
<div class="content container-fluid-nw">
    <div id="select">
        <h2>Remove</h2>
        <h6 class="mb-4">Remove an electronic ink tag from the store shelves</h6>
        <hr />
        <p>
        <table class="table table-bordered tags-datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>IP Address</th>
                    <th>MAC Address</th>
                    <th>Product Price</th>
                    <th>Unit Quantity</th>
                    <th>Unit Measurement</th>
                    <th>Breakdown Price</th>
                    <th>Breakdown Quantity</th>
                    <th>Breakdown Unit</th>
                    <th>Barcode Data</th>
                    <th>Barcode ID</th>
                    <th>Sub Barcode Data</th>
                    <th>QR Code Data</th>
                    <th>Sale Mode</th>
                    <th>Half Price Mode</th>
                    <th>Half Price value</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        </p>
    </div>
</div>
<br />
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    console.log('load')
    var table = $('.tags-datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('tag.list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'product_name', name: 'product_name'},
            {data: 'ip_address', name: 'ip_address'},
            {data: 'mac_address', name: 'mac_address'},
            {data: 'product_price', name: 'product_price'},
            {data: 'unit_quantity', name: 'unit_quantity'},
            {data: 'unit_of_measurement', name: 'unit_of_measurement'},
            {data: 'breakdown_price', name: 'breakdown_price'},
            {data: 'breakdown_quantity', name: 'breakdown_quantity'},
            {data: 'breakdown_unit', name: 'breakdown_unit'},
            {data: 'barcode_data', name: 'barcode_data'},
            {data: 'barcode_id', name: 'barcode_id'},
            {data: 'sub_barcode_id', name: 'sub_barcode_id'},
            {data: 'qr_code_data', name: 'qr_code_data'},
            {data: 'sale_mode', name: 'sale_mode'},
            {data: 'half_price_mode', name: 'half_price_mode'},
            {data: 'half_price_value', name: 'half_price_value'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ],
        drawCallback: function(){
            console.log('redraw');
            $('.edit').click(function(){
                
            });

            $('.delete').click(function(){

            });
        }

    });
    

  });


  
</script>

@endsection