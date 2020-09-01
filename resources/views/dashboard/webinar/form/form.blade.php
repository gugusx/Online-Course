<div class="form-group">
    {!! Form::label('judul','Judul',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        {!! Form::text('judul',null,array('class'=>'form-control','placeholder'=>'Judul '),'')!!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('link','Link',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        {!! Form::text('link',null,array('class'=>'form-control','placeholder'=>'Link'),'')!!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('tanggal','Tangal',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        <input type="date" class="form-control" name="tanggal" value="{{$webinar->tanggal}}" />
    </div>
</div>
<div class="form-group">
    {!! Form::label('jam','Jam',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        <input type="time" class="form-control" name="jam" value="{{$webinar->jam}}" />
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        {!! Form::textarea('isi',null,array('class'=>'form-control','id'=>'area'),'')!!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('tipe','Tipe Webinar',array('class'=>'col-md-1 control-label'))!!}
    <div class="col-md-11">
        <select class="form-control" name="stat" id="tipe">
            <option value="Free" {{ ($webinar->stat == 'Free') ? 'selected' : '' }}>Free</option>
            <option value="Premium" {{ ($webinar->stat == 'Premium') ? 'selected' : '' }}>Premium</option>
        </select>
    </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="col-md-6">
    {!! Form::submit($submit_text,['class'=>'btn btn-primary'])!!}
</div>