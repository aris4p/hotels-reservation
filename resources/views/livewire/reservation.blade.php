<div>
    <section class="section">
        <div class="container">
          
            @foreach ($data as $item)
                
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-5" data-aos="fade-up">
                    <a href="#" class="room">
                        <figure class="img-wrap">
                            <img src="{{ asset('assets/images/img_1.jpg') }}" alt="Free website template" class="img-fluid mb-3">
                        </figure>
                        <div class="p-3 text-center room-info">
                            <h2>{{ $item->kamar->tipe }}</h2>
                            <span class="text-uppercase letter-spacing-1">Rp. {{ $item->kamar->harga }} / per night</span>
                        </div>
                    </a>
                </div>
            @endforeach
    
           
    
          </div>
        </div>
      </section>
      
</div>
