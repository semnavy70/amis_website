<ul class="navbar-nav mx-auto text-white">
    <li class="nav-item mega dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.parcels_mail')
        </a>
        <div class="mega dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="row">
                <div class="col-lg-4">
                    <a class="dropdown-item top-dropdown-item" href="#">@lang('translator.express_mail_service')</a>
                    <a class="dropdown-item" href="#">@lang('translator.ems_express_mail_service')</a>
                    <a class="dropdown-item" href="#">@lang('translator.international_ems')</a>
                    <a class="dropdown-item" href="#">@lang('translator.ems_partner_con')</a>
                    <a class="dropdown-item" href="#">@lang('translator.ems_packing_re')</a>
                </div>
                <div class="col-lg-4">
                    <a class="dropdown-item top-dropdown-item" href="#">@lang('translator.parcel')</a>
                    <a class="dropdown-item" href="#">@lang('translator.parcel_service')</a>
                    <a class="dropdown-item" href="#">@lang('translator.country_list')</a>
                    <a class="dropdown-item" href="#">@lang('translator.packing')</a>
                </div>
                <div class="col-lg-4">
                        <a class="dropdown-item top-dropdown-item" href="#">@lang('translator.lc_ao')</a>
                        <a class="dropdown-item" href="#">@lang('translator.lc_ao_service')</a>
                        <a class="dropdown-item" href="#">@lang('translator.country_list_lc')</a>
                        <a class="dropdown-item" href="#">@lang('translator.packing_lc')</a>
                        <a class="dropdown-item" href="#">@lang('translator.postal')</a>
                </div>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.express_money_order')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.money_order_service')</a>
            <a class="dropdown-item" href="#">@lang('translator.cambodia_post_and_wing')</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">@lang('translator.mobile_payment')</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.products')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.postal_stamp')</a>
            <a class="dropdown-item" href="#">@lang('translator.philately')</a>
            <a class="dropdown-item" href="#">@lang('translator.stamp_collection')</a>
            <a class="dropdown-item" href="#">@lang('translator.packaging_box_price_list')</a>
            <a class="dropdown-item" href="#">@lang('translator.postcard')</a>
            <a class="dropdown-item" href="#">@lang('translator.air_mail')</a>
            <a class="dropdown-item" href="#">@lang('translator.location_of_postal')</a>
            <a class="dropdown-item" href="#">@lang('translator.special_mail_service')</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.vip_passenger_transportation')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.booking_ticket_online')</a>
            <a class="dropdown-item" href="#">@lang('translator.departture_time')</a>
            <a class="dropdown-item" href="#">@lang('translator.agency')</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.contact_us')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.customer_service')</a>
            <a class="dropdown-item" href="#">@lang('translator.postal_code')</a>
            <a class="dropdown-item" href="#">@lang('translator.accep_interna_mail')</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.about_us')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.cambodia_post_address')</a>  
            <a class="dropdown-item" href="#">@lang('translator.board_of_director')</a>
            <a class="dropdown-item" href="#">@lang('translator.director_general_welcome')</a>
            <a class="dropdown-item" href="#">@lang('translator.events_gallery')</a>
            <a class="dropdown-item" href="#">@lang('translator.history_of_post')</a>
            <a class="dropdown-item" href="#">@lang('translator.postal_structure')</a>
            <a class="dropdown-item" href="#">@lang('translator.cambodia_post_branch')</a>
            <a class="dropdown-item" href="#">@lang('translator.public_holiday')</a>
        </div>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            @lang('translator.help_support')
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">@lang('translator.faqs')</a> 
            @if(app()->getLocale() == 'kh')
                <a class="dropdown-item" href="#">ការបើកបញ្ញើប្រៃសណីយ៍</a>
            @endif 
            <a class="dropdown-item" href="#">@lang('translator.custom_and_other_taxes')</a>
            <a class="dropdown-item" href="#">@lang('translator.prohibited_items')</a>
            <a class="dropdown-item" href="#">@lang('translator.feedback')</a>
            <a class="dropdown-item" href="#">@lang('translator.inquiry_form')</a>
            @if(app()->getLocale() == 'kh')
                <a class="dropdown-item" href="#">អំពីសំណង</a>
            @endif
            <a class="dropdown-item" href="#">@lang('translator.glossary')</a>
        </div>
    </li>
</ul>