@extends('layouts.add')

@section('content')
<!--<div class="content container-fluid-nw">-->
<div class="content container-fluid-nw" style="position: relative; padding-left: 0; padding-right: 0; width: 100%;">
	<h2>&nbsp;&nbsp;&nbsp;Add</h2>
	<h6 class="mb-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Scanning for electronic ink tags on the network</h6>
	<hr />
    <div class="container" style="width: fit-content; margin: auto;">
        <div class="spinner" id="ajax">
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
                <div class="spinner-item"></div>
            </div>
        </div>
    </div>
</div>

@endsection