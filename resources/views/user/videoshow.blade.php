<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">    
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	
	
	<style>
#scroll1 {
  color: black;
  padding: 10px;
  width: 800px;
  height: 500px;
  overflow: scroll;
  border: 3px solid #2F4799;
}
#scroll2 {
  color: black;
  padding: 10px;
  margin-left: 10px;
  width: 350px;
  height: 500px;
  overflow: scroll;
  border: 3px solid #D28329;
}

</style>
  </head>
  <body>

	 <!-- Modal Detil Karya-->
	@foreach($videox->karya_kelas as $karya)
	<div class="modal fade" id="detilkarya-{{ $karya->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 1200px; max-width: 100%;">
    <div class="modal-content">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right">
        <span aria-hidden="true">&times;</span>
        </button>
	</div>
	<div class="modal-body">
	<div class="container-fluid">
    <div class="row">
      <div class="col-sm-8" id="scroll1">
			<p>{{$karya->deskripsi_karya}}</p>
	  		@foreach(json_decode($karya->hasil_karya, true) as $images)
			<br>
        	<img src="{{ asset(('hasil_karya/'.$karya->user_id.'/'.$images))}}"
			class="img-responsive"  style="width: 800px; height:auto;">
			@endforeach
		</div>

      	<div class="col-md-4" id="scroll2">
			<form id="karyaForm"class="form-inline" action="{{route('addDiscussKaryaKelas', $karya->id)}}">
			<div class="alert alert-success" style="display:none; font-size:medium"></div>
				<div class="form-group">
  					<img class="avatar" src="{{asset(($karya->user->gambar))}}" width="50px" style="margin-left: 10px;">
   					<a href="#"> <b>{{$karya->user->name}}</b></a> <br>
  				</div>
  				<br><br>
  				<span style="float: left"><i class="fa fa-heart-o" style="font-size:24px; color:black"></i></span>
				<p style="float:right">0 Suka | {{$karya->karya_comments->count()}} Komentar</p>
  				<br><br>
  				@if(Auth::guest())
               	<p style="text-align: center;">Silahkan<a href="{{route('login')}}" style="color: #0D1852;"> <i class="fa fa-sign-in"></i><strong> Login</strong> </a> untuk mengirimkan komentar.</p>
              	@else
  				<div class="form-group">
	  			<textarea required="required" id="content" name="content" rows="4" style="width: 320px" placeholder="Komentar"></textarea><br>
  				</div>
  				<div class="form-group">
	  			<button type="submit" id="send_karya" class="btn btn-success">Kirim</button>
  				</div>
  				@endif
			</form>
			
			<script type="text/javascript" src="http://code.jquery.com/jquery-3.3.1.min.js"
               		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"> 
			</script>
			<script type="text/javascript">
			jQuery(document).ready(function(){

				//kirim komentar karya kelas
            	jQuery('#send_karya').click(function(e){
               	e.preventDefault();
               	$.ajaxSetup
				({
                  	headers: 
					{
                      	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 	}
             	});

			  	$('#send_karya').html('Mengirim..');
			  		url = $('#karyaForm').attr('action');
			  		karyaForm = $('#karyaForm').serialize();
                	var content = $('#content').serialize();
                	if(content=="")
					{
						jQuery('.alert').show();
                    	jQuery('.alert').html('Please write a Post first!');
                	}
                else{
               jQuery.ajax({
                  url: url,
                  type: 'POST',
                  data: karyaForm,
                  success: function(result){
					jQuery('#send_karya').html('Kirim');
					jQuery('#karyaForm')[0].reset();
					jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                  }});
				}
               });

			   	//kirim balasan komentar karya kelas
				jQuery('#send_balaskarya').click(function(e){
               	e.preventDefault();
               	$.ajaxSetup
				({
                	headers: 
					{
                      	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 	}
            	});

			  	$('#send_balaskarya').html('Mengirim..');
			  	url = $('#balaskaryaForm').attr('action');
			  	balaskaryaForm = $('#balaskaryaForm').serialize();
                var content = $('#content').serialize();
                if(content=="")
				{
					jQuery('.alert').show();
                    jQuery('.alert').html('Please write a Post first!');
                }
                else
				{
            	jQuery.ajax
				({
                	url: url,
                	type: 'POST',
                	data: balaskaryaForm,
                	success: function(result)
					{
					jQuery('#send_balaskarya').html('Balas');
					jQuery('#balaskaryaForm')[0].reset();
					jQuery('.alert').show();
                	jQuery('.alert').html(result.success);
                	}
				});
				}
               	});

				//hapus komentar karya kelas
				$(".deleteKomentar").click(function(){
				if(!confirm("Apakah Anda ingin menghapus ini?")) 
				{
       				return false;
    	 		}
				e.preventDefault();
               	$.ajaxSetup
				({
                  	headers: 
					{
                      	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 	}
             	});

    			var id = $(this).data("id");
				url = $(".deleteKomentar").attr('action'); 
    			$.ajax
				({
        		url: url,
        		type: 'DELETE',
        		data: {"id": id},
        		success: function ()
				{
					jQuery('.alert').show();
            		jQuery('.alert').html(result.success);
				}
    			});
				});

				//hapus balasan komentar karya kelas
				$(".deleteBKomentar").click(function(){
				if(!confirm("Apakah Anda ingin menghapus ini?")) 
				{
       				return false;
     			}
				e.preventDefault();
               	$.ajaxSetup
				({
                  	headers: 
					{
                      	'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 	}
             	});

    			var id = $(this).data("id");
				url = $(".deleteBKomentar").attr('action'); 
    			$.ajax
				({
        		url: url,
        		type: 'DELETE',
        		data: {"id": id},
        		success: function ()
				{
					jQuery('.alert').show();
            		jQuery('.alert').html(result.success);
        		}
    			});
				});

            });
			</script>

			<!-- Menampilkan data komentar dari database -->
			<br>
            @foreach($karya->karya_comments->sortByDesc('created_at') as $comment)
  			<div class="card-header" style=" background-color: #2F4799; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; text-align:end;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$comment->created_at->diffforHumans()}}</small></div>
  				<div class="card-body" style="background: #f9f9f9; "> 
				<div class="row" style="padding-right: 2px; padding-top:2px;">
					<div class="col-md-2" >
                        <img class="avatar" src="{{asset(($comment->user->gambar))}}" style="text-align: center"  width="30px" >
        							<a href="#" style="word-wrap:word-break; overflow:hidden; font-size:12px; text-align:center"><b>{{$comment->user->name}}</b></a>
									</div>  
									<div class="col-md-9" style="word-wrap: break-word; overflow:hidden;">
      								<p style=" padding-left: 10px;padding-right:10px; text-align:justify">{{$comment->content}}</p>
								  </div>
								  <div class="card-footer link_a">
  								<div class="reply_comment">
 								
								 <a data-toggle="collapse" href="#{{$comment->id}}-collapse1reply" style="margin-left:10px"><strong><i class="fa fa-comment-o"></i> Balas ({{$comment->karya_comments->count()}})</a></strong>
								 
								@if(Auth::user() && (Auth::user()->id == $comment->user_id))
								 <a type="submit" href="{{route('deleteDiscuss', $comment->id) }}" style="margin-left:10px" class="deleteKomentar" data-id="{{$comment->id}}"><strong><i class="fa fa-trash"></i> Hapus </a></strong>
								 <a data-toggle="modal" href="{{ route('editDiscuss',$comment->id) }}" data-target="#editKomentar-{{ $comment->id }}" style="margin-left:10px"><strong><i class="fa fa-edit"></i> Edit </a></strong>								
								 @endif
								</div>
							</div>
						</div>

<!-- style untuk balasan komentar -->
<div id="{{$comment->id}}-collapse1reply" class="card-collapse collapse">
  					<div class="card-body">
    				<!-- forelse untuk menampilkan data balasan komentar dari database -->
					@forelse($comment->karya_comments as $reply)
					<div class="card">
      					<div class="card-header" style="background-color: #D28329; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; text-align:start;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$reply->created_at->diffforHumans()}}</small></div>
      						<div class="card-body" style="background: #f9f9f9;"> 
        						<div class="row" style="padding-left: 2px; padding-top:2px;">
								<div class="col-md-3" >
                        			<img  class="avatar" src="{{asset(($reply->user->gambar))}}" width="20px">
										<br>
        								<div style="word-wrap:break-word; overflow:hidden; font-size:11px; ">
        								<a href=""><b>{{$reply->user->name}}</b></a>
										</div>
									</div>	  
								<div class="col-md-9" style="word-wrap: break-word; overflow:hidden;">
      									<p style="font-size:13px; text-align:justify">{{$reply->content}}</p>
									</div>
									
								</div>
								<div class="card-footer link_a">
  								<div class="reply_comment">
								@if(Auth::user() && (Auth::user()->id == $reply->user_id))
								 <a type="submit" href="{{route('deleteDiscuss', $reply->id) }}" style="margin-left:10px" class="deleteBKomentar" data-id="{{$reply->id}}"><strong><i class="fa fa-trash"></i> Hapus </a></strong>
								 <a data-toggle="modal" href="{{ route('editDiscuss',$reply->id) }}" data-target="#editBalKomentar-{{ $reply->id }}" style="margin-left:10px"><strong><i class="fa fa-edit"></i> Edit </a></strong>								
								 @endif
								</div>
							</div>
    						</div>
    				</div>
    				@empty
  					<p style="text-align: center;font-size: 20px;"><b> Tidak ada balasan</b></p>
  					@endforelse <!-- endforelse  untuk menampilkan data balasan diskusi dari database -->
					</div>
					   
					<!-- style untuk menampilkan kolom balasan diskusi -->
	  				<div class="panel-body" style="border-top: 1px solid #eee;">
	  					@if(Auth::guest())
              			@else
        				<form action="{{route('replyDiscussKaryaKelas', $comment->id)}}" id="balaskaryaForm" style="padding: 0 16px;">
						<div class="form-group">
							  <input required="required" id="content" type="text" name="content" style="border-color: #F08035; float:right;" class="form-control" placeholder="Balas diskusi di sini">        
							</div>
							<button id="send_balaskarya" class="btn btn-success" type="submit" style="float: right; margin-left:5px;">Balas</button>
						  </form>
					
	  					@endif
      				</div>
    				</div>

					</div>
			<br>
  			@endforeach<!-- endforelse untuk menampilkan data diskusi dari database -->

	  </div>
	</div>
	  </div>
	  </div>
	
    </div>
  </div>
</div>


<!-- Modal untuk edit komentar -->
@foreach($karya->karya_comments as $comment)
<div class="modal fade" id="editKomentar-{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{route('updateDiscuss', $comment->id)}}" method="post">
		@csrf
		<div class="form-group">
    		<textarea  name="content" class="form-control"  required>{{$comment->content}}</textarea>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn" style="background: #2F4799; color:#fff;">Kirim</button>
		@include('sweetalert::alert')
      	</div>
		</form>
      </div>
      </div>
    </div>
  </div>

  <!-- Modal edit balasan komentar -->
@foreach($comment->karya_comments as $reply)
<div class="modal fade" id="editBalKomentar-{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{route('updateDiscuss', $reply->id)}}" method="post">
		@csrf
		<div class="form-group">
    		<textarea  name="content" class="form-control"  required>{{$reply->content}}</textarea>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn" style="background: #2F4799; color:#fff;">Kirim</button>
		@include('sweetalert::alert')
      	</div>
		</form>
      </div>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach
@endforeach

<!-- Modal untuk Edit Diskusi -->
@foreach($videox->comments as $comment)
	<div class="modal fade" id="editDiskusiFitur" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="modalDiskusi" action="{{route('updateDiscussVideo', $comment->id)}}">
		<div class="form-group">
    		<textarea id="content"  name="content" class="form-control"  required>{{$comment->content}}</textarea>
		</div>
		<div class="modal-footer">
		<button type="submit" id="btnEditDiscuss" class="btn" style="background: #2F4799; color:#fff;">Kirim</button>  
	</div>
		</form>
      </div>
      </div>
    </div>
  </div>

  <!-- Modal untuk Edit Balasan diskusi -->
  @foreach($comment->comments as $reply)
  <div class="modal fade" id="editDiskusi-{{ $reply->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="{{route('updateDiscussVideo', $reply->id)}}" method="post">
		@csrf
		<div class="form-group">
    		<textarea  name="content" class="form-control"  required>{{$reply->content}}</textarea>
		</div>
		<div class="modal-footer">
		<button type="submit" class="btn" style="background: #2F4799; color:#fff;">Kirim</button>
		@include('sweetalert::alert')
      	</div>
		</form>
      </div>
      </div>
    </div>
  </div>
@endforeach
	@endforeach
  
	<!-- Modal Upload Karya-->
	<div class="modal fade" id="uploadkarya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document" style="width: 600px; max-width: 100%;">
    <div class="modal-content">
    	<div class="modal-body">
	  	<form action="{{route('storeKaryaKelas', $videox->id)}}" method="post" enctype="multipart/form-data">
		@csrf  
		<div class="form-group" >
			<label>Pilih file:</label>
			<br />
			<h5 style="font-size: 10pt; font-style:italic">Ekstensi file yang diizinkan: .jpg, .jpeg, .png, .3gp, .mp4, .avi, .txt, .doc, .docx, .pdf <br> Maksimal: 10mb</h5>
			<div class="form form-inline control-group increment" >
          <input type="file" name="hasil_karya[]" class="form-control" required>
            <button class="btn btn-success add" type="button"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
			
		</div>
        <div class="clone hide">
          <div class="form form-inline clone-form" style="margin-top:5px">
            <input type="file" name="hasil_karya[]" class="form-control">
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>Hapus</button>
          </div>
        </div>
    		
		</div>
		<div class="form-group">
    		<textarea rows="4" name="deskripsi_karya" class="form-control" placeholder="Deskripsi" required></textarea>
		</div>
		<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button type="submit" class="btn" style="background: #2F4799; color:#fff;">Upload</button>
		@include('sweetalert::alert')
      	</div>
		</form>
		</div>
    </div>
  	</div>
	</div>

  </body>

  <script type="text/javascript">

    $(document).ready(function() {

      $(".add").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".clone-form").remove();
      });

    });

