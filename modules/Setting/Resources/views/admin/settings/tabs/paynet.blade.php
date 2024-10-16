<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('paynet_enabled', trans('setting::attributes.paynet_enabled'), trans('setting::settings.form.enable_paynet'), $errors, $settings) }}
        {{ Form::text('translatable[paynet_label]', trans('setting::attributes.translatable.paynet_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::textarea('translatable[paynet_description]', trans('setting::attributes.translatable.paynet_description'), $errors, $settings, ['rows' => 3, 'required' => true]) }}
        {{ Form::checkbox('paynet_test_mode', trans('setting::attributes.paynet_test_mode'), trans('setting::settings.form.use_sandbox_for_test_payments'), $errors, $settings) }}

        <div class="{{ old('paynet_enabled', array_get($settings, 'paynet_enabled')) ? '' : 'hide' }}" id="paynet-fields">
            {{ Form::text('paynet_merchant_id', trans('setting::attributes.paynet_merchant_id'), $errors, $settings, ['required' => true]) }}
            {{ Form::text('paynet_merchant_key', trans('setting::attributes.paynet_merchant_key'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('paynet_passphrase', trans('setting::attributes.paynet_passphrase'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
