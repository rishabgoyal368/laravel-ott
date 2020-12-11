@extends('layouts.admin')
@section('title','Device History')
@section('content')

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
    
        <h4>Device History</h4> <br/>
    <div class="content-block box-body">
      <table id="devicetable" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
            <th>#</th>
            <th>User Name</th>
            <th>Device / Platform</th>
            <th>Last active at</th>
          </tr>
        </thead>
        @if ($device_history)
          <tbody>
        
          </tbody>
        @endif
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
 <script>
    $(function () {
      
      var table = $('#devicetable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('device_history') }}",
          columns: [

              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
               {data: 'username', name: 'username', searchable:true},
               {data: 'user_agent', name: 'user_agent',searchable:false},
               {data: 'last_activity', name: 'last_activity',searchable:false}
            
             
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'desc']]
      });
      
    });
  </script>
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
    
  </script>

@endsection
