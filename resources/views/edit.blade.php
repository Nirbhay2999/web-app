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
</head>
<body>

<div class="container pt-3">
@if(session()->has('message'))
<div class="alert alert-success">
{{session()->get('message')}}>
</div>
@endif
  <h2>Form</h2>
  <form action={{route('update',$data->id)}} method="post" enctype="multipart/form-data">
  @csrf
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$data->email}}">
    </div>
      <div class="form-group">
      <label for="email">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$data->name}}">
    </div>
      <div class="form-group">
      <label for="password">Price</label>
      <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{$data->price}}">
    </div>
     <div class="form-group">
      <label for="email">UPC</label>
      <input type="text" class="form-control" id="upc" placeholder="Enter upc" name="upc" value="{{$data->upc}}">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{{$data->password}}">
    </div>
      </label>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" name="image">
    </div>
    <div class="col-md-6">
                      <div class="form-group">
                          <label for="Status">Status:</label>
                          <select type="text" class="form-control" placeholder="Enter status" name="status" value="{{$data->status}}">
                            <span style="color: red">@error('status'){{$message}}@enderror</span>
                            <option disabled="disabled">Choose Status</option>
                            <option id="active" for="active" value="1">Active</option>
                            <option id="inactive" for="inactive" value="0" >Inactive</option>
                          </select>
                      </div>
                    </div>

      <button type="submit" class="btn btn-primary">Update</button>
  </form>
</div>
</body>
</html>