</script>
</html>

@extends('layouts.user')
@section('content')

@php

function parse($url) {
    parse_str( parse_url( $url, PHP_URL_QUERY ), $parseurl );
    return $parseurl['v'];
}
$thumb = substr($videox->embed, 68, -123);

function rp($angka)
{
  $rp = "Rp. " . number_format($angka, 0, ',', '.');
  return $rp;
}

function strtime($time) {
    return substr($time, 3, 5);
}

function minutes($seconds) {
    return sprintf("%02.2d", floor($seconds / 60), $seconds % 60);
}

@endphp

<style>

/*style karya kelas*/
.card-karya {
    font-size: 1em;
    overflow: hidden;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
}

.card-block-karya {
    font-size: 1em;
    position: relative;
    margin: 0;
    padding: 1em;
    border: none;
    border-top: 1px solid rgba(34, 36, 38, .1);
    box-shadow: none;
}

.card-img-top-karya {
    display: block;
    width: 100%;
    height: 200px;
}

.text-bold-karya {
    font-weight: 700;
}

hr.divider {
  max-width: 3.25rem;
  border-width: 0.2rem;
  border-color: #D28329;
}
/*Batas akhir style*/

/* Style diskusi */
.card-header {
    padding: 0px 1.25rem;
    margin-bottom: 0;
    background-color: rgba(0,0,0,.03);
    border-bottom: 1px solid rgba(0,0,0,.125);
}

