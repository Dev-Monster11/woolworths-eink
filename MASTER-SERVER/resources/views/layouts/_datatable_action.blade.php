<div style="width:105px">
<a class="detail_view btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
<!-- <a href="http://{{ $model['ip_address'] }}#{{csrf_token()}}&{{ url('/') }}&tagvalue={{json_encode($model)}}" class="edit btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a> -->
{{-- <a id="editTag" href="http://{{ $model['ip_address'] }}#{{csrf_token()}}&{{ url('/') }}&tagvalue={{json_encode($model)}}" class="edit btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a> --}}
<a class="edit btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
<a href="{{ $url_destroy }}" class="delete btn btn-success btn-sm"><i class="fas fa-trash"></i></a>
</div>