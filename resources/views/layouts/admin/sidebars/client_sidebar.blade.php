<div class="pl-0 px-3">
    <hr>
    <div class="main-profile-overview">
        <div class="d-flex justify-content-between mg-b-20">
            <div>
                <h5 class="main-profile-name">{{ auth()->user()->name }}</h5>
                <p class="main-profile-name-text">{{ trans('site.nationality') }}: {{ auth()->user()->nationality }}</p>
            </div>
        </div>
        <p class="case-info">{{ trans('site.phone_attr', ['attr' => '']) }}: <a href="{{ whatsappLink(auth()->user()->mobile, 'مرحبا: '.auth()->user()->name) }}">{{ auth()->user()->mobile }}</a></p>
        <p class="case-info">{{ trans('site.email') }}: {{ auth()->user()->email }}</p>
        <p class="case-info">{{ trans('site.id_number') }}: {{ auth()->user()->id_number }}</p>
        <p class="case-info">{{ trans('site.address') }}: {{ auth()->user()->address }}</p>
    </div><!-- main-profile-overview -->
</div>