#m_1 a{
  color: #444444;
}
.form-control:focus {
    color: #495057;
    border-color: #2ab27b;
    outline: 0;
    -webkit-box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    box-shadow: 0 0 0 0.01rem rgb(42, 178, 123);
}

#input_reply:focus {
    color: #495057;
    background-color: #fff;
    border-color: #2ab27b;
    outline: 0;
    -webkit-box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    box-shadow: 0 0 0 0.01rem rgb(42, 178, 123);
}

.btn-success {
    color: #fff;
    background-color: #D28329;
    border-color: #D28329;
}

.page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #2ab27b;
    border-color: #2ab27b;
}
.page-item.active .page-link:hover {
    z-index: 1;
    color: #fff;
    background-color: #555;
    border-color: #555;
}

.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    background-color: #2ab27b;
    border-color: #2ab27b;
    cursor: default;
}

.comment_user{
    
    padding: 5px;
    border-bottom: 1px solid #eee;
    
}
.comment_user p{
      padding: 3px;
}

.reply_comment{
      text-align: right;
}

.link_a a{
  text-decoration: none;
  color: #444;
}

.des a{
  color: #eee;
}
.page-link {
    position: relative;
    display: block;
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #2ab27b;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.list-group-item:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
/*Batas Style diskusi*/

    .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
	    color: #fff;
	    background-color: dodgerblue;
	    border-color: dodgerblue;
    }

    .list-group-item:first-child {
    	border-radius: 0px;
    }

    .panel-heading {
    	border-radius: 0px;
    }

    h4 {
    	line-height: 20px;
    }

	@media (min-width:767px) {
		.pll-0 {
			padding-left: 0px;
		}
	}

	@media (max-width:767px) {
		.pll-0 {
			padding-top: 10px;
		}
	}

	@if($nav == 'vidshow')
	@media (max-width:767px) {
	.pd-nav {
	        padding: 110px 15px 40px;
	    }
	}

	.video-slider-btn {
		font-size: 37px;
	}

	.video-slider-btn.left-side {
    	left: 10px;
	}

	.video-slider-btn.right-side {
    	right: 10px;
	}

	@endif

	.card-other {
		transition: 0.3s;
      	box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
	}

	.card-other:hover {
      	box-shadow: 0 3px 14px -2px rgba(0,0,0,0.2);
	}

	.ml--4 {
	    margin-left: -4px;
	}
