@extends('layouts.app')
@section('content')
<div id="manual" class="w-100">
    <h2>
    @if($tag['ID'] == 0)
        Add
    @else
        Update
    @endif
    </h2>
    <h6 class="mb-4">Enter the information below</h6>
    <hr/>
    <p>
        Once the information has been filled out below, click 'Save to Tag' to update the tag data.
        <br/>
        The tag will then refresh its screen and will be ready to be placed on the store shelf.
    </p>
    <div class="mt-3 ml-lg-3">
        <div class="row manualArea">

            <div class="col-12 col-lg-7 p-0">
                <div class="row align-items-center">
                    <div class="col-12 col-md-5">
                        <input type="text" name="product_name" placeholder=" * Product Name" value="{{$tag['product_name']}}"/>
                        <input type="hidden" id="tag_ID" name="tag_ID" value="{{$tag['ID']}}" />
                        <input type="hidden" id="ip_address" name="ip_address" value="{{$tag['ip_address']}}" />
                        <input type="hidden" id="mac_address" name="mac_address" value="{{$tag['mac_address']}}" />

                    </div>
                    <div class="col-12 col-md-6">
                        <p>EG: 'Vegemite' or 'Coco Pops'</p>
                    </div>
                    <p id="name_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <input type="text" name="product_weight" placeholder=" * Product Unit Quantity" value="{{$tag->unit_quantity}}"/>
                        
                    </div>
                    <div class="col-12 col-md-6">
                        <p>The unit quantity of the product (EG: 100)</p>
                    </div>
                    <p id="gram_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">

                        <select name="product_unit" style="min-width: 152px; min-height: 45px;" class="w-100">
                            <option value="gramms" {{ ($tag->unit_of_measurement) == 'gramms' ? 'selected' : '' }}>gramms</option>
                            <option value="kilos" {{ ($tag->unit_of_measurement) == 'kilos' ? 'selected' : '' }}>kilos</option>
                            <option value="ml" {{ ($tag->unit_of_measurement) == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="litres" {{ ($tag->unit_of_measurement) == 'litres' ? 'selected' : '' }}>litres</option>
                            <option value="peices" {{ ($tag->unit_of_measurement) == 'peices' ? 'selected' : '' }}>peices</option>
                            <option value="sheets" {{ ($tag->unit_of_measurement) == 'sheets' ? 'selected' : '' }}>sheets</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Unit of measurement</p>
                    </div>
                    <p id="unit_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-1">
                                <span class="dollar">$</span>
                            </div>
                            <div class="col-4">
                                <input type="number" name="product_price" placeholder="55" value="{{$tag['product_price']}}"/>
                            </div>
                            <div class="col-1">
                                <span class="dot">.</span>
                            </div>
                            <div class="col-5">
                                <input type="number" name="product_price_decimal" placeholder="00" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Price of the individual item</p>
                    </div>
                    <p id="price_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <div class="row">
                            <div class="col-1">
                                <span class="dollar">$</span>
                            </div>
                            <div class="col-4">
                                <input type="number" name="product_breakdown_price" placeholder="55" value="{{$tag['breakdown_price']}}"/>
                            </div>
                            <div class="col-1">
                                <span class="dot">.</span>
                            </div>
                            <div class="col-5">
                                <input type="number" name="product_breakdown_price_decimal" placeholder="00"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Breakdown down product price</p>
                    </div>
                    <p id="weight_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <select name="product_breakdown_divisor" style="min-width: 152px; min-height: 45px;" class="w-100">
                            <option value="per" {{ ($tag->breakdown_divisor) == 'per' ? 'selected' : '' }}>per</option>
                            <option value="for" {{ ($tag->breakdown_divisor) == 'for' ? 'selected' : '' }}>for</option>
                            <option value="of" {{ ($tag->breakdown_divisor) == 'of' ? 'selected' : '' }}>of</option>
                            <option value="at" {{ ($tag->breakdown_divisor) == 'at' ? 'selected' : '' }}>at</option>
                            <option value="/">/</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Breakdown down divisor</p>
                    </div>
                    <p id="divisor_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <input type="text" name="product_breakdown_weight" placeholder=" * Breakdown Unit Quantity" value="{{$tag['breakdown_quantity']}}"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Breakdown down unit quantity of the product (EG: 100)</p>
                    </div>
                    <p id="breakdown_weight_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <div class="row pt-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <select name="product_breakdown_unit" style="min-width: 152px; min-height: 45px;" class="w-100">
                            <option value="gramms" {{ ($tag->breakdown_unit) == 'gramms' ? 'selected' : '' }}>gramms</option>
                            <option value="kilos" {{ ($tag->breakdown_unit) == 'kilos' ? 'selected' : '' }}>kilos</option>
                            <option value="ml" {{ ($tag->breakdown_unit) == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="litres" {{ ($tag->breakdown_unit) == 'litres' ? 'selected' : '' }}>litres</option>
                            <option value="peices" {{ ($tag->breakdown_unit) == 'peices' ? 'selected' : '' }}>peices</option>
                            <option value="sheets" {{ ($tag->breakdown_unit) == 'sheets' ? 'selected' : '' }}>sheets</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>Breakdown down unit of measurement</p>
                    </div>
                    <p id="breakdown_unit_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>

                <br/>
                Enabling this option will halve the price of the product and turn the screen yellow
                <div class="row pt-3 pl-3">
                    <div class="col-12 align-items-center">
                        <input type="checkbox" name="half" id="half"
                                style="transform: scale(1.4); cursor: pointer; margin-left: 3px;" >
                        <label class="pl-3 text-muted ms-1" for="half" style="cursor: pointer;"> Enable 1/2 (half) Price Mode</label>
                    </div>
                </div>
                <br />
                Enabling this option will permit you to add a sale price
                <div class="row pt-3 pl-3">
                    <div class="col-12 align-items-center">
                        <input type="checkbox" name="sale" id="sale"
                                style="transform: scale(1.4); cursor: pointer; margin-left: 2.5px;">
                        <label class="pl-3 text-muted ms-1" for="sale" style="cursor: pointer;"> Enable Sale Mode</label>
                    </div>
                </div>

                <div class="row pt-3 pl-3 align-items-center">
                    <div class="col-12 col-md-5">
                        <input type="text" disabled="disabled" name="product_sale_price" placeholder=" * Sale Price Value" />
                    </div>
                    <div class="col-12 col-md-6">
                        The new value of the product
                    </div>
                    <p id="sale_price_error" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>
                <br/>
                <div class="row pt-3 pb-3 pl-3 align-items-center">
                    <div class="col-10 w-100 d-flex align-items-center">
                        <div id="drop-area-manual" class="drop-area">
                            <p class="text-muted" style="text-align: center">Drag and Drop</p>
                            <input type="file" id="fileElem-manual" class="d-none" accept="image/*"
                                    onchange="handleFiles(this.files, '-manual')">
                            <div class="mt-2 mb-2 d-none" id="imageArea-manual">
                                <img id="imageViewer-manual" alt="" height="110" width="110">
                            </div>
                        </div>
                        <button type="button" class="ml-3 h-10 ms-5 btn btn-outline-green" id="fileBrowseButton-manual">Browse&nbsp;&nbsp;&nbsp;<i class="fas fa-file"></i></button>
                    </div>
                    <p id="image_error-manual" class="d-none p-1 mt-1 w-100 alert-danger"></p>
                </div>
                <br/>

                <div class="row pt-3 pl-3">
                    <div class="col-12 w-100">
                        <button class="btn btn-outline-green w-50 save-tag" style="height: 50px; width: 60px;">Save to Tag</button>
                        <p id="form_error" class="d-none p-1 mt-1 w-50 alert-danger"></p>
                    </div>
                </div>
                <br />
                <br />
            </div>

            <div class="col-12 col-lg-5 d-flex align-items-center flex-column">
                <h4>Realtime Viewer</h4>
                <div class="template_area_realtime" id="card-viewer" style="width: 315px;">
                    <div class="row justify-content-between p-2">
                        <div>
                            <div>
                                <span id="view-name" class="screen_product_name"></span>
                                <span id="view-product-weight" class="screen_product_name"></span>
                                <span id="view-product-unit" class="screen_product_name"></span>
                            </div>
                            <div style="position: absolute;bottom:12px;width: 42%;">
                                <p class="screen_product_wqty">
                                    <!-- TO DO: ADD THE CORRECT FIELDS HERE -->
                                    <span class="view-price-per-grams"></span>
                                    <span class="view-divisor">/</span>
                                    <span class="view-weight"></span>
                                    <span class="view-unit"></span>
                                </p>
                                <p style="border: 1px solid black; text-transform: uppercase;text-align: center;">
                                    barcode here
                                </p>
                            </div>
                        </div>
                        <div>
                            <div id="view-price-number-div" style="position: absolute;bottom: 19%;right: 38px;">
                                <h1 class="view-price-number screen_product_price"></h1>
                            </div>
                            <div style="position: absolute;bottom: 36%;right: 13px;">
                                <h2 class="view-price-decimal screen_product_price_sub"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

<script>
    $(document).ready(() => {
        const productName = $('input[name="product_name"]')
        const productPrice = $('input[name="product_price"]')
        const productPriceDecimal = $('input[name="product_price_decimal"]')
        const productUnit = $('select[name="product_unit"]')
        const productWeight = $('input[name="product_weight"]')

        const breakdownPrice = $('input[name="product_breakdown_price"]')
        const breakdownPriceDecimal = $('input[name="product_breakdown_price_decimal"]')
        const breakdownWeight = $('input[name="product_breakdown_weight"]')
        const breakdownDivisor = $('select[name="product_breakdown_divisor"]')
        const breakdownUnit = $('select[name="product_breakdown_unit"]')
        const saleMode = $('#sale')
        const halfInput = $('input[name="half"]')
        const imageUploaded = $('#imageViewer-manual')

        function registerViewEvents() {
            const events = 'change keyup paste click';
            const viewProductName = $('#card-viewer #view-name');

            const viewProductPriceNumber = $('#card-viewer .view-price-number');
            const viewProductPriceNumberDiv = $('#card-viewer #view-price-number-div');
            const viewProductPriceDecimal = $('#card-viewer .view-price-decimal');

            const viewBreakdownUnit = $('#card-viewer .view-unit');
            const viewBreakdownDivisor = $('#card-viewer .view-divisor');
            const viewBreakdownWeight = $('#card-viewer .view-weight');
            const viewBreakdownPrice = $('#card-viewer .view-price-per-grams')

            const viewProductUnit = $('#card-viewer #view-product-unit');
            const viewProductWeight = $('#card-viewer #view-product-weight');


            function handleProductName(value) {
                viewProductName.html(value || ' ')
                handleProductUnit(productUnit.val())
            }

            function handleProductPrice(price) {
                const display = price.replace(/(#|\$|\(|\)|\.|[a-z A-Z])/g, '').substr(0, 4)
                productPrice.val(display)

                viewProductPriceNumber.html(display)
                viewProductPriceNumber.css("font-size", `${70 - (display.length * 10)}px`)
                handleProductPriceDecimal(productPriceDecimal.val())
                if (price.substr(-1) === ".") {
                    productPriceDecimal.focus()
                }
            }

            function handleProductPriceDecimal(price) {
                let display = price.replace(/(#|\$|\(|\)|\.|[a-z A-Z])/g, '').substr(0, 2)
                productPriceDecimal.val(display)

                if (productPrice.val() === "") {
                    display = ""
                }
                viewProductPriceNumberDiv.css('right', `${ 18 + (20 * display.length) }px`)
                viewProductPriceDecimal.html(display)
            }

            function handleProductWeight(value) {
                viewProductWeight.html(value || '')
                handleProductUnit(productUnit.val())
            }

            function handleProductUnit(value) {
                if (productName.val() !== "" && productWeight.val() !== "") {
                    viewProductUnit.html(value || ' ')
                } else {
                    viewProductUnit.html(' ')
                }
            }

            function handleBreakdownWeight(value) {
                viewBreakdownWeight.html(value || '')
                handleBreakdownDivisor(breakdownDivisor.val())
                handleBreakdownUnit(breakdownUnit.val())
            }

            function handleBreakdownUnit(value) {
                if (breakdownPrice.val() !== "" && breakdownWeight.val() !== "") {
                    viewBreakdownUnit.html(value || ' ')
                } else {
                    viewBreakdownUnit.html('')
                }
            }

            function handleBreakdownDivisor(value) {
                if (breakdownPrice.val() !== "" && breakdownWeight.val() !== "") {
                    viewBreakdownDivisor.html(value || ' ')
                } else {
                    viewBreakdownDivisor.html('')
                }
            }

            function handleBreakdownPrice(value) {
                const display = value.replace(/(#|\$|\(|\)|\.|[a-z A-Z])/g, '').substr(0, 4)
                breakdownPrice.val(display)
                viewBreakdownPrice.html("$" + display + (breakdownPriceDecimal.val() && display ? "." + breakdownPriceDecimal.val() : ""))

                handleBreakdownDivisor(breakdownDivisor.val())
                handleBreakdownUnit(breakdownUnit.val())
                handleBreakdownPriceDecimal(breakdownPriceDecimal.val())
                if (value.substr(-1) === ".") {
                    breakdownPriceDecimal.focus()
                }
            }

            function handleBreakdownPriceDecimal(value) {
                const fixed = value.replace(/(#|\$|\(|\)|\.|[a-z A-Z])/g, '').substr(0, 2)
                breakdownPriceDecimal.val(fixed)
                if (breakdownPrice.val() === "") {
                    viewBreakdownPrice.html("")
                    return
                }

                viewBreakdownPrice.html("$" + breakdownPrice.val() + (breakdownPrice.val() && fixed ? "." + fixed : ""))
                handleBreakdownDivisor(breakdownDivisor.val())
                handleBreakdownUnit(breakdownUnit.val())
            }

            productName.on(events, e => handleProductName(e.target.value))
            productPrice.on(events, e => handleProductPrice(e.target.value))
            productPriceDecimal.on(events, e => handleProductPriceDecimal(e.target.value))
            productWeight.on(events, e => handleProductWeight(e.target.value))
            productUnit.on(events, e => handleProductUnit(e.target.value))

            breakdownUnit.on(events, e => handleBreakdownUnit(e.target.value))
            breakdownWeight.on(events, e => handleBreakdownWeight(e.target.value))
            breakdownPrice.on(events, e => handleBreakdownPrice(e.target.value))
            breakdownPriceDecimal.on(events, e => handleBreakdownPriceDecimal(e.target.value))
            breakdownDivisor.on(events, e => handleBreakdownDivisor(e.target.value))

            handleProductName(productName.val())
            handleProductPrice(productPrice.val())
            handleProductWeight(productWeight.val())
            handleProductUnit(productUnit.val())

            handleBreakdownPrice(breakdownPrice.val())
            handleBreakdownWeight(breakdownWeight.val())
            handleBreakdownDivisor(breakdownDivisor.val())
            handleBreakdownUnit(breakdownUnit.val())
        }

        registerViewEvents();


        
        // var csrf_token = $('meta[name="csrf-token"]').attr('content');
        // console.log(csrf_token);
        $('.save-tag').click(() => {
            swal({
                title: "Are you sure to?",
                text: "You will not be able to recover after this action",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
            })
            .then(function(isConfirm){
                if (isConfirm){
                    $.ajax({
                        url: "{{route('tag.update')}}",
                        type: 'POST',
                        data: {
                            id: $('#tag_ID').val(),
                            mac_address: $('#mac_address').val(),
                            ip_address: $('#ip_address').val(),
                            product_name: productName.val(),
                            unit_quantity: productWeight.val(),
                            unit_of_measurement: productUnit.val(),
                            breakdown_unit: breakdownUnit.val(),
                            breakdown_quantity: breakdownWeight.val(),
                            breakdown_divisor: breakdownDivisor.val(),
                            half_price_mode: halfInput.val(),
                            sale_mode: saleMode.val()

                        },
                        success: function(){
                            swal({
                            title: 'Success!',
                            text: 'You operation successfully finished!',
                            icon: 'success'})
                            .then(function(){
                                window.location="{{route('tag.index')}}";
                            });
                            
                        },
                        error: function(){
                            swal({
                            type: 'error',
                            title: 'Oops...',
                            icon: 'error',
                            text: 'Something went wrong!',
                            })                            
                        }
                    });
                        
                }
            })
        })

        
    });


</script>
@endpush