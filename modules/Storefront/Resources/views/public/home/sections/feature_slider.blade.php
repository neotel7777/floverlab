<section class="home-section-wrap">
    <div class="sectionWrap">
        <div class="row">
            <div class="home-feature features">
                <div class="home-slider-wrap">
                    <div
                        class="feature-list overflow-hidden"
                        data-speed="{{ $slider->speed }}"
                        data-autoplay="{{ $slider->autoplay ? 'true' : 'false' }}"
                        data-autoplay-speed="{{ $slider->autoplay_speed }}"
                        data-fade="{{ $slider->fade ? 'true' : 'false' }}"
                        data-dots="{{ $slider->dots ? 'true' : 'false' }}"
                        data-arrows="{{ $slider->arrows ? 'true' : 'false' }}"
                        data-slidesToShow="auto"
                        data-slidesToScroll="1"
                    >
                        @foreach ($slider->slides as $slide)
                            <div class="feature">
                                <img src="{{ $slide->file->path }}" class="slider-imagea">
                                <div class="feature_content">
                                    {!! $slide->caption_1 !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