</style>

<div class="card mb-6">
	<div class="panel-body">
		<h3 class="mt-0">{{$videox->judul}}</h3>
		<ol class="breadcrumb" style="background-color: white; margin-bottom: 0; padding: 0;">
		  <li><a href="{{asset('/course')}}" style="color: black;">MODUL</a></li>
		  <li class="active"><a class="text-secondary" href="{{asset('modul/'.$modul_id.'/show')}}">{{ $currentModul }}</a></li>
		</ol>	
	</div>
</div>


<div class="card">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-md-9">
	            @if($cekmod->sertifikat == 0)
		    	<a data-fancybox href="https://www.youtube.com/watch?v={{$thumb}}" class="hidden-md hidden-lg">
	                <i class="fa fa-play-circle icon-play"></i>
	                <img style="height: 100%; width: 100%;" src="https://img.youtube.com/vi/{{$thumb}}/sddefault.jpg" alt="">
	            </a>
		        @endif

	            @if($cekmod->sertifikat == 1)
		        <div class="video-container">
		        @else
			    <div class="video-container hidden-xs hidden-sm">
			    @endif
		            <a class="video-slider, videobox" data-fancybox>
		                <div class="video-slide">
		                    {!!html_entity_decode($videox->embed)!!}
		                </div>
		            </a>
		            @if($previous=='')
		            <?php $previous = 0?>
		            @else
		            @endif
		            @if($next=='')
		            <?php $next = 0?>
		            @else
		            @endif
		            <a href="{{asset('video/'.$previous.'/show')}}" class="video-slider-btn left-side">&#10094;</a>
		            <a href="{{asset('video/'.$next.'/show')}}" class="video-slider-btn right-side">&#10095;</a>
				</div>
			
				</div>
			
			<div class="col-xs-12 col-md-3 pll-0">
				
	            <div class="accordion border-0" id="accordion2" style="max-height: 445px; overflow-y: auto;">
                @foreach($kategorivideo2 as $r)

                  <div class="accordion-group panel panel-light" style="margin-bottom: 0px; border-bottom: 1px solid #dedfe0;">
                    <div class="panel-heading" style="background-color: #f2f3f5">
                        <h4 class="panel-title">
                            <a class="text-dark" style="font-weight: 500" data-toggle="collapse" href="#collapse{{$r->id}}">
                                {{$r->kategori}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$r->id}}" class="accordion-body collapse in">
                        @php
                        $n = 1;
                        @endphp
                        <ul class="list-group">
			                {{-- @foreach ($videos as $v) --}}
                        	@foreach($videos->where('kategorivideo_id', $r->id) as $v)

			                <a 
			                @if($v->stat == 'Premium' && $cek_sale == 0)
			                		onclick="warningLock()" 
			                		href="#2"
		                	@else 
		                	href="{{ asset('video/show/'. $v->list . '/' . $modul_id) }}"
		                	@endif

			                 class="list-group-item {{ ($v->id == $videox->id) ? 'active' : '' }}">
			                    
			                    <div class="row">
			                    	<div class="col-xs-2">
			                    		@if(!Auth::guest() && $cek_sale > 0)
			                    		@php
						                    $ccread = $cread->where('video_id', $v->id)->count();
						                @endphp

						                    @if($ccread > 0)
						                    <span class="glyphicon glyphicon-ok mt-1" style="{{ ($v->id == $videox->id) ? 'color:white;' : 'color:green;' }}"></span>
						                    @else
						                	<span class="glyphicon glyphicon-film mt-1"></span>

						                    @endif
						                @else
						                <span class="glyphicon glyphicon-film mt-1"></span>
						                @endif
										

			                    	</div>
			                    	<div class="col-xs-10 pl-0">
					                    <span>{{$v->judul}}</span> 

			                    		@if($v->stat == 'Premium')
						                    @if($cek_sale == 0)
						                    	<i class="fa fa-lock"></i>
						                    @else
						                    <p class="text-smaller mb-0 ml--4"><i class="fa fa-play-circle"></i>{{strtime($v->durasi)}}</p>
						                    @endif
					                    @else
					                    <p class="text-smaller mb-0 ml--4"><i class="fa fa-play-circle"></i>{{strtime($v->durasi)}}</p>
					                    @endif
			                    	</div>
			                    </div>
			                </a>
			                @endforeach
			            </ul>
                    </div>
                  </div>
                @endforeach
                </div>
			</div>
		</div>
	</div>
