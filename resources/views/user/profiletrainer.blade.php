@extends('layouts.user')
@section('content')
@include('sweet::alert')



    <div class="col-md-7">
     
        <div class="row">
            <div class="col-md-4 text-center mb-3">
                <img src="{{asset($trainers->gambar)}}" style="border-radius: 50%; height: 120px;" class="img-thumbnail mb-2" alt="">
                <br>
            <br>
               <a href=""><button class="btn btn-sm" style="border-color: #2F4799; color:black"><i class="fa fa-instagram"></i> Instagram</button></a>
               
            </div>
            <div class="col-md-8 text-justify pt-3">
            <b style="font-size: 18pt">{{$trainers->nm_trainer}}</b><br>
            <span>{{$trainers->jabatan}}</span>
                <div class="readmore" style="padding-top: 50px">
            <!--    {!!html_entity_decode($modul->isi)!!} --> 
            <b style="font-size: 15pt">Tentang Saya</b><br>
           <br> Biografi singkat trainer
                </div>
                <div style="padding-top: 50px">
                    <b style="font-size: 15pt">Video Singkat</b>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-expander/1.7.0/jquery.expander.js"></script>
        <script type="text/javascript">
            $(".readmore").expander({
                  slicePoint : 301,
                  expandText: 'More',
                  userCollapseText : 'Less'
            });
        </script>
      

    </div>
    



@endsection