
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
  var $z = jQuery.noConflict();
$z(document).ready(function() {

  $z('#checkall').click(function() {
    var checked = $xxx(this).prop('checked');
    $z('#checkboxes').find('input:checkbox').prop('checked', checked);
  });
})





</script>

<script>
    $z(document).ready(function(){
        $z('#tabel-data').DataTable({

"bInfo" : false,
"lengthMenu": [[15, 25, 50, -1], [10, 25, 50, "All"]],
"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>'
}
        );

    });
</script>


<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data User</h4>
      </div>
      <div class="modal-body">


        <input type="hidden" id="fruits" name="id" value="">

<div id="checkboxes">
				<table id="tabel-data" class="table table-striped table-bordered" width="100%">
           <thead>
				<tr>
				<th >Email</th>



				<th ><P align="center">Nama </P></th>
				</tr>
      </thead>
       <tfoot>

         <tr>
 				<th >Email</th>



 				<th ><P align="center">Nama </P></th>
 				</tr>

        </tfoot>
        <tbody>
					@foreach($user as $r)


				<tr>
				<td >{{$r->email}}</td>


						<td >

							<input type="checkbox" value="{{$r->id}}" name="id[]"> 	{{$r->name}}

						</td>
</tr>
				@endforeach
</tbody>
      </table>

</div>
<input type="checkbox" id="checkall" /> <b>Checkall / Uncheck All </b>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Simpan</button>
      </div>
    </div>

  </div>
</div>

<div class="form-group">
{!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">
{!! Form::text('judul',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}

</div>
</div>
<p>

<div class="form-group" >
{!! Form::label('kontak','Kontak',array('class'=>'col-md-1 control-label'))!!}
<div class="col-md-11">
<a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" style="margin-top:10px;margin-bottom:10px;">	<span class="glyphicon glyphicon-bullhorn"></span> Kontak </a>
</div>
</div>




<div class="form-group">

<div class="col-md-12">
{!! Form::textarea('isi',null,array('class'=>'form-control','id'=>'area'),'')!!}
</div>
</div>









<div class="col-md-6 col-md-offset-4">
{!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}

</div>
