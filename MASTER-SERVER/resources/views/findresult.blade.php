<div class="row">
    <div class="col-sm-12">
        <div id="select" class="w-100 tag_add">
            <h2>Add a Tag</h2>
            @if(isset($search_data))
            <h6 class="mb-4">Scan Error</h6>
            @else
            <h6 class="mb-4">Results of the network search</h6>
            @endif
            <hr>
            @if(isset($search_data))
            <div class="notice_text">
                {{$search_data['msg']}}<br>
                {{$search_data['msg2']}}
                <div>
                    <a href="/tag" class="btn">< Back</a> 
                </div> 
            </div> 
            @endif 
            @if(isset($tags)) 
            <table id="tagList" class="table-bordered tag-datatable table flex-table table-hover">
                <button class="btn btn-success custom_search_btn tag-add a_add_btn"><i class="fas fa-search"></i>&nbsp;Rescan</button>
                <thead>
                    <tr>
                        <td>IP Address &nbsp;<i class="fa fa-wifi"></td>
                        <td>MAC Address &nbsp;<i class="fa fa-location-arrow"></td>
                        <td>Vendor ID &nbsp;<i class="fa fa-id-card"></td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag['ip_address']}}</td>
                        <td>{{$tag['mac_address']}}</td>
                        <td>{{$tag['vendor']}}</td>
                        <td>
                            <input name="ip_address" type="hidden" value="{{$tag['ip_address']}}" />
                            <input name="mac_address" type="hidden" value="{{$tag['mac_address']}}" />
                            <input name="id" type="hidden" value="{{$tag['id']}}" />
                            @if($tag['id'] > 0)
                            <a href="http://{{ $tag['ip_address'] }}#{{csrf_token()}}&{{ url('/') }}&tagvalue={{$tag['value']}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i>&nbspEdit</a>
                            <!--<a href="http://{{ $tag['ip_address'] }}?token={{csrf_token()}}&ms_ip={{ url('/') }}" class="btn btn-success"><i class="fas fa-pencil-alt"></i>&nbspEdit</a>-->
        
                            <!-- <a href="http://localhost/ESP32#{{csrf_token()}}&{{ url('/') }}&tagvalue={{$tag['value']}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i>&nbspAdd</a> -->
                            @else
                            <a href="http://{{$tag['ip_address']}}#{{csrf_token()}}&{{ url('/') }}&mac={{$tag['mac_address']}}" class="btn btn-success"><i class="fas fa-plus"></i>&nbspAdd</a>
                            <!--<a href="http://{{$tag['ip_address']}}?token={{csrf_token()}}&ms_ip={{ url('/') }}" class="btn btn-success"><i class="fas fa-plus"></i>&nbspAdd</a>-->
        
                            <!-- <a href="http://localhost/ESP32#{{csrf_token()}}&{{ url('/') }}&mac={{$tag['mac_address']}}" class="btn btn-success"><i class="fas fa-plus"></i>&nbspAdd</a> -->
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
            <br />
        </div>
        
        <div class="footer_white_bar">
            <p>&nbsp;</p>
        </div>
        <div class="footer_copyright">
            <p id="footer-text">Copyright (&copy;) Woolworths Group Limited 2021. All Rights Reserved.</p>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        var tagList = $('#tagList').DataTable({
            language: {
                "info": "Showing _START_ of _TOTAL_ entries",
                "paginate": {
                    "previous": "Prev"
                }
            },

            "fnInfoCallback": function (oSettings, iStart, iEnd, iMax, iTotal, sPre) {
                return "Showing " + iStart + " of " + iTotal + " entries";
            },
            "dom": "<'row'<'col-sm-12 col-md-12 col-12 cus_filter'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6 col-md-4 col-6'i><'col-sm-6 col-md-4 col-6'p><'col-sm-4 col-md-4 col-12'l>>",
            processing: true,
            responsive: true
        })

        $('.a_add_btn').click((e) => {
            e.preventDefault();
            $('.content').css(
                'position: relative; padding-left: 0; padding-right: 0; width: 100%;')
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
            $.get("{{route('tag.search')}}", function (a, b) {
                $('.content').html(a);
            })
        });
        $('#tagList_length').parent().css('padding-right','0px');
        $('.content.container-fluid-nw').css('min-width','660px');
        // $('#tagList_wrapper > div.row:first-Child div').removeClass("col-sm-12 col-md-6");
        // $('#tagList_wrapper > div.row:first-Child > div').addClass("takeoff");
    })

</script>
