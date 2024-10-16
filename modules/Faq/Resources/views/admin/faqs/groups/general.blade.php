<div class="box">
    <div class="box-header">
        <h5>{{ trans('faq::faq.items.groups.general') }}</h5>
    </div>

    <div class="box-body clearfix">
        <div class="form-group">
            <label for="title" class="control-label text-left">
                {{ trans('faq::attributes.items.title') }}

                <span class="text-red">*</span>
            </label>

            <input type="text" name="name" id="title" class="form-control" x-model="form.name" autofocus>

            <template x-if="errors.has('name')">
                <span class="help-block text-red" x-text="errors.get('name')"></span>
            </template>
        </div>

        <div class="form-group">
            <label for="description" class="control-label text-left" @click="focusDescriptionField">
                {{ trans('faq::attributes.items.description') }}

                <span class="text-red">*</span>
            </label>

            <textarea name="description" id="description" class="form-control wysiwyg" x-model="form.description">
            </textarea>

            <template x-if="errors.has('description')">
                <span class="help-block text-red" x-text="errors.get('description')"></span>
            </template>
        </div>
    </div>
</div>
