<div class="box">
    <div class="box-header">
        <h5>{{ trans('faq::faq.items.groups.publish') }}</h5>
    </div>

    <div class="box-body">
        <div class="form-group">
            <label for="publish_status" class="control-label text-left asterisk-align">
                {{ trans('faq::attributes.items.publish_status') }}

                <span class="text-red">*</span>
            </label>

            <select name="publish_status" id="publish_status" class="form-control custom-select-black" x-model="form.publish_status">
                <option value="published" {{ old('publish_status') == 'published' ? 'selected' : '' }}>
                    {{ trans('faq::faq.items.form.publish_status.published') }}
                </option>

                <option value="unpublished" {{ old('publish_status') == 'unpublished' ? 'selected' : '' }}>
                    {{ trans("faq::faq.items.form.publish_status.unpublished") }}
                </option>
            </select>

            <template x-if="errors.has('publish_status')">
                <span class="help-block text-red" x-text="errors.get('publish_status')"></span>
            </template>
        </div>
    </div>
</div>
