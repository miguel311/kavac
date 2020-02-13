<script>
    $(document).ready(function() {
        @if (session('message'))
            {{-- Mensajes de la aplicación --}}
            var msg_title = '', msg_text = '', msg_class = '', msg_icon = '';
            msg_title = '{{ __('Éxito') }}';
            msg_icon = 'screen-ok';
            msg_class = 'growl-success';
            @if (session('message')['type'] == 'store')
                msg_text = '{{ __('Registro almacenado con éxito') }}';
            @elseif (session('message')['type'] == 'update')
                msg_text = '{{ __('Registro actualizado con éxito') }}';
            @elseif (session('message')['type'] == 'destroy')
                msg_text = '{{ __('Registro eliminado con éxito') }}';
            @elseif (session('message')['type'] == 'restore')
                msg_text = '{{ __('Registro restaurado con éxito') }}';
            @elseif (session('message')['type'] == 'deny')
                msg_title = '{{ __('Acceso Denegado') }}';
                msg_icon = 'screen-error';
                msg_class = 'growl-danger';
                msg_text = '{{ __('Usted no tiene acceso a la petición solicitada') }}';
                @if (session('message')['msg'])
                    msg_text = '{!! session('message')['msg'] !!}';
                @endif
            @elseif (session('message')['type'] == 'other')
                msg_icon = 'screen-info';
                @if (isset(session('message')['title']))
                    msg_title = '{!! session('message')['title'] !!}';
                @endif
                @if (isset(session('message')['icon']))
                    msg_icon = '{!! session('message')['icon'] !!}';
                @endif
                @if (isset(session('message')['class']))
                    msg_class = '{!! session('message')['class'] !!}';
                @endif
                msg_text = "{{ session('message')['text'] }}";
            @endif
            $.gritter.add({
                title: msg_title,
                text: msg_text,
                class_name: msg_class,
                image: "{{ asset('images') }}/" + msg_icon + ".png",
                sticky: false,
                time: 1500
            });
        @endif

        @if (session('verified'))
            $.gritter.add({
                title: '{{ __('Éxito!') }}',
                text: "{{ __('La verificación de la cuenta se realizó satisfactoriamente') }}",
                class_name: 'growl-success',
                image: "{{ asset('images/screen-ok.png') }}",
                sticky: false,
                time: 2500
            });
        @endif

        @role('admin')
            @if (App\Models\Institution::all()->isEmpty())
                $.gritter.add({
                    title: '{{ __('Alerta!') }}',
                    text: "{{ __('Para comenzar a utilizar la aplicación debe configurar una Institución') }}",
                    class_name: 'growl-danger',
                    image: "{{ asset('images/screen-error.png') }}",
                    sticky: false,
                    time: 2500
                });
            @endif
        @endrole
    });
</script>
