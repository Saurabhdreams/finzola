<style>
    .social-box svg {
        width: 16px; 
        height: auto;
        fill: currentColor;
    }

    .social-box {
        box-sizing: content-box;
    }
    .footer-section .footer .social-icon .social-box{
        margin-right: 12px;
        padding: 7px;
        font-size: 19px;
        color: #161e54;
        background-color: #fff;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
        border-radius: 50px;
        width: 20px;
        height: 20px;
    }
</style>
@php
    $styleCss = 'style';
    $settingValue = getSuperAdminSettingValue();
@endphp
<section class="footer-section">
    <div class="container-md container-fluid">
        <div class="footer">
            <div class="row justify-content-between">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="footer-desc">
                        <div class="footer-logo">
                            <a href="{{ env('APP_URL') }}">
                                <img src="{{ asset($settingValue['app_logo']['value']) }}" class="img-fluid front-logo" alt="footer-logo">
                            </a>
                        </div>
                       <p class="paragraph mb-0 mt-4 text-white fs-16">
                            {{-- {!! $settingValue['footer_text']['value'] !!} --}}
                            ©{{ \Carbon\Carbon::now()->year }} {{ $settingValue['app_name']['value'] }}. All Rights Reserved. 1XL Info LLP
                        </p>
                        <p class="paragraph mb-0 text-white fs-16">A product by <a href="https://1xl.com/" target="blank">1XL.com</a></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12 mb-2 mb-md-0">
                    <div class="contact-us ">
                        <h5 class="text-primary mb-4">{{ __('messages.landing.contact_us') }}</h5>
                            <a href="mailto:{{ $settingValue['email']['value'] }}" class="text-decoration-none text-white fs-16 mb-3 d-block">
                                 <i class="fa fa-envelope me-1"></i>
								{{ $settingValue['email']['value'] }}
                            </a>
                              {{-- <a href="tel:{{ $settingValue['phone']['value'] }}" class="text-decoration-none text-white fs-16 mb-3 d-block">
                                {{ '+'.$settingValue['region_code']['value'] .' '. $settingValue['phone']['value'] }}
                            </a> --}}
                    </div>
                </div>
                @if(!(empty($settingValue['twitter_url']['value']) && empty($settingValue['facebook_url']['value']) &&
    empty($settingValue['linkedin_url']['value']) && empty($settingValue['youtube_url']['value'])))
                  <div class="col-lg-2 col-md-6 col-sm-6 col-12 text-start">
                        <div class="follow-us">
                            <h5 class="text-primary mb-4">{{ __('messages.landing.follow_us') }}</h5>
                            <div class="social-icon d-flex align-items-center">
                                {{-- <a href="{{ $settingValue['twitter_url']['value'] }}" target="_blank"
                                   class="text-decoration-none social-box d-flex align-items-center justify-content-center
                                    {{ empty($settingValue['twitter_url']['value']) ? 'd-none' : ''}}">
                                    <i class="fa-brands fa-twitter"></i>
                                </a> --}}
                                <a href="{{ $settingValue['facebook_url']['value'] }}" target="_blank"
                                   class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                               
                                <a href="https://www.medium.com/@1XLUniverse/" target="_blank"
                                     class="text-decoration-none social-box d-flex align-items-center justify-content-center ">
                                    <i class="fa-brands fa-medium"></i>
                                </a>
                                <a href="https://www.youtube.com/@1XLUniverse/" target="_blank"
                                class="text-decoration-none social-box d-flex align-items-center justify-content-center ">
                                <i class="fa-brands fa-youtube"></i>
                                </a>
                                <a href="https://www.x.com/1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center ">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                </a>

                                <a href="https://www.reddit.com/user/1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-reddit"></i>
                                </a>
								 <a href="https://www.pinterest.com/1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-pinterest"></i>
                                </a>
                            </div>
                        </div>

                        <div class="follow-us">
                            <h5 class="text-primary mb-4"></h5>
                            <div class="social-icon d-flex align-items-center">
                                {{-- <a href="{{ $settingValue['twitter_url']['value'] }}" target="_blank"
                                   class="text-decoration-none social-box d-flex align-items-center justify-content-center
                                    {{ empty($settingValue['twitter_url']['value']) ? 'd-none' : ''}}">
                                    <i class="fa-brands fa-twitter"></i>
                                </a> --}}
                               
                               
                                <a href="{{ $settingValue['linkedin_url']['value'] }}" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>
             
                                <a href="https://www.quora.com/profile/1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-quora"></i>
                                </a>
                                <a href="https://www.discord.com/profile/1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-discord"></i>
                                </a>
                                <a href="https://whatsapp.com/channel/0029VaLoJ1SLCoX4iyiW0R0c" target="_blank"
                                class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            
                                <a href="https://www.threads.net/@1XLUniverse/" target="_blank"
                                    class="text-decoration-none social-box d-flex align-items-center justify-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor">
                                    <path d="M331.5 235.7c2.2 .9 4.2 1.9 6.3 2.8c29.2 14.1 50.6 35.2 61.8 61.4c15.7 36.5 17.2 95.8-30.3 143.2c-36.2 36.2-80.3 52.5-142.6 53h-.3c-70.2-.5-124.1-24.1-160.4-70.2c-32.3-41-48.9-98.1-49.5-169.6V256v-.2C17 184.3 33.6 127.2 65.9 86.2C102.2 40.1 156.2 16.5 226.4 16h.3c70.3 .5 124.9 24 162.3 69.9c18.4 22.7 32 50 40.6 81.7l-40.4 10.8c-7.1-25.8-17.8-47.8-32.2-65.4c-29.2-35.8-73-54.2-130.5-54.6c-57 .5-100.1 18.8-128.2 54.4C72.1 146.1 58.5 194.3 58 256c.5 61.7 14.1 109.9 40.3 143.3c28 35.6 71.2 53.9 128.2 54.4c51.4-.4 85.4-12.6 113.7-40.9c32.3-32.2 31.7-71.8 21.4-95.9c-6.1-14.2-17.1-26-31.9-34.9c-3.7 26.9-11.8 48.3-24.7 64.8c-17.1 21.8-41.4 33.6-72.7 35.3c-23.6 1.3-46.3-4.4-63.9-16c-20.8-13.8-33-34.8-34.3-59.3c-2.5-48.3 35.7-83 95.2-86.4c21.1-1.2 40.9-.3 59.2 2.8c-2.4-14.8-7.3-26.6-14.6-35.2c-10-11.7-25.6-17.7-46.2-17.8H227c-16.6 0-39 4.6-53.3 26.3l-34.4-23.6c19.2-29.1 50.3-45.1 87.8-45.1h.8c62.6 .4 99.9 39.5 103.7 107.7l-.2 .2zm-156 68.8c1.3 25.1 28.4 36.8 54.6 35.3c25.6-1.4 54.6-11.4 59.5-73.2c-13.2-2.9-27.8-4.4-43.4-4.4c-4.8 0-9.6 .1-14.4 .4c-42.9 2.4-57.2 23.2-56.2 41.8l-.1 .1z"/>
                                </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
