@extends('layouts.scheduleLayout')
@section('content')
@push('css')
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
    <link rel="stylesheet" href="{{asset('css/schedule.css')}}">
@endpush
<div class="content container-fluid-nw">
    <div id="select">
        <h2>Schedule</h2>
        <h6 class="mb-4">Setup automatic events such as battery monitoring and ticket price updates from Woolworths head office</h6>
        <hr />
        <div class="part">
            <div class="workingarea">
                <div class="row" style="width: 100%;margin: 0px;">
                    <div class="arrowleft">
                        <i class="fa fa-caret-left arrow" onclick="javascript:change();"></i>
                    </div>
                    <table style="width:90%">
                        <tr style="font-weight: bold;">
                        @foreach($weekdata as $key=>$value)
                            <td>{{$key}}
                            </td>
                        @endforeach
                        </tr>
                        <tr class="color_range" id="back">
                        </tr>
                    </table>
                    <div class="arrowright">
                        <i class="fa fa-caret-right arrow" onclick="javascript:change();"></i>
                    </div>
                </div>
                <br>
                <div class="color_schedule">
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<br />
</div>
<!-- ---------------------------------Edit-Dialog------------------------------------ -->
<div class="modal " tabindex="-1" id="detailModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                        <div class="row">
                            <div style="width:5%">&nbsp;</div>
                            <table style="width:90%">
                                <tr style="font-weight: bold;">
                                @foreach($weekdata as $key=>$value)
                                    <td>{{$key}}
                                    </td>
                                @endforeach
                                </tr>
                                <tr class="color_range" id="modal">
                                </tr>
                            </table>
                            <div style="width:5%">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-right:13px">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <br>
                    <div class="form-group ordinary">
                        <div class="task">
                            <label for="task">What task would you like to add?</label>
                            <select class="form-control" onchange="changeform(this.value)" id="task" name="taskselect">
                                @foreach($schedule_arr as $key=>$value)
                                <option value="{{$value['id']}}">{{$value['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="commandtype">
                            <label for="commandtype">How would you like to execute it?</label>
                            <select class="form-control" id="commandtype" name="commandtyeselect">
                                <option value="0">proc_open</option>
                                <option value="1">exec</option>
                            </select>
                        </div>
                        <div class="day">
                        <label for="day">What day would you like to run it?</label>
                        <select class="form-control" id="day" name="dayselect">
                            @foreach($week_arr as $key=>$value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="timeset">
                            <label for="hour">Lastly, at what time would you like to run it?</label>
                            <div class="time">
                                <select class="form-control" id="hour" name="hourselect">
                                    @for($i = 12; $i > 0; $i--)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <select class="form-control" id="minute" name="minuteselect">
                                    <option value="0">0</option>
                                    <option value="30">30</option>
                                </select>
                                <select class="form-control" id="halfday" name="halfdayselect">
                                    <option value = '0'>AM</option>
                                    <option value = '1'>PM</option>
                                </select>
                            </div>
                            </div>
                    </div>
                </div>
                <div class="ordinary">
                    <div class="command">
                    <label for="command">What is the command?</label>
                    <input type="input" id="command" name="command">
                    </div>
                    <br>
                    <input type="button" id="na" onclick="javascript:save()"  class="btn btn-outline-green w-10" value="Add Task" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ---------------------------------View-Dialog------------------------------------ -->
<div class="modal " tabindex="-1" id="ViewModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="modal-header">
                        &nbsp;
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>        
                    </div>
                    <div class="row viewtable">
                        <table>
                            <tr style="font-weight: bold;">
                                <td id='viewweekdaytitle'>
                                </td>
                                <td id="viewweekdaydata" rowspan="2">
                                </td>
                            </tr>
                            <tr>
                                <td id='viewweekdaycolor'>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="ordinary">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){
            document.getElementById('logout-form').submit();
        }, {{Config::get('session.lifetime')}}*60*1000);
        var jsondata = <?php echo json_encode($weekdata);?>;
        drawTable(jsondata);
        $('.fa-caret-left').css('display','none');
        $('.command').css('display','none');
        $('.commandtype').css('display','none');
        var height = $('.row.first').height();
        $('.row.first').parent().height(height*4);
        var width = $('#back').find('td').width();
        $('#back').height(width);
        $('#back .sch').height(width/2);
    });
    window.flag = false;
    // var resizeTimer;
    $(window).resize(function(){
        // if (resizeTimer) {
        //     clearTimeout(resizeTimer);   // clear any previous pending timer
        // }
        // resizeTimer = setTimeout(function() {
        //     resizeTimer = null;
            var height = $('.row.first').height();
            $('.row.first').parent().height(height*4);
            makesameheight();
        // }, 100);  
    });
    $('#sidebarCollapse').click(function(){
        setTimeout(function(){
            makesameheight();
        }, 200);
    });
    function makesameheight(){
        var width = $('#back').find('td').width();
        $('#back').height(width);
        $('#back .sch').height(width/2);
        var width = $('#modal').find('td').width();
        $('#modal').height(width);
        $('#modal .sch').height(width/2);
        var width = $('#viewweekdaytitle').width();
        $('#viewweekdaycolor').height(width);
    }
    function change(){
        window.flag = !window.flag;
        window.schedule_id = 'undefine';
        if(window.flag){
            $('.fa-caret-right').css('display','none');
            $('.fa-caret-left').css('display','block');
        }else{
            $('.fa-caret-left').css('display','none');
            $('.fa-caret-right').css('display','block');
        }
        $('.first').removeClass('first').addClass('third');
        $('.second').removeClass('second').addClass('first');
        $('.third').removeClass('third').addClass('second');
    }
    function del(schedule_id){
                swal({
            title: "Are you sure you would like to delete the selected schedule?",
            text: "You will not be able to revert after this action",
            icon: "warning",
            buttons: [
                'No, go back',
                'Yes, I am sure'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm){
                var params = {
                    id:schedule_id,
                    _token: "{{ csrf_token() }}",
                };
                $.post("{{route('schedule.delete')}}",params,function(reponse){
                    if(reponse == 'failed'){
                        toastr.danger('Delete Failed');
                        return;
                    }
                    else
                        toastr.success('Deleted Successfully');
                     $('.sch_row'+schedule_id).css('display','none');
                    drawTable(JSON.parse(reponse));
                });
            }
        });
    }
    function drawTable(dataobject){
        var tr_html = '';
        var task_html = '<div style="min-height:28vh;display:table;width:100%">';
        var i = 0;
        for(var day in dataobject){
            tr_html += '<td>';
            for(var schedule_id in dataobject[day]){
                i++;
                if(i < 4)
                    task_html += '<div class="row first sch_row'+ schedule_id +'">';
                else
                    task_html += '<div class="row second sch_row'+ schedule_id +'">';
                //separate the row into two part
                //firstpart
                task_html += '<div class="colortext">';
                task_html +=    '<div class="colortext_color task_center">';
                task_html +=         "<div class='color' style='background-color:"+dataobject[day][schedule_id].strcolor+"' onclick='javascript:show("
                                        + JSON.stringify(dataobject[day][schedule_id]) + ");' ></div>";
                task_html +=    '</div>';
                task_html +=    '<div class="colortext_text task_center">'+dataobject[day][schedule_id].strtask+'</div>';
                task_html += '</div>';
                //second part
                task_html += '<div class="button-group">';
                task_html +=    '<input type="button" onclick="javascript:del(' + schedule_id + 
                                    ');" id="delete" class="btn btn-outline-green float-right m-1" value="Delete" />';
                task_html +=    '<input type="button" onclick="javascript:edit(' + schedule_id + 
                                    ');" id="edit" class="btn btn-outline-green float-right m-1" value="&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp;" />';
                task_html +=    "<input type='button' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + 
                                    ");' id='view' class='btn btn-outline-green float-right m-1' value='&nbsp;View&nbsp;&nbsp;' />";
                task_html += '</div></div>';

                if(i < 4)
                    task_html += '<br class="first sch_row'+schedule_id+'">';
                else
                    task_html += '<br class="second sch_row'+schedule_id+'">';
                if(Object.keys(dataobject[day]).length == 1){
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                }else if(Object.keys(dataobject[day]).length == 2){
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                }else{
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
                }
            }
            if(Object.keys(dataobject[day]).length == 3)
                    tr_html += "<div class='sch' style='background-color:"+ dataobject[day][schedule_id].strcolor +";' onclick='javascript:show(" + JSON.stringify(dataobject[day][schedule_id]) + ");'>&nbsp;</div>";
            tr_html += '</td>';
        }
        if(i>3){
            $('.arrow').css('display','block');
        }else{
            $('.arrow').css('display','none');
        }
        if(i == 0){
            task_html += '<div style="text-align:center;vertical-align:middle;display: table-cell">No Schedule Set</div>';
        }
        task_html += '</div><div class="row d-flex justify-content-center">';
        task_html += '<input type="button" onclick="javascript:addnew('+i+');" id="addnew" class="btn btn-outline-green w-10" value="Add Another Task" />';
        task_html += '</div>';
        $('.color_range').empty();
        $('.color_range').html(tr_html);
        $('.color_schedule').empty();
        $('.color_schedule').html(task_html);
        if(window.flag){
            change();
            window.flag = !window.flag;
            $('.arrowleft .arrow').css('display','block');
            $('.arrowright .arrow').css('display','none');
        }else{
            $('.arrowright .arrow').css('display','block');
            $('.arrowleft .arrow').css('display','none');
        }
    }
    //-------------------------Dialog------------------//
    function addnew(count){
        if(count*1<6){
            $('#detailModal').modal('show');
            var width = $('#modal').find('td').width();
            $('#modal').height(width);
            $('#modal .sch').height(width/2);

            window.schedule_id = 'new';
            $('#task').val(1);
            changeform(0);
            $('#commandtype').val(0);
            $('#day').val('Mon');
            $('#hour').val(12);
            $('#minute').val(0);
            $('#halfday').val(0);
            $('#command').val('');
            $('#na').val('Add Task');
        }
        else{
            toastr.info('A maximum of 6 tasks can only be added');
        }
    }
    function edit(schedule_id){
        $('#detailModal').modal('show');
        var width = $('#modal').find('td').width();
        $('#modal').height(width);
        $('#modal .sch').height(width/2);
        var params = {
            id:schedule_id,
            _token: "{{ csrf_token() }}",
        };
        $('#na').val('Update Task');
        $.post("{{route('schedule.getdata')}}",params,function(reponse){
            var data = JSON.parse(reponse);
            $('#task').val(data[0]['itaskid']);
            changeform(data[0]['itaskid']);
            $('#commandtype').val(data[0]['command_type']);
            $('#day').val(data[0]['strweekday']);
            $('#hour').val(data[0]['ihour']);
            $('#minute').val(data[0]['iminute']);
            $('#halfday').val(data[0]['ihalfday']);
            $('#command').val(data[0]['strcommand']);
            window.schedule_id = schedule_id;
        });
    }
    function save(){
        var params = {
            id:window.schedule_id,
            itaskid:$('#task').val(),
            command_type:$('#commandtype').val(),
            strweekday:$('#day').val(),
            ihour:$('#hour').val(),
            iminute:$('#minute').val(),
            ihalfday:$('#halfday').val(),
            strcommand:$('#command').val(),
            _token: "{{ csrf_token() }}",
        };
        if(params.itaskid == "4"){
            if(params.strcommand == ''){
                toastr.info('Fill the Command');
                $('#command').focus();
                return;
            }
        }
        $.post("{{route('schedule.save')}}",params,function(reponse){
            if(reponse == 'exist')
                toastr.warning('Sorry, this time is already used by another schedule');
            else if(reponse == 'failed')
                toastr.danger('Save failed');
            else if(reponse == 'over4')
                toastr.info('A maximum of 4 can be added per day.');
            else{
                toastr.success('Saved Successfully');
                $('#na').val('Update Task');
                var param = JSON.parse(reponse);
                window.schedule_id = param['id'];
                delete param['id'];
                drawTable(param);
                $('#detailModal').modal('hide');
            }

        });
    }
    function changeform(value){
        if(value == 4){
            $('.command').css('display','flex');
            $('.commandtype').css('display','flex');
            $('.form-group').removeClass('ordinary');
            $('.form-group').addClass('form_command');
        }
        else{
            $('.command').css('display','none');
            $('.commandtype').css('display','none');
            $('.form-group').removeClass('form_command');
            $('.form-group').addClass('ordinary');
            return true;
        }
    }
    function show(showobject){
        value = '['+showobject.strtask+'] every ['+showobject.strweek+'] at ['+showobject.ihour+':'+(showobject.iminute==0?'00':'30')+' '+showobject.strhalf+']';
        $('#ViewModal').modal('show');
        $('#viewweekdaytitle').html(showobject.strweekday);
        $('#viewweekdaydata').html(value);
        $('#viewweekdaycolor').css('background-color',showobject.strcolor);
        var width = $('#viewweekdaytitle').width();
        $('#viewweekdaycolor').height(width);
    }

</script>
@endpush