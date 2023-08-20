<ul class="side-menu">
    <li class="slide">
        <a class="side-menu__item" href="{{ route('admin.home') }}"><span class="side-menu__icon"><i class="fas fa-home"></i></span><span class="side-menu__label">{{ trans('site.home') }}</span></a>
    </li>
        
    <li class="slide">
        <a class="side-menu__item" href="{{ route('admin.calendar') }}"><span class="side-menu__icon"><i class="fas fa-calculator"></i></span><span class="side-menu__label">{{ trans('site.calendar') }}</span></a>
    </li>
    
    @can('users_list')
        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.users.index') }}"><span class="side-menu__icon"><i class="fas fa-users"></i></span><span class="side-menu__label">{{ trans_choice('site.users', 1) }}</span></a>
        </li>
    @endcan
    
    @can('roles_list')
        <li class="slide">
            <a class="side-menu__item" href="{{ route('admin.roles.index') }}"><span class="side-menu__icon"><i class="fas fa-user-shield"></i></span><span class="side-menu__label">{{ trans_choice('site.roles', 1) }}</span></a>
        </li>
    @endcan

    @canany(['clientType_list', 'client_list'])
        <li class="side-item side-item-category side-item-category2"><hr></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><span class="side-menu__icon"><i class="fas fa-user-tie"></i></span><span class="side-menu__label">{{ trans_choice('site.clients', 1) }}</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @can('clientType_list')
                    <li><a class="slide-item" href="{{ route('admin.clients-types.index') }}">{{ trans_choice('site.categories', 1) }}</a></li>
                @endcan
                @can('client_list')
                    <li><a class="slide-item" href="{{ route('admin.clients.index') }}">{{ trans('site.all_attr', ['attr' => trans_choice('site.clients', 1)]) }}</a></li>
                @endcan
            </ul>
        </li>
    @endcanany

    @canany(['lawsuite_create', 'lawsuite_list', 'lawsuitePaper_list', 'caseType_list', 'lawsuitCase_list', 'court_list', 'caseStage_list', 'receipt_list', 'caseSession_show', 'document_list'])
        <li class="side-item side-item-category side-item-category2"><hr></li>
        @canany(['lawsuite_create', 'lawsuite_list', 'lawsuitePaper_list', 'caseType_list', 'lawsuitCase_list', 'court_list', 'caseStage_list'])
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fas fa-gavel"></i></span><span class="side-menu__label">{{ trans_choice('site.lawsuites', 1) }}</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    @can('lawsuite_create')
                        <li><a class="slide-item" href="{{ route('admin.lawsuites.create') }}">{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.lawsuites', 0), 2)]) }}</a></li>
                    @endcan
                    @can('lawsuite_list')
                        <li><a class="slide-item" href="{{ route('admin.lawsuites.index') }}">{{ trans('site.all_attr', ['attr' =>trans_choice('site.lawsuites', 1) ]) }}</a></li>
                    @endcan
                    @can('lawsuitePaper_list')
                        <li><a class="slide-item" href="{{ route('admin.lawsuites-papers.index') }}">{{ trans('site.all_attr', ['attr' => removebeginninLetters(trans_choice('site.newspapers', 1), 2).' '.trans_choice('site.cases',0) ]) }}</a></li>
                    @endcan
                    @can('caseType_list')
                        <li><a class="slide-item" href="{{ route('admin.case-types.index') }}">{{ trans_choice('site.categories', 1) }}</a></li>
                    @endcan
                    @can('lawsuitCase_list')
                        <li><a class="slide-item" href="{{ route('admin.lawsuit-cases.index') }}">{{ trans_choice('site.status', 1) .' '. trans_choice('site.lawsuites', 1) }}</a></li>
                    @endcan
                    @can('court_list')
                        <li><a class="slide-item" href="{{ route('admin.courts.index') }}">{{ trans_choice('site.courts', 1) }}</a></li>
                    @endcan
                    @can('caseStage_list')
                        <li><a class="slide-item" href="{{ route('admin.case-stages.index') }}">{{ removebeginninLetters(trans_choice('site.stages', 1), 2) .' '. trans('site.litigation') }}</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @if ($getlawsuitCases->count() > 0)
            @can('lawsuite_list')
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fas fa-battery-full"></i></span><span class="side-menu__label">{{ trans('site.cases_by_status') }}</span><i class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @foreach ($getlawsuitCases as $lawsuitCase)
                            <li><a class="slide-item" href="{{ route('admin.lawsuites.status', $lawsuitCase->id) }}">{{ $lawsuitCase->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endcan
        @endif

        @can('receipt_list')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.receipts.index', ['type' => 'lawsuites']) }}"><span class="side-menu__icon"><i class="fas fa-receipt"></i></span><span class="side-menu__label">{{ removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1)  }}</span></a>
            </li>
        @endcan

        @can('caseSession_show')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.case-sessions.index') }}"><span class="side-menu__icon"><i class="fas fa-calendar-alt"></i></span><span class="side-menu__label">{{ trans('site.all_attr', ['attr' => trans_choice('site.sessions', 1)]) }}</span></a>
            </li>
        @endcan

        @can('document_list')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.documents.index') }}"><span class="side-menu__icon"><i class="fas fa-folder-open"></i></span><span class="side-menu__label">{{ trans('site.all_attr', ['attr' => trans_choice('site.documents', 1)]) }}</span></a>
            </li>
        @endcan
    @endcanany


    @canany(['consultation_create', 'consultation_list', 'receipt_list'])
        <li class="side-item side-item-category side-item-category2"><hr></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><span class="side-menu__icon"><i class="fas fa-question"></i></span><span class="side-menu__label">{{ trans_choice('site.consultations', 1) }}</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @can('consultation_create')
                    <li><a class="slide-item" href="{{ route('admin.consultations.create') }}">{{ trans('site.add_new', ['attr' => removebeginninLetters(trans_choice('site.consultations', 0), 2)]) }}</a></li>
                @endcan
                @can('consultation_list')
                    <li><a class="slide-item" href="{{ route('admin.consultations.index') }}">{{ trans('site.all_attr', ['attr' =>trans_choice('site.consultations', 1) ]) }}</a></li>
                @endcan
            </ul>
        </li>
        
        @can('receipt_list')
            <li class="slide">
                <a class="side-menu__item" href="{{ route('admin.receipts.index', ['type' => 'consultations']) }}"><span class="side-menu__icon"><i class="fas fa-receipt"></i></span><span class="side-menu__label">{{ removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1)  }}</span></a>
            </li>
        @endcan
    @endcanany    
    
    @canany(['branche_list', 'expenseSection_list', 'payment_list'])
        <li class="side-item side-item-category side-item-category2"><hr></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><span class="side-menu__icon"><i class="fas fa-money-bill-wave"></i></span><span class="side-menu__label">{{ trans_choice('site.expenses', 1) }}</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @can('branche_list')
                    <li><a class="slide-item" href="{{ route('admin.branches.index') }}">{{ trans_choice('site.branches', 1) }}</a></li>
                @endcan

                @can('expenseSection_list')
                    <li><a class="slide-item" href="{{ route('admin.expense-sections.index') }}">{{ removebeginninLetters(trans_choice('site.sections', 1), 2).' '.trans_choice('site.expenses', 1) }}</a></li>
                @endcan

                @can('payment_list')
                    <li><a class="slide-item" href="{{ route('admin.payments.index') }}">{{ trans_choice('site.expenses', 1) }}</a></li>
                @endcan
            </ul>
        </li>
    @endcanany
    
    @can('reports_pages')
        <li class="side-item side-item-category side-item-category2"><hr></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><span class="side-menu__icon"><i class="fas fa-file-contract"></i></span><span class="side-menu__label">{{ trans_choice('site.reports', 1) }}</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('admin.sessions.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.sessions', 1) }}</a></li>
                <li><a class="slide-item" href="{{ route('admin.lawsuites.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.lawsuites', 1) }}</a></li>
                <li><a class="slide-item" href="{{ route('admin.clients.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.clients', 1) }}</a></li>
                <li><a class="slide-item" href="{{ route('admin.lawsuites.payments.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.lawsuites', 1) }}</a></li>
                <li><a class="slide-item" href="{{ route('admin.consultations.payments.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. removebeginninLetters(trans_choice('site.payments', 1), 2) .' '.trans_choice('site.consultations', 1) }}</a></li>
                <li><a class="slide-item" href="{{ route('admin.payments.reports') }}">{{ removebeginninLetters(trans_choice('site.reports', 1), 2) .' '. trans_choice('site.expenses', 1) }}</a></li>
            </ul>
        </li>
    @endcan

    @canany(['settings_edit', 'backups_list'])
        <li class="side-item side-item-category side-item-category2"><hr></li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#"><span class="side-menu__icon"><i class="fas fa-cogs"></i></span><span class="side-menu__label">{{ trans('site.advanced_settings') }}</span><i class="angle fe fe-chevron-down"></i></a>
            <ul class="slide-menu">
                @can('settings_edit')
                    <li><a class="slide-item" href="{{ route('admin.settings.index') }}">{{ trans('site.settings') }}</a></li>
                @endcan
                @can('backups_list')
                    <li><a class="slide-item" href="{{ route('admin.backup.index') }}">{{ trans_choice('site.backups', 1) }}</a></li>
                @endcan
            </ul>
        </li>
    @endcanany
</ul>