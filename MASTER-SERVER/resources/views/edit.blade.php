@extends('layouts.editLayout')
@section('content')
<div class="content container-fluid-nw">
    <div id="select">
        <h2>Edit</h2>
        <h6 class="mb-4">Edit an existing electronic ink tag which is on the store shelves</h6>
        <hr />
        <div>
            <?php var_dump($tags)?>
            <table id="network_list" border=0>
                <tr>
                    <td width="150px">IP Address&nbsp;
                        <span style="font-size: 16px; color:gray;">
                            <i class="fas fa-wifi"></i>
                        </span>
                    </td>
                    <td width="175px">MAC Address&nbsp;
                        <span style="font-size: 16px; color:gray;">
                            <i class="fas fa-location-arrow"></i>
                        </span>
                    </td>
                    <td width="170px">Vendor ID&nbsp;
                        <span style="font-size: 16px; color:gray;">
                            <i class="fas fa-address-card"></i>
                        </span>
                    </td>
                    <td width="130px">&nbsp;</td>
                </tr>
                <tr>
                    <td><!--&nbsp;--></td>
                    <td><!--&nbsp;--></td>
                    <td><!--&nbsp;--></td>
                    <td><!--&nbsp;--></td>
                </tr>
                <?php
                    foreach($tags as $tag){
                ?>
                <tr>
                    <td><?=$tag['</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                    }

                ?>
                ?>
            </table>
            <span style="color:red"><strong>No eInk tags are currently connected</strong></span>
            <br />
        </div>
    </div>
</div>
<br />
</div>
@endsection