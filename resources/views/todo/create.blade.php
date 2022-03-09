<!DOCTYPE html>
<html lang="en">
<head>
  <title>To Do list</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 

</head>

<body>
  <?php
  $date=Carbon\Carbon::now(Auth::user()->timezone);
 $newDate=date('Y-m-d\Th:i',strtotime($date));

  ?>
<div class="container">


@if(isset(Auth::user()->email))

 <div class="alert alert-danger success-block">
  <strong>Welcome {{ Auth::user()->email }}</strong>
  <br />
  <a href="{{ url('/logout') }}">Logout</a>
 </div>
@else
 <script>window.location = "/main";</script>
@endif

<br />
  <h2 style="text-align:center">To Do List</h2>
  <form class="form-inline" action="/create" method="post">
      @csrf
      <h5 style="text-align:center"><x-alert/></h5>
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" id="title" placeholder="Enter task title" name="title" required>
    </div>
    <div class="form-group">
      <label for="pwd">Deadline:</label>
      <input type="datetime-local" class="form-control" id="deadline" placeholder="Enter deadline" name="deadline" value="{{$newDate}}" required>
    </div>
   
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  <br>
  <br>
  <table class="table table-bordered table-condensed table-hover table-striped text-center">
   <thead>
      <tr>
         <th scope="col">To Do List</th>
         <th scope="col">Deadline</th>
      </tr>
   </thead>
   <tbody class="text-left">
       @if(count($tasks)>0)
       @foreach($tasks as $task)
    
       <tr id="{{$task->id}}">
         <td><input type="checkbox" name="brand" id="checkbox_{{$task->id}}" onclick="taskCompleted({{$task->id}})"> &nbsp; &nbsp;{{$task->title}}</td>
         <td>{{Timezone::convertToLocal(Carbon\Carbon::parse($task->deadline))}}</td>
         
       </tr>
       
     
       @endforeach
     @else
     <tr>
         <td>No Task Found</td>
    </tr>
     @endif
     
   </tbody>
</table>
</div>
</body>
<script>

    
    function taskCompleted(id)
    {
        var CSRF_TOKEN = "{{csrf_token()}}";
        $.ajax({
        url: '/completed',
        type: 'POST',
        data: { id: id, completed : 1,_token :CSRF_TOKEN} ,
        success: function (response) {
            console.log(response);
            $('#'+id).fadeOut();
        },
        error: function () {
            console.log(response);
        }
    }); 
    }
    
</script>
</html>