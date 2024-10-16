<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            @foreach($blocks as $ind => $title)
                <div class="variant">
                    <h4 class="variant_title">
                        {{ $title }}
                    </h4>
                    {{ Form::text('translatable[checkout_success_blocks_title'.$ind.']', trans('storefront::checkout.check_success_blocks_title'), $errors, $settings, ['required' => true]) }}
                    {{ Form::textarea('translatable[checkout_success_blocks_description'.$ind.']', trans('storefront::checkout.check_success_blocks_description'), $errors, $settings) }}
                </div>
            @endforeach

        </div>
    </div>
</div>
