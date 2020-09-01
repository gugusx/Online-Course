@extends('layouts.user')
@section('content')

<h2 class="title-type mb-5 mt-2">Helpdesk</h2>

<div class="row">
	<div class="col-md-4 col-help-a">
		<img src="{{asset('assets/images/question.png')}}" height="290" alt="">
	</div>
	<div class="col-md-3 col-help">
		<div class="card-help border-0">
			<div class="content">
				<div class="text-center">
					<i class="pe-7s-chat icon-help"></i>
					<br>
					<p class="text-hafecs fs-13 mb-0"><b>Chat dengan kami</b></p>
					<p class="text-hafecs fs-13">Kirimkan chat melalui platform ini</p>
				</div>
			</div>
		</div>
		<div class="card-help stack-card-help">
            <div class="panel-body">
				<a href="#!" class="btn btn-help mt-5 btn-block border-10">Chat</a>
            </div>
        </div>
	</div>
	<div class="col-md-3 col-help">
		<div class="card-help border-0">
			<div class="content">
				<div class="text-center">
					<i class="pe-7s-paper-plane icon-help"></i>
					<br>
					<p class="text-hafecs fs-13 mb-0"><b>Email kami</b></p>
					<p class="text-hafecs fs-13">Kirim pertanyaan langsung ke alamat email kami</p>
				</div>
			</div>
		</div>
		<div class="card-help stack-card-help">
            <div class="panel-body">
				<a href="#!" class="btn btn-help mt-5 btn-block border-10">Kirim Email</a>
            </div>
        </div>
	</div>
	<div class="col-md-3 col-help">
		<div class="card-help border-0">
			<div class="content">
				<div class="text-center">
					<i class="pe-7s-call icon-help"></i>
					<br>
					<p class="text-hafecs fs-13 mb-0"><b>Hubungi kami</b></p>
					<p class="text-hafecs fs-13">Hubungi kami melalui telepon</p>
				</div>
			</div>
		</div>
		<div class="card-help stack-card-help">
            <div class="panel-body">
				<a href="#!" class="btn btn-help mt-5 btn-block border-10">Hubungi</a>
            </div>
        </div>
	</div>
</div>


<h2 class="title-type mb-5 mt-2">Pertanyaan Umum</h2>

<div class="panel-group" id="accordion-cat-1">
    <div class="panel panel-default panel-faq">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-1">
                <h4 class="panel-title">
                   <b> Siapa saja yang bisa berkontribusi di HAFECS Online Course</b>
                </h4>
            </a>
        </div>
        <div id="faq-cat-1-sub-1" class="panel-collapse collapse">
            <div class="panel-body pt-0 text-gray">
            	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia natus sequi ipsum provident quod explicabo, similique, deleniti suscipit. Doloribus qui minima, suscipit sed odit modi dolorem libero debitis, autem laborum.
            </div>
        </div>
    </div>
    <div class="panel panel-default panel-faq">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-2">
                <h4 class="panel-title">
                   <b>Dimana letak kantor HAFECS</b>
                </h4>
            </a>
        </div>
        <div id="faq-cat-1-sub-2" class="panel-collapse collapse">
            <div class="panel-body pt-0">
            	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, nulla, eaque. Ea laborum quaerat, cum quidem magni praesentium ratione ducimus ab dicta, magnam ad nemo nisi architecto molestias temporibus minus!
            </div>
        </div>
    </div>
    <div class="panel panel-default panel-faq">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-3">
                <h4 class="panel-title">
                   <b>Bagaimana cara mendaftar menjadi coach di HAFECS</b>
                </h4>
            </a>
        </div>
        <div id="faq-cat-1-sub-3" class="panel-collapse collapse">
            <div class="panel-body pt-0">
            	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis suscipit in quae deserunt vel voluptas corporis temporibus tempora amet, consequuntur corrupti fuga iusto ex quis est perferendis pariatur adipisci sapiente.
            </div>
        </div>
    </div>
    <div class="panel panel-default panel-faq">
        <div class="panel-heading">
            <a data-toggle="collapse" data-parent="#accordion-cat-1" href="#faq-cat-1-sub-4">
                <h4 class="panel-title">
                   <b>Bagaimana cara saya mendaftarkan sekolah saya</b>
                </h4>
            </a>
        </div>
        <div id="faq-cat-1-sub-4" class="panel-collapse collapse">
            <div class="panel-body pt-0">
            	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis suscipit in quae deserunt vel voluptas corporis temporibus tempora amet, consequuntur corrupti fuga iusto ex quis est perferendis pariatur adipisci sapiente.
            </div>
        </div>
    </div>
</div>


@endsection