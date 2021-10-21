@extends('master')
@section('title', 'Catalog-Z Contact Resultat')


@section('content')


    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg"></div>

    <div class="container-fluid tm-mt-60">
        <div class="row tm-mb-50 contactcenter">
            <div class="col-lg-4 col-12 mb-5">
                <h2 class="tm-text-primary mb-5">Contact Page</h2>
                <form id="contact-form" action="" method="POST" class="tm-contact-form mx-auto">
                @csrf
                    <div class="form-group">
                        name:<input type="text" name="name" class="form-control rounded-0" placeholder="{{ $data->name }}" required />
                    </div>
                    <div class="form-group">
                        Email:<input type="email" name="email" class="form-control rounded-0" placeholder="{{ $data->email }}" required />
                    </div>
                    <div class="form-group">
                        Type:<input type="text" name="inquiry" class="form-control rounded-0" placeholder="{{ $data->inquiry }}" required />
                    </div>
                    <div class="form-group">
                        Message:<textarea rows="8" name="message" class="form-control rounded-0"  required=>{{ $data->message }}</textarea>
                    </div>

                </form>                
            </div>

        </div>
        
    @endsection