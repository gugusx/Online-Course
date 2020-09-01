@extends('layouts.user')
@section('content')

<h3 class="title-type" style="padding-bottom: 10px">Tentang Kami</h3>

<div class="row">
    <div class="col-xs-12 col-md-6" style="padding-bottom: 50px">
       
            
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Jn7vuXLozJI" frameborder="0" allowfullscreen></iframe>
</div>
            
        
        
    </div>

    <div class="col-xs-12 col-md-6" style="padding-bottom: 30px;">
   <h2 class="title-type" style="text-align: center;">TENTANG HAFECS</h2>
   <div style="text-align: justify; font-size:14pt; padding:10px">
   HAFECS (<i>Highly Functioning Education Consulting Services</i>) adalah sebuah lembaga yang didirikan Yayasan Hasnur Centre. Menjadi salah satu divisi di bidang training guru sebagai upaya untuk mendorong percepatan transformasi pendidikan Indonesia melalui pengembangan metode pengajaran di kelas dan metode pembelajaran serta pengembangan kurikulum sekolah.
   </div>
   <div style="text-align: center">
   <a href="{{asset('../company/Company-Profile-Hafecs.pdf')}}" target="_blank" ><button class="btn btn-blue"><b style="font-size:12pt">Download Company Profile HAFECS</b></button></a>
   </div>
    </div>

    <div class="col-xs-12 col-md-12" style="padding-bottom: 30px; padding-top: 50px">
   <h2 class="title-type" style="text-align: center;">KENAPA PILIH HAFECS?</h2>
   <div style="text-align: center; font-size:14pt; padding:10px">
   <div class="col-md-4" style="padding-bottom: 30px">
      <img src="{{asset('../uploads/trophy.png')}}" width="80px" height="auto" alt=""> 
      <br>
      <h4><b>Trainer Terbaik di Bidang Pendidikan</b></h4>
    <span style="font-size: 11pt"> Para Trainer HAFECS adalah para trainer profesional dan tersertifikasi internasional yang telah bekerja rata-rata lebih dari 10 tahun di bidang-pendidikan dengan 1 master trainer dan 5 trainer.</span> 
   </div>
   <div class="col-md-4" style="padding-bottom: 30px">
   <img src="{{asset('../uploads/idea.png')}}" width="80px" height="auto" alt=""> 
      <br>
      <h4><b>Inovasi Program</b></h4>
    <span style="font-size: 11pt">Inovasi Program telah dikembangkan oleh HAFECS di Global Islamic Boarding School (GIBS) seperti Dynamic Lesson Plan, Teaching Grading System, dan New Training Approach for Teachers terutama dalam rangka membantu penguasaan Kurikulum-13 dan Anderson Taxonomy.</span> 
   </div>
   <div class="col-md-4">
   <img src="{{asset('../uploads/channel.png')}}" width="80px" height="auto" alt=""> 
      <br>
      <h4><b>Interactive Training</b></h4>
    <span style="font-size: 11pt">Dalam setiap event HAFECS, Interactive Training selalu menjadi metode. Tidak hanya teori, praktik dengan memberikan pengajaran yang nyata di kelas, peserta diajak aktif untuk mengeksplor pengetahuannya dengan berbagai konteks dan analogi yang telah ditentukan oleh trainer diberikan dalam kelas juga diimbangi dengan ice breaking.</span> 
   </div>
   </div>
    </div>

    <div class="col-xs-12 col-md-12" style="padding-bottom: 30px; padding-top: 50px">
   <h2 class="title-type" style="text-align: center;">UNTUK SIAPA HAFECS ADA?</h2>
   <div style="text-align: center; font-size:14pt; padding:10px">
   <div class="row">
   <div class="col-md-6" style="padding-bottom: 30px">
   
   <div class="col-md-4">
      <img src="{{asset('../uploads/teacher.png')}}" width="80px" height="auto" alt=""> 
    </div>
      <div class="col-md-8">
<h4><b>Guru</b></h4>
<span style="font-size: 11pt">Pendidik, pembimbing, pengajar dan fasilitator dalam proses belajar mengajar.</span>
      </div>
     
   </div>
  
   <div class="col-md-6" style="padding-bottom: 30px">
   
   <div class="col-md-4">
      <img src="{{asset('../uploads/school.png')}}" width="80px" height="auto" alt=""> 
    </div>
      <div class="col-md-8">
<h4><b>Sekolah</b></h4>
<span style="font-size: 11pt">Lembaga penyelenggaraan pendidikan dan pengajaran bagi siswa-siswi.</span>
      </div>
     
   </div>
   
   <div class="col-md-6" style="padding-bottom: 30px">
   
   <div class="col-md-4">
      <img src="{{asset('../uploads/teacherss.png')}}" width="80px" height="auto" alt=""> 
    </div>
      <div class="col-md-8">
<h4><b>Praktisi Pendidikan</b></h4>
<span style="font-size: 11pt">Peneliti disebuah perguruan tinggi, universitas, dan lembaga setara.</span>
      </div>
     
   </div>

   <div class="col-md-6" style="padding-bottom: 30px">
   
   <div class="col-md-4">
      <img src="{{asset('../uploads/student.png')}}" width="80px" height="auto" alt=""> 
    </div>
      <div class="col-md-8">
<h4><b>Calon Guru</b></h4>
<span style="font-size: 11pt">Mahasiswa yang telah lulus di perguruan tinggi dan belum mengikuti pelatihan menjadi seorang guru.</span>
      </div>
     
   </div>

   </div>
   </div>
    </div>
</div>



@endsection