</div>

	<!-- Batas awal pembuatan fitur diskusi, review/ulasan dan karya kelas -->
	<div class="panel-group" id="accordion"> 
	<div class="panel" style="border-color: #0D1852; padding: 10px 10px 1px 10px;" >
		<p>
			<ul class="nav nav-tabs">
  				<li class="nav-item">
    			<a class="nav-link active" style="color:#0D1852;font-size: 16px;" data-toggle="collapse" href="#diskusi" role="button" aria-expanded="false" data-parent="#accordion">
   					<b>Diskusi ({{$videox->comments->count()}})</b>
				</a>
  				</li>
  				<li class="nav-item">
    			<a class="nav-link" style="color:#0D1852;font-size: 16px;" data-toggle="collapse" href="#ulasan" role="button" aria-expanded="false" data-parent="#accordion">
   					<b>Ulasan ({{$videox->ratings->count()}})</b>
  				</a>
				</li>
				<li class="nav-item">
    			<a class="nav-link" style="color:#0D1852;font-size: 16px;" data-toggle="collapse" href="#karyakelas" role="button" aria-expanded="false" data-parent="#accordion">
   					<b>Karya Kelas</b>
  				</a>
  				</li>
			</ul>
		</p>
				
		<!-- Batas awal pembuatan fitur diskusi -->
		<div class="collapse" id="diskusi">
			<div class="panel panel-default" style="background-color: #f9f9f9; margin-bottom:10px;">  
				<div class="panel-body">
					@if(Auth::guest())
               		<p style="text-align: center;"><a href="{{route('login')}}" style="color: #0D1852;">Silahkan <i class="fa fa-sign-in"></i><strong> Login</strong> </a> untuk mengirimkan diskusi.</p>
              		@else
					<form id="commentForm" action="{{route('addDiscuss',$videox->id)}}">
					<div class="alert alert-success" style="display:none; font-size:medium"></div>
               	 	<div class="form-group">
					<textarea id="content" name="content" class="form-control" style="border-color: #2F4799;" rows="3" placeholder="Tambahkan diskusi baru"></textarea>
					</div>
					<button type="submit" id="send_form" class="btn" style="background: #2F4799; color:#fff;">Kirim Diskusi</button>
				
				</form>
				<script type="text/javascript" 
					src="http://code.jquery.com/jquery-3.3.1.min.js"
               		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               		crossorigin="anonymous"> </script>
				<script type="text/javascript">
					jQuery(document).ready(function(){

						//kirim diskusi
            		jQuery('#send_form').click(function(e){
               		e.preventDefault();
               		$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });
			  		$('#send_form').html('Mengirim..');
			  		url = $('#commentForm').attr('action');
			  		commentForm = $('#commentForm').serialize();
                	var content = $('#content').serialize();
                	if(content=="")
					{
						jQuery('.alert').show();
                    	jQuery('.alert').html('Please write a Post first!');
                	}
                else{
               jQuery.ajax({
                  url: url,
                  type: 'POST',
                  data: commentForm,
                  success: function(result){
					jQuery('#send_form').html('Kirim Diskusi');
					jQuery('#commentForm')[0].reset();
					jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
					jQuery('#dataDiskusi').load(result);
                  }
				});
				}
               });

//kirim balasan diskusi
			   jQuery('#send_balasdiskusi').click(function(e){
               		e.preventDefault();
               		$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });

			  		$('#send_balasdiskusi').html('Mengirim..');
			  		url = $('#balasdiskusiForm').attr('action');
			  		balasdiskusiForm = $('#balasdiskusiForm').serialize();
                	var content = $('#content').serialize();
                	if(content=="")
					{
						jQuery('.alert').show();
                    	jQuery('.alert').html('Please write a Post first!');
                	}
                else{
               jQuery.ajax({
                  url: url,
                  type: 'POST',
                  data: balasdiskusiForm,
                  success: function(result){
					jQuery('#send_balasdiskusi').html('Balas');
					jQuery('#balasdiskusiForm')[0].reset();
					jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                  }});
				}
               });

//hapus diskusi
			   $(".deleteRecord").click(function(){
				if(!confirm("Apakah Anda ingin menghapus ini?")) {
       return false;
     }

				e.preventDefault();
               		$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });

    var id = $(this).data("id");
	url = $(".deleteRecord").attr('action'); 
    $.ajax(
    {
        url: url,
        type: 'DELETE',
        data: {
            "id": id,
        },
        success: function (){
			jQuery('.alert').show();
            jQuery('.alert').html(result.success);
			
        }
    });
   
});

//hapus balasan diskusi
$(".deleteBalasan").click(function(){
				if(!confirm("Apakah Anda ingin menghapus ini?")) {
       return false;
     }

				e.preventDefault();
               		$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });

    var id = $(this).data("id");
	url = $(".deleteBalasan").attr('action'); 
    $.ajax(
    {
        url: url,
        type: 'DELETE',
        data: {
            "id": id,
        },
        success: function (){
			jQuery('.alert').show();
            jQuery('.alert').html(result.success);
			
        }
    });
   
});

