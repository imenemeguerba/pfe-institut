@if($services->isEmpty())
    <div class="state-empty"><i class="fa-solid fa-triangle-exclamation"></i> No services available with these filters.</div>
@else
    <div class="services-grid-res">
        @foreach($services as $service)
            <label class="service-option-res {{ in_array($service->id, $servicesPreSelectionnes) ? 'selected' : '' }}">
                <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                       data-prix="{{ $service->prix }}" data-duree="{{ $service->duree }}" data-nom="{{ $service->nom }}"
                       {{ in_array($service->id, $servicesPreSelectionnes) ? 'checked' : '' }}
                       class="service-checkbox">
                <div class="svc-img-wrap">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->nom }}">
                    @else
                        <div class="svc-img-placeholder">{{ mb_strtoupper(mb_substr($service->nom, 0, 2)) }}</div>
                    @endif
                    <div class="svc-img-cat-badge">{{ $service->category->nom }}</div>
                    <div class="svc-img-check-badge"></div>
                </div>
                <div class="svc-body">
                    <div class="svc-name">{{ $service->nom }}</div>
                    @if($service->description)
                        <div class="svc-desc">{{ Str::limit($service->description, 70) }}</div>
                    @endif
                    <div class="svc-footer">
                        <div class="svc-price">{{ number_format($service->prix, 0, ',', ' ') }} DA</div>
                        <div class="svc-dur"><i class="fa-regular fa-clock" style="font-size:10px;"></i> {{ $service->dureeFormatee() }}</div>
                    </div>
                </div>
            </label>
        @endforeach
    </div>
@endif