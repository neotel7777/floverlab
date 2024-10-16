<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            @foreach($variants as $ind => $title)
                <div class="variant">
                    <h4 class="variant_title">
                        {{ $title }}
                    </h4>
                    {{ Form::text('translatable[checkout_data_variants_title'.$ind.']', trans('storefront::checkout.checkout_data_title'), $errors, $settings, ['required' => true]) }}
                    {{ Form::text('translatable[checkout_data_variants_description'.$ind.']', trans('storefront::checkout.checkout_data_description'), $errors, $settings, ['required' => true]) }}
                    {{ Form::textarea('translatable[checkout_data_variants_'.$ind.']', trans('storefront::checkout.checkout_data_hint'), $errors, $settings) }}
                </div>

            @endforeach
        </div>
    </div>
</div>