//edit diskusi-error
$(".editDiskusi").click(function(){
	$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });
					  
	var id = $(this).data("id");
	url = $("#modalDiskusi").attr('action'); 
      $.get(url, function (data) {
		$('#editDiskusiFitur').modal('show');
		$('#content').val(data.content);
		jQuery('.alert').show();
            jQuery('.alert').html(result.success);
      })
				
    });
   
});

</script>
					@endif
				</div>
				  
			<!-- style menampilkan data diskusi dari database -->
            <div class="panel panel-body" id="dataDiskusi">
				@forelse($videox->comments->sortByDesc('created_at') as $comment)
  				<div class="card-header" style=" background-color: #2F4799; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; text-align:end;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$comment->created_at->diffforHumans()}}</small></div>
  					<div class="card-body" style="background: #f9f9f9; "> 
						<div class="row" style="padding-top:10px;">
      						<div class="col-md-1" style="text-align: center">
                        		<img class="avatar" src="{{asset(($comment->user->gambar))}}" alt="..." width="50px" style="padding: 5px;" >
								<div class="comment_user">
        							<b>{{$comment->user->name}}</b>
        						</div>
							</div>
      							<div class="col-md-10" style="word-wrap: break-word; overflow: hidden;">
      								<p style="text-align: justify">{{$comment->content}}</p>
      							</div>
						</div>
							<div class="card-footer link_a">
  								<div class="reply_comment">
 								<a data-toggle="collapse" href="#{{$comment->id}}-collapse1reply"><strong><i class="fa fa-comment-o"></i> Balas ({{$comment->comments->count()}})</a></strong>
								 @if(Auth::user() && (Auth::user()->id == $comment->user_id))
								 <a href="{{ route('deleteDiscussVideo',$comment->id) }}" class="deleteRecord" data-id="{{ $comment->id }}" type="submit" style="margin-left:10px"><strong><i class="fa fa-trash"></i> Hapus </a></strong>

								 <a  data-toggle="modal" data-target="#editDiskusiFitur" class="editDiskusi" data-id="{{$comment->id}}" href="{{ route('editDiscussVideo',$comment->id) }}" style="margin-left:10px"><strong><i class="fa fa-edit"></i> Edit </a></strong>
								@endif


								<button class="btn btn-light btn-xs" style="float: left;" onclick="likeComment('{{$comment->id}}', this)"><span class="glyphicon glyphicon-heart" style="color: black;"></span></button>
								<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
								<script>
									function likeComment(commentId, elem){
										var csrfToken = '{{csrf_token()}}';

										$.post('{{route('likeComment')}}', {commentId:commentId, _token:csrfToken}, function(data)
										{
										console.log(data);
										$(elem).css({color:'red'});
										});
									}
								</script>
								</div>
							</div>
					</div>
					<br>

					<!-- style untuk balasan diskusi -->
 					<div id="{{$comment->id}}-collapse1reply" class="card-collapse collapse">
  					<div class="card-body">
    				<!-- forelse untuk menampilkan data balasan diskusi dari database -->
    				@forelse($comment->comments as $reply)
  					<div class="card w-75">
      					<div class="card-header" style="background-color: #D28329; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; text-align:start;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$reply->created_at->diffforHumans()}}</small></div>
      						<div class="card-body" style="background: #f9f9f9;"> 
								<div class="row" style="padding-top:10px;">
								<div class="col-md-2" style="text-align: center">
                        		<img class="avatar" src="{{asset(($reply->user->gambar))}}" alt="..." width="50px" style="padding: 5px;" >
								<div class="comment_user">
        							<b>{{$reply->user->name}}</b>
        						</div>
							</div>
      								<div class="col-md-10" style="word-wrap: break-word; overflow: hidden;">
									  <p style="text-align: justify">{{$reply->content}}</p>
									</div>
									
    							</div>
							</div>
							<div class="card-footer link_a">
									
								@if(Auth::user() && (Auth::user()->id == $reply->user_id))
								 <a style="float: right" type="submit" href="{{route('deleteDiscussVideo', $reply->id) }}" style="margin-left:10px" class="deleteBalasan" data-id="{{ $reply->id }}"><strong><i class="fa fa-trash"></i> Hapus </a></strong>
								<a style="float: right" data-toggle="modal" href="{{ route('editDiscussVideo',$reply->id) }}" data-target="#editDiskusi-{{ $reply->id }}" style="margin-left:10px"><strong><i class="fa fa-edit"></i> Edit </a></strong>								
								 @endif
								
									</div>
    				</div>
    				@empty
  					<p style="text-align: center;font-size: 20px;"><b> Tidak ada balasan</b></p>
  					@endforelse <!-- endforelse  untuk menampilkan data balasan diskusi dari database -->
					</div>
					   
					<!-- style untuk menampilkan kolom balasan diskusi -->
	  				<div class="panel-body" style="border-top: 1px solid #eee;">
	  					@if(Auth::guest())
              			@else
        				<form action="{{route('replyDiscuss', $comment->id)}}" id="balasdiskusiForm" >
      					<div class="form-group">
      						<input required="required" type="text" id="content" name="content" style="border-color: #F08035; float:left;" class="form-control w-75" id="input_reply" placeholder="Balas diskusi di sini">        
						</div>
							<button class="btn btn-success" id="send_balasdiskusi" type="submit" style="float: left; margin-left:10px;">Balas</button>
	  					</form>
	  					@endif
      				</div>
    				</div>
					<br>
					@empty
					<p style="text-align:center; font-size: 20px;"><b> Tidak ada Diskusi</b></p>
				  @endforelse <!-- endforelse untuk menampilkan data diskusi dari database -->
  			</div>
			</div>
		</div>
		<!-- batas akhir style balasan diskusi -->

			<!-- Batas awal pembuatan style fitur review -->
			<div class="collapse" id="ulasan">
				<div class="panel panel-default" style="background-color: #f9f9f9; margin-bottom:10px;">
              		<div class="panel-body">
						<h3>Berikan Ulasan Anda</h3>
						<table class="table w-50">
							<p>
                            <tr>
                                <th class="col-md-4" style="text-align: center;">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="5" data-size="s" disabled="">
								</th>
								<th class="col-md-4">
								  <p style="margin-left:10px;">{{$videox->ratings->where('rating','=','5')->count()}} Ulasan </p>
								  </th>
                            </tr>
                            <tr>
                                <th class="col-md-4" style="text-align: center;">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="4" data-size="s" disabled="">
								</th>
								<th class="col-md-4">
								  <p style="margin-left:10px;">{{$videox->ratings->where('rating','=','4')->count()}} Ulasan </p>
								  </th>
                            </tr>
                            <tr>
                                <th class="col-md-4" style="text-align: center;">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="3" data-size="s" disabled="">
								</th>
								<th class="col-md-4">
								  <p style="margin-left:10px;">{{$videox->ratings->where('rating','=','3')->count()}} Ulasan </p>
								  </th>
                            </tr>
                            <tr>
                                <th class="col-md-4" style="text-align: center;">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="2" data-size="s" disabled="">
								</th>
								<th class="col-md-4">
								  <p style="margin-left:10px;">{{$videox->ratings->where('rating','=','2')->count()}} Ulasan </p>
								  </th>
                            </tr>
                            <tr>
                                <th class="col-md-4" style="text-align: center;">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="1" data-size="s" disabled="">
								</th>
								<th class="col-md-4">
								  <p style="margin-left:10px;">{{$videox->ratings->where('rating','=','1')->count()}} Ulasan </p>
								  </th>
							</tr> 
							
							<br>
							<div class="card col-md-3" style="margin-right: 30px; margin-top:20px; text-align:center; box-shadow: 0 0 3pt 2pt #2F4799;">
							<p style="margin-top: 10px;"><b>Total ulasan:</b></p>	
							<input class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{round($videox->ratings->avg('rating'),2)}}" data-size="sm" disabled="">
							<p>{{$videox->ratings->count('rating')}} Ulasan</p>
							</div>
							</p> 
						</table>
	
					@if(Auth::guest())
               		<p style="text-align: center;"><a href="{{route('login')}}" style="color: #0D1852;">Silahkan <i class="fa fa-sign-in"></i><strong> Login</strong> </a> untuk memberikan ulasan.</p>
              		@else
                    <form  action="{{route('addReview', $videox->id)}}" id="reviewForm">
					<div class="alert alert-success" style="display:none; font-size:medium"></div>
                        <div class="card">
                            <div class="container-fliud">
                                <div class="card col-md-12">
                                    <div class="rating">
                                        <input id="rating" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="0" data-size="xs" required />
											<div class="form-group">
											<textarea id="content_ulasan" name="content_ulasan" class="form-control" style="border-color: #2F4799;" rows="3" placeholder="Tuliskan ulasan Anda"></textarea>
											</div>
                                            <button type="submit" id="send_review" class="btn" style="background: #2F4799; color:#fff;">Kirim Ulasan</button>
                                    </div>
								</div>
                            </div>
						</div>
				
					</form>
					<script type="text/javascript" 
					src="http://code.jquery.com/jquery-3.3.1.min.js"
               		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               		crossorigin="anonymous"> </script>
				<script type="text/javascript">
					jQuery(document).ready(function(){

						//kirim ulasan
            		jQuery('#send_review').click(function(e){
               		e.preventDefault();
               		$.ajaxSetup
					({
                  		headers: {
                      				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 				 }
             		 });

			  		$('#send_review').html('Mengirim..');
			  		url = $('#reviewForm').attr('action');
			  		reviewForm = $('#reviewForm').serialize();
                	var content_ulasan = $('#content_ulasan').serialize();
                	if(content_ulasan=="")
					{
						jQuery('.alert').show();
                    	jQuery('.alert').html('Please write a Post first!');
                	}
                else{
               jQuery.ajax({
                  url: url,
                  type: 'POST',
                  data: reviewForm,
                  success: function(result){
					jQuery('#send_review').html('Kirim Ulasan');
					jQuery('#reviewForm')[0].reset();
					jQuery('.alert').show();
                    jQuery('.alert').html(result.success);
                  }});
				}
               });
            });
				</script>
					@endif
					</div>
				
				<!-- Style untuk menampilkan data review dari database -->
				@forelse($videox->ratings->sortByDesc('created_at') as $rating)
            	<div id="display-review" class="panel panel-body">
  				<div class="card-header" style=" background-color: #2F4799; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px; text-align:end;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$rating->created_at->diffforHumans()}}</small></div>
  					<div class="card-body" style="background: #f9f9f9; "> 
						<div class="row" style="padding-top:10px;">
      						<div class="col-md-1" style="text-align: center">
                        		<img class="avatar" src="{{asset(($rating->user->gambar))}}" alt="..." width="50px" >
								<div class="comment_user" >
        							<b>{{$rating->user->name}}</b>
								</div>
							</div>
							  <div class="col-md-10" style="word-wrap: break-word; overflow: hidden;">
							  	<input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $rating->rating }}" data-size="xs" disabled="">
							  	<p style="margin-top: 10px; text-align:justify ">{{$rating->content_ulasan}}</p>
							</div>	
   						 </div>
					</div>
				</div>
				@empty
  				<p style="text-align:center; font-size: 20px;"><b> Belum ada ulasan</b></p>
				@endforelse
				</div>
			</div>
			<!-- Batas akhir style fitur review -->	

			<!-- Batas awal style pembuatan fitur karya kelas -->
			<div class="collapse" id="karyakelas">
			<div class="panel panel-default" style="background-color: #f9f9f9; margin-bottom:10px;">
              	<div class="panel-body">
				<div class="container">
					<div class="card-title"><h3><b>Deskripsi Karya</b></h3></div>
					<p class="card-text">Bagian ini berisi tentang deskripsi karya kelas.</p>
					<br>
					<div class="card-title"><h3><b>Karya Siswa</b></h3></div>
					<p>
					<?php
					foreach($modul2 as $mod)
					?>
					  @if(Auth::guest())
					  @else
  					<a style="border: 2px solid #2F4799; color:#D28329; " class="btn" data-toggle="modal" href="#uploadkarya" role="button" aria-expanded="false">
    				<b>UPLOAD KARYA</b>
  					</a>
					</p>
					@endif
				</div>

					<h3 style="text-align: center"><b>Galeri</b></h3>
					<hr class="divider">
					<div class="container">

						<!-- Looping row in every 4 columns -->
						<?php //Columns must be a factor of 12 (1,2,3,4,6,12)
						$numOfCols = 4;
						$rowCount = 0;
						$bootstrapColWidth = 12 / $numOfCols;
						foreach($videox->karya_kelas as $karya){
						if($rowCount % $numOfCols == 0) { ?> <div class="row"> <?php } 
						$rowCount++; 
						?> 

					@foreach(array_slice(json_decode($karya->hasil_karya, true), 0, 1) as $images)
					<div class="col-md-<?php echo $bootstrapColWidth; ?>">
	    			<div class="card-karya card">
	      			<div class="work-box2">
            			<a data-toggle="modal" data-target="#detilkarya-{{ $karya->id }}">
		          		<div class="work-img">
		            		<img src="{{ URL::to('hasil_karya/'.$karya->user_id.'/'.$images)}}" class="img-thumbnail br-top-img card-img-top-karya" />
		          		</div>
						</a>
					</div>
                    <div class="card-block-karya">
						<a href="#">{{$karya->user->name}}</a> 
						<p style="float: right">0 Suka</p><br><br>
						<p style="float: left">{{$karya->karya_comments->count()}} Komentar</p>
						<span style="float: right"><i class="fa fa-heart-o" style="font-size:24px; color:black"></i></span>

                    </div>
					</div>
					</div>
					@endforeach 

					<?php
					if($rowCount % $numOfCols == 0) { ?> </div> <?php } } 
					?>
					
					</div>
				</div>

			</div>
			</div>
			<!-- Batas akhir style pembuatan fitur karya kelas -->

	</div>
	</div>
  	<!-- Batas akhir pembuatan fitur diskusi, review dan karya kelas -->


<h3><b>Modul Lainnya</b></h3>

<div class="row_b">
  <div class="regular slider">
    {{-- Modul Lainnya --}}
    @foreach($modul2 as $d)
	@php
		$join = DB::table('cart')->where('stcart', 1)->where('modul_id', $d->id)->count();
	@endphp

	<div class="col-md-3">
	    <div class="card card-other">
	      	<div class="work-box2">
            	<a href="{{asset('modul/' . $d->id . '/show' )}}">
		          	<div class="work-img">
		            	<img src="{{ asset($d->gambar) }}" class="img-thumbnail br-top-img" />
		          	</div>
		        </a>
	      	</div>
	      	<div class="panel-body" style="height: 145px">
            	<a class="text-dark" href="{{asset('modul/' . $d->id . '/show' )}}">
		          	<p class="mt-0 mb-0"><b>
		          	@if(strlen($d->judul) > 45)
		          	{{ substr($d->judul, 0, 45) . "..." }}
		          		@else
		          	{{$d->judul}}
		          	@endif
		         	</b></p>
		        </a>
		        <span class="text-smaller">{{$d->nm_trainer}}</span>
			    @if($d->sertifikat == 1)
		        <br>
				@for($i = 1; $i <= 5; $i++)
		        <span class="fa fa-star text-star checked-star mt-2"></span>
		        @endfor
		        <span class="text-secondary">({{$join}})</span>
		        <br>

			    <div class="floating-box mt-2">
			    	<strike>{{rp($d->harga_lama)}}</strike>
			    </div>
		    <div class="floating-box">
			    	<b class="text-large">{{rp($d->harga)}}</b>
			    </div>
			    @endif
	      	</div>
	    </div>
	</div>
@endforeach
    {{-- End --}}
  </div>
</div>

@foreach ($modul as $m)
@endforeach


@endsection

@section('js-section')

<script>

$("#input-id").rating();

function warningLock() {
	Swal.fire(
		'Video ini bersifat premium',
		'Silahkan membeli modul ini untuk menonton seluruh video',
		'info'
	)
}

var lebarWindow = $(window).outerWidth();
if (lebarWindow >= 975) {
    $('iframe').load(function() {
        var tinggiVideo = $(".video-slide").outerHeight() - 55;
        $('ul.list-group').attr('style', 'max-height: '+tinggiVideo+'px;');
    });
}   
</script>
@endsection

