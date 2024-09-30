@foreach ($product->variations as $variation)
    <div class="variant-custom-selection">
        <div class="flex-column-start-start gap-20">
            <div class="variation-title font-16-20-normal color-black">
                {{ $variation->name }}
            </div>

            <div class="variationsList">
                <ul class="list-inline form-custom-radio custom-selection flex-row-start-center">
                    @foreach ($variation->values as $value)
                        <li
                            :title="
                                isVariationValueEnabled('{{ $variation->uid }}', {{ $loop->parent->index }}, '{{ $value->uid }}') &&
                                !isActiveVariationValue('{{ $variation->uid }}', '{{ $value->uid }}') ?
                                '{{ trans('storefront::product.click_to_select') }} {{ $value->label }}' :
                                ''
                            "
                            class="
                                {{ $variation->type === 'color' ? 'variation-color' : '' }}
                                {{ $variation->type === 'image' ? 'variation-image' : '' }}
                            "
                            :class="{
                                active: isActiveVariationValue('{{ $variation->uid }}', '{{ $value->uid }}'),
                                disabled: !isVariationValueEnabled('{{ $variation->uid }}', {{ $loop->parent->index }}, '{{ $value->uid }}')

                            }"
                            @mouseenter="setVariationValueLabel({{ $loop->parent->index }}, {{ $loop->index }})"
                            @mouseleave="setActiveVariationValueLabel({{ $loop->parent->index }})"
                            @click="syncVariationValue(
                                '{{ $variation->uid }}',
                                {{ $loop->parent->index }},
                                '{{ $value->uid }}',
                                {{ $loop->index }}
                            )"
                        >
                            @if ($variation->type === 'text')
                                {{ $value->label }}
                            @elseif ($variation->type === 'color')
                                <div style="background-color: {{ $value->color }};"></div>
                            @elseif ($variation->type === 'image')
                                <img src="{{ $value->image->path }}" alt="{{ $value->label }}">
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endforeach
