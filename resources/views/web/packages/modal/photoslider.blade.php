
<div class="photo-slider-section">
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">All Photos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body owl-carousel owl-theme pop-images ">
                                            @foreach($data['packageImages'] as $image)
                    <div class="item">
                        <img src="{{asset('storage').'/'.$image->images}}">
                    </div>
                    @endforeach
               </div>
            </div>
        </div>
    </div>
</div>