<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />

  <div class="container">
   <h3 align="center">View Attendance List</h3>

   <div class="panel panel-default">

    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Name</th>
        <th>Check In</th>
        <th>Check Out</th>
         <th>Total Working Hours</th>
       </tr>
       @foreach($diffs as $row)
       <tr>
        <td>{{ $row->employee->name }}</td>
        <td>{{ $row->check_in  ?? 'N/A' }}</td>
        <td>{{ $row->check_out ?? 'N/A' }}</td>
        <td>{{ $row->totHours }}</td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>
