@extends('layouts.add')
@section('content')
<div class="content container-fluid-nw">
    <div id="select">
        <h2>Failed to Connect</h2>
        <h6 class="mb-4">The server failed to connect to the electronic tag<br />Please try again</h6>
        <hr />
        <a href="{{route('add')}}" name="nmap_rescan" class="btn btn-outline-green w-75" style='line-height: 36px;'>Rescan</a>
        
    </div>
</div>
<br />
<script>
    
</script>
</div>
@endsection