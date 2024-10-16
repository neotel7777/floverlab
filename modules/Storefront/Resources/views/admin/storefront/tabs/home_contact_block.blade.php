<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            {{ Form::text('translatable[data_title]', trans('storefront::storefront.home_contacts.data_title'), $errors, $settings) }}
            {{ Form::text('translatable[worktime_title]', trans('storefront::storefront.home_contacts.worktime_title'), $errors, $settings) }}
            {{ Form::textarea('translatable[worktime_data]', trans('storefront::storefront.home_contacts.worktime_data'), $errors, $settings, ['rows' => 5,'class'=>'wysiwyg']) }}
            {{ Form::text('translatable[address_title]', trans('storefront::storefront.home_contacts.address_title'), $errors, $settings) }}
            {{ Form::text('translatable[contact_title]', trans('storefront::storefront.home_contacts.contact_title'), $errors, $settings) }}
            {{ Form::text('translatable[block_title]', trans('storefront::storefront.home_contacts.block_title'), $errors, $settings) }}
            {{ Form::text('translatable[block_subtitle]', trans('storefront::storefront.home_contacts.block_subtitle'), $errors, $settings) }}
            {{ Form::textarea('translatable[block_description]', trans('storefront::storefront.home_contacts.description'), $errors, $settings, ['rows' => 5,'class'=>'wysiwyg']) }}
        </div>

        <div class="box-content clearfix">
        	@include('media::admin.image_picker.single', [
        	    'title' => trans('storefront::storefront.home_contacts.image'),
        	    'inputName' => 'storefront_home_contacts_image',
        	    'file' => $homeContactsImage,
        	])
        </div>
    </div>
</div>
