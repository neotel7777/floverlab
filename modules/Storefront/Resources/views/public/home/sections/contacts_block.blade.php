<div class="sectionWrap home_block_contacts flex-column-start-start">
    <div class="top_block flex-row-between-center">
        <img src="{{ $contact_block_image }}" class="contact_block_image">
        <div class="contact_block_data flex-column-start-start color-black">
            <div class="contact_title color-black font-30-36-500">
                {{ setting('data_title') }}
            </div>
            <div class="blocks flex-column-start-start">
                <div clas="blockWrap flex-column-start-start">
                    <div class="block_title font-18-24-500 ">
                        {{ setting('worktime_title') }}
                    </div>
                    <div class="block_data flex-row-start-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15ZM7.5 3.5V8.70711L10.1464 11.3536L10.8536 10.6464L8.5 8.29289V3.5H7.5Z" fill="#499777"/>
                        </svg>
                        <div class="block_text color-dark font-14-16-normal">
                            {{ setting('worktime_data') }}
                        </div>
                    </div>
                </div>
                <div clas="blockWrap flex-column-start-start">
                    <div class="block_title font-18-24-500">
                        {{ setting('address_title') }}
                    </div>
                    <div class="block_data flex-row-start-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00018 1C3.38307 1 0.777755 6.3537 3.68719 9.95585L7.61121 14.8142C7.70614 14.9317 7.84911 15 8.00018 15C8.15126 15 8.29423 14.9317 8.38915 14.8142L12.3132 9.95585C15.2226 6.3537 12.6173 1 8.00018 1ZM9.50024 6.5C9.50024 7.32843 8.82867 8 8.00024 8C7.17182 8 6.50024 7.32843 6.50024 6.5C6.50024 5.67157 7.17182 5 8.00024 5C8.82867 5 9.50024 5.67157 9.50024 6.5Z" fill="#499777"/>
                        </svg>
                        <div class="block_text  color-dark font-14-16-500">
                            {{ setting('store_address_1') }}, {{$shop_country}} {{$shop_city}}
                        </div>
                    </div>
                </div>
                <div clas="blockWrap flex-column-start-start">
                    <div class="block_title  font-18-24-500">
                         {{ setting('contact_title') }}
                    </div>
                    <div class="block_data flex-row-start-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.77639 1.55279C5.607 1.214 5.26074 1 4.88197 1H2C1.44772 1 1 1.44772 1 2V3C1 9.62742 6.37258 15 13 15H14C14.5523 15 15 14.5523 15 14V11.118C15 10.7393 14.786 10.393 14.4472 10.2236L12.967 9.4835C12.3895 9.19476 11.6921 9.30794 11.2355 9.76448L10 11L9.57039 10.8568C7.48016 10.1601 5.83995 8.51984 5.1432 6.42961L5 6L6.23552 4.76448C6.69206 4.30794 6.80524 3.61048 6.5165 3.033L5.77639 1.55279Z" fill="#499777"/>
                        </svg>
                        <div class="block_text store_phone">
                            <a  href="tel:{{clearPhone(setting('store_phone')) }}" class="font-16-20-500 color-black">
                                <span>{{ substr(setting('store_phone'), 0 , strlen(setting('store_phone')) / 2) }}</span>
                                <span class="d-none">JUNK LOAD</span>
                                <span>{{ substr(setting('store_phone'), strlen(setting('store_phone')) / 2) }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="block_data flex-row-start-center">
                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1 4C1 3.44771 1.44772 3 2 3H14C14.5523 3 15 3.44772 15 4V13C15 13.5523 14.5523 14 14 14H2C1.44772 14 1 13.5523 1 13V4ZM14 5.29878L8.00007 9.5L2 5.29871V4.07793L8.00007 8.27922L14 4.07801V5.29878Z" fill="#499777"/>
                        </svg>
                        <div class="block_text">
                            <a href="mailto:user@email.com" class="font-16-20-normal color-black">
                                <span>{{ substr(setting('store_email'), 0 , strlen(setting('store_email')) / 2) }}</span>
                                <span class="d-none">JUNK LOAD</span>
                                <span>{{ substr(setting('store_email'), strlen(setting('store_email')) / 2) }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_block flex-column-start-start">
        <div class="title_block font-30-36-500 color-black">
            {{ setting('block_title') }}
        </div>
        <div class="subtitle_block font-18-24-500 color-black">
            {{ setting('block_subtitle') }}
        </div>
        <div class="description_block font-16-24-normal color-black">
            {!!  transformText(setting('block_description')) !!}
        </div>
    </div>
</div>
