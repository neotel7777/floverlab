<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            @foreach($actions as $ind => $title)
                <div class="variant">
                    <h4 class="variant_title">
                        {{ $title }}
                    </h4>
                    {{ Form::text('translatable[checkout_data_actions_title'.$ind.']', trans('storefront::checkout.checkout_actions_title'), $errors, $settings, ['required' => true]) }}
                </div>
            @endforeach
                {{ Form::text('translatable[checkout_actions_block_title]', trans('storefront::checkout.checkout_actions_block_title'), $errors, $settings, ['required' => true]) }}
                {{ Form::text('translatable[checkout_actions_selector_title]', trans('storefront::checkout.checkout_actions_selector_title'), $errors, $settings, ['required' => true]) }}
                {{ Form::textarea('translatable[checkout_actions_block_title_hint]', trans('storefront::checkout.checkout_actions_block_title_hint'), $errors, $settings) }}
        </div>
    </div>
</div>
