@if($services->isEmpty())
    <div class="sv-empty">
        <i class="fa-solid fa-spa"></i>
        <p>No services match your criteria.</p>
    </div>
@else
    <div class="sv-grid" id="sv-grid">
        @foreach($services as $service)
            <div class="sv-card">
                <div class="sv-card-img">
                    @if($service->image)
                        <img src="{{ asset('storage/'.$service->image) }}" alt="{{ $service->nom }}">
                    @else
                        <div class="sv-card-img-placeholder">💄</div>
                    @endif
                    <span class="sv-card-cat">{{ $service->category->nom }}</span>
                    <div class="sv-card-overlay">
                        <a href="{{ route('client.services.show', $service) }}" class="sv-card-overlay-btn">
                            <i class="fa-solid fa-eye"></i> View Details
                        </a>
                    </div>
                </div>
                <div class="sv-card-body">
                    <div class="sv-card-name">{{ $service->nom }}</div>
                    @if($service->description)
                        <div class="sv-card-desc">{{ Str::limit($service->description, 80) }}</div>
                    @endif
                    <div class="sv-card-footer">
                        <div>
                            <div class="sv-card-price">{{ number_format($service->prix,0,',',' ') }} DA</div>
                            <div class="sv-card-price-sub"><i class="fa-regular fa-clock" style="font-size:9px;"></i> {{ $service->dureeFormatee() }}</div>
                        </div>
                        <a href="{{ route('client.services.show', $service) }}" class="sv-card-action">
                            Explore <i class="fa-solid fa-arrow-right" style="font-size:10px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif