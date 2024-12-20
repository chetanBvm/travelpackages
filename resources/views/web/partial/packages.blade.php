    @foreach ($packageList as $packages)
        <div class="package-wapper">
            <div class="row">
                <div class="col-md-5">
                    <div class="package-left">
                        <figure>
                            <img src="{{ asset('storage') . '/' . $packages->thumbnail }}">
                        </figure>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="package-left">
                        <ul class="package-left-head">
                            <li>
                                <h2>{{ $packages->name }}</h2>
                                <span class="day-night">{{ $packages->days }} Days</span>
                            </li>
                            
                            <li>
                                @php
                                    $currency = $packages->destination->country->currency_symbol;
                                @endphp
                                <h3>  {{$currency}} {{ $packages->price }}</h3>
                                <span class="start-price">Starting Price</span>
                            </li>
                        </ul>
                        <div class="package-left-middle">
                            @php
                                $truncatedDescription = Str::limit(
                                    strip_tags($packages->description),
                                    200,
                                    '...',
                                );
                            @endphp
                            <p>{!! $truncatedDescription !!}</p>
                            <a class="view-more-btn"
                                href="{{ route('web.packageDetails', $packages->id) }}">View More</a>
                        </div>

                        <a class="travel-btn"
                            href="{{ route('web.packageDetails', $packages->id) }}">Send
                            Enquiry</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
