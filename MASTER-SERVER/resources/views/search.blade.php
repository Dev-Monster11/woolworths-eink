@extends('layouts.searchLayout')
@section('content')

<div class="content container-fluid-nw">
    <div id="select">
        <h2>Search</h2>
        <h6 class="mb-4">Find an electronic ink tag in the store to read information from it</h6>
        <hr />
        <p>
            You can search the entire store by entering either a product name, price, barcode number or the MAC address of the eInk tag
            <br />
        <form>
            <label for="fname"></label>&nbsp;<input type="text" id="search" name="search">
            <br />
            <br />
            <input type="submit" class="btn btn-outline-green w-50" value="Search">
        </form>
    </div>
</div>
<br />
</div>

@endsection