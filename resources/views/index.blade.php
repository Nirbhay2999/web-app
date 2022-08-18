<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container pt-3">
@if(session()->has('message'))
<div class="alert alert-success">
{{session()->get('message')}}
</div>
@endif
  <h2>Data</h2>
      {{-- <button style="margin: 5px;" type="submit" class="btn btn-success btn-xs " data-url="" href={{route('create')}}>Add product</button> --}}
<button><a href={{route('create')}} class="btn btn-success">ADD PRODUCT</a></button>
  <button style="margin: 5px;" class="btn btn-danger btn-xs delete-all" data-url="">Delete All</button>


  <table class="table table-striped">
    <thead>
      <tr>
                  <th><input type="checkbox" id="check_all"></th>

        <th>ID</th>
        <th>EMAIL</th>
          <th>Name</th>
            <th>PRICE</th>
              <th>UPC</th>
        <th>IMAGE</th>
           <th>STATUS</th>
        <th>EDIT</th>
         <th>DELETE</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $d)
      <tr>
      <td><input type="checkbox" class="checkbox" data-id="{{$d->id}}"></td>
      <td>{{$d->id}}</td>
      <td>{{$d->email}}</td>
        <td>{{$d->name}}</td>
          <td>{{$d->price}}</td>
            <td>{{$d->upc}}</td>
      <td>
      <img src="{{asset('uploads/products/'.$d->image)}}" width="50px" height="50px">

      </td>
      <td>
                            @if ($d->status == 1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Inactive</span>
                            @endif

                        </td>
      <td><a href={{route('edit',$d->id)}} class="btn btn-success">Edit</a> </td>
      <td> <a href={{route('delete',$d->id)}} class="btn btn-danger">Delete</a></td>

      </tr>
    @endforeach
    </tbody>
  </table>
  {{$data->links()}}
</div>
</body>
<script type="text/javascript">
$(document).ready(function () {
    $('#check_all').on('click', function(e) {
    if($(this).is(':checked',true))
{
    $(".checkbox").prop('checked', true);
    } else {
    $(".checkbox").prop('checked',false);
}
});
    $('.checkbox').on('click',function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
    $('#check_all').prop('checked',true);
    }else{
    $('#check_all').prop('checked',false);
}
});
    $('.delete-all').on('click', function(e) {
    var idsArr = [];
    $(".checkbox:checked").each(function() {
    idsArr.push($(this).attr('data-id'));
});
    if(idsArr.length <=0)
{
    alert("Please select atleast one record to delete.");
    }  else {
    if(confirm("Are you sure, you want to delete the selected categories?")){
    var strIds = idsArr.join(",");
    $.ajax({
    url: "{{ route('deleteMultiple') }}",
    type: 'DELETE',
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: 'ids='+strIds,
    success: function (data) {
    if (data['status']==true) {
    $(".checkbox:checked").each(function() {
    $(this).parents("tr").remove();
});
    alert(data['message']);
    } else {
    alert('Whoops Something went wrong!!');
}
},
    error: function (data) {
    alert(data.responseText);
}
});
}
}
});
$('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
    element.closest('form').submit();
}
});
});
</script>
</html>
