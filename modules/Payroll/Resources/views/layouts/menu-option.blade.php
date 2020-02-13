{{-- Gestión de nómina --}}
<li>
    <a href="#" title="Datos de personal y nómina" data-toggle="tooltip" data-placement="right">
        <i class="ion-ios-folder-outline"></i><span>Talento Humano</span>
    </a>
    <ul class="submenu" style="{!! display_submenu('payroll') !!}">
        <li class="{!! set_active_menu(['payroll.settings.index']) !!}">
            <a href="{{ route('payroll.settings.index') }}" data-toggle="tooltip" data-placement="right"
                title="Configuración de nómina">Configuración</a>
        </li>
        <li>
            <a href="#" data-toggle="tooltip" data-placement="right"
                title="Expediente del personal">Expediente</a>
            <ul class="submenu" style="{!! display_submenu([
                    'staffs', 'socioeconomic-informations', 'professional-informations',
                    'employment-informations'
                ]) !!}">
                <li class="{!! set_active_menu(['payroll.staffs.index', 'payroll.staffs.create', 'payroll.staffs.edit']) !!}">
                    <a href="{{ route('payroll.staffs.index') }}">Datos Personales</a>
                </li>
                <li class="{!! set_active_menu(['payroll.professional-informations.index']) !!}">
                    <a href="{{ route('payroll.professional-informations.index') }}">Datos Profesionales</a>
                </li>
                <li class="{!! set_active_menu(['payroll.socioeconomic-informations.index']) !!}">
                    <a href="{{ route('payroll.socioeconomic-informations.index') }}">Datos Socioeconómicos</a>
                </li>
                <li class="{!! set_active_menu(['payroll.employment-informations.index']) !!}">
                    <a href="{{ route('payroll.employment-informations.index') }}">Datos Laborales</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Registros de Nómina</a>
        </li>
        <li>
            <a href="#">Reportes</a>
            <ul class="submenu">
                <li><a href="#">Reporte 1</a></li>
                <li><a href="#">Reporte 2</a></li>
            </ul>
        </li>
    </ul>
</li>
