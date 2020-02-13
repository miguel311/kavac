{{-- Comercialización --}}
<li>
    <a href="#" title="Gestión de Comercialización" data-toggle="tooltip" 
       data-placement="right">
        <i class="ion-social-bitcoin"></i><span>Comercialización</span>
    </a>
    <ul class="submenu" style="{!! display_submenu('commercialization') !!}">

         <li class="{!! set_active_menu('commercialization.settings.index') !!}">
            <a href="{{ route('commercialization.settings.index') }}" data-toggle="tooltip" data-placement="right" 
               title="Configuración de Comercialización">Configuración</a>
        </li>

        <li title="Gestión de Facturación" data-toggle="tooltip"
            data-placement="right"
            class='{!! set_active_menu(['asset.register.index', 'asset.register.create', 'asset.register.edit']) !!}'>
            <a href="{{ route('asset.register.index') }}">Facturación</a>
        </li>
        <li title="Configuración de Moneda y tasa cambiaria" data-toggle="tooltip"
            data-placement="right"
            class='{!! set_active_menu(['asset.register.index', 'asset.register.create', 'asset.register.edit']) !!}'>
            <a href="{{ route('asset.register.index') }}">Moneda</a>
        </li>
        {{--  
        <li title="Gestión de asignaciones de bienes institucionales" data-toggle="tooltip"
            data-placement="right"
            class='{!! set_active_menu(['asset.asignation.index','asset.asignation.create','asset.asignation.edit']) !!}'>
            <a href="{{ route('asset.asignation.index') }}">Asignaciones</a>
        </li>
        
        <li title="Gestión de Desincorporaciones de bienes institucionales" data-toggle="tooltip"
            data-placement="right"
            class='{!! set_active_menu(['asset.desincorporation.index','asset.desincorporation.create','asset.desincorporation.edit']) !!}'>
            <a href="{{ route('asset.disincorporation.index') }}">Desincorporaciones</a>
        </li>
        
        <li title="Gestión de solicitudes de bienes institucionales" data-toggle="tooltip"
            data-placement="right"
            class='{!! set_active_menu(['asset.request.index','asset.request.create','asset.request.edit']) !!}'>
            <a href="{{ route('asset.request.index') }}">Solicitudes</a>
        </li>
        <li data-toggle="tooltip" data-placement="right"
            class='{!! set_active_menu(['asset.inventory-history.index']) !!}'
            title="Gestiona el almacenamiento y visualización del estado del inventario a lo largo del tiempo">
            <a href="{{ route('asset.inventory-history.index') }}">Historial de Inventario</a>
        </li>
        <li data-toggle="tooltip" data-placement="right"
            class='{!! set_active_menu(['asset.report.index']) !!}'
            title="Gestiona la generación de reportes de bienes institucionales (general, por clasificación, etc.)">
            <a href="{{ route('asset.report.index') }}">Reportes de bienes</a>
        </li>
        --}}
    </ul>
</li>