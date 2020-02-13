import moment from 'moment';

/**
 * Opciones de configuración global para utilizar en todos los componentes vuejs de la aplicación
 *
 * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
 * @param  {object} methods Métodos generales a implementar en CRUDS
 */
Vue.mixin({
    data() {
        return {
            loading: true,
            /**
             * Opciones generales a implementar en tablas
             * @type {JSON}
             */
            table_options: {
                pagination: { edge: true },
                //filterByColumn: true,
                highlightMatches: true,
                texts: {
                    filter: "Buscar:",
                    filterBy: 'Buscar por {column}',
                    //count:'Página {page}',
                    count: ' ',
                    first: 'PRIMERO',
                    last: 'ÚLTIMO',
                    limit: 'Registros',
                    //page: 'Página:',
                    noResults: 'No existen registros',
                },
                sortIcon: {
                    is: 'fa-sort cursor-pointer',
                    base: 'fa',
                    up: 'fa-sort-up cursor-pointer',
                    down: 'fa-sort-down cursor-pointer'
                },
            },
        }
    },
    props: {
        route_list: {
            type: String,
            required: false,
            default: ''
        },
        route_create: {
            type: String,
            required: false,
            default: ''
        },
        route_edit: {
            type: String,
            required: false,
            default: ''
        },
        route_update: {
            type: String,
            required: false,
            default: ''
        },
        route_delete: {
            type: String,
            required: false,
            default: ''
        },
        route_show: {
            type: String,
            required: false,
            default: ''
        }
    },
    watch: {
        loading: function() {
            let vm = this;
            if (!vm.loading) {
                $('.preloader').fadeOut(2000);
            }
            else {
                $('.preloader').show();
            }
        }
    },
    methods: {
        /**
         * Registro de eventos del sistema
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string}  v  Vista
         * @param  {integer} l  Línea
         * @param  {object}  e  Objeto con datos del error
         * @param  {string}  f  Función. Opcional
         */
        logs: function(v, l, e, f) {
            let vm = this;
            var f = (typeof(f) !== "undefined") ? f : false;
            var err = e.toJSON();
            var p = {
                view: v,
                line: l,
                code: e.response.status,
                type: e.response.statusText,
                message: err.message,
                url: e.response.config.url,
                method: e.response.config.method,
                func: null
            };
            if (f) {
                p.func = f;
            }

            if (window.debug) {
                console.error("Se ha generado un error con la siguiente información:", p);
                console.trace();
            }
            else {
                axios.post(window.log_url, {
                    view: p.view,
                    line: p.line,
                    code: p.code,
                    type: p.type,
                    message: p.message,
                    url: p.url,
                    method: p.method,
                    func: p.func
                });
            }
        },
        /**
         * Redirecciona a una url esecífica si fue suministrada
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} url URL a redireccionar.
         */
        redirect_back: function(url) {
            location.href = url;
        },
        /**
         * Ejecuta el evento click del campo de tipo archivo al cual cargar información
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param {string} input_id Identificador del campo de tipo archivo
         */
        setFile(input_id) {
            $(`#${input_id}`).click();
        },
        /**
         * Método que permite dar formato a una fecha
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} value Fecha ser formateada
         *
         * @return {string}       Fecha con el formato establecido
         */
        format_date: function(value) {
            return moment(String(value)).format('DD/MM/YYYY');
        },
        /**
         * Método que permite dar formato con marca de tiempo a una fecha
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} value Fecha ser formateada
         *
         * @return {string}       Fecha con el formato establecido
         */
        format_timestamp: function(value) {
            return moment(String(value)).format('DD/MM/YYYY hh:mm:ss');
        },
        /**
         * Método que calcula la diferencia entre dos fechas con marca de tiempo
         *
         * @method     diff_datetimes
         *
         * @author     Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param      {string}  dateThen    Fecha a comparar para obtener la diferencia con respecto a la fecha actual
         *
         * @return     {[type]}  Objeto con información de la diferencia obtenida entre las dos fechas
         */
        diff_datetimes: function(dateThen) {
            var now = moment().format("YYYY-MM-DD HH:mm:ss");
            var ms = moment(dateThen,"YYYY-MM-DD HH:mm:ss").diff(moment(now,"YYYY-MM-DD HH:mm:ss"));
            var d = moment.duration(ms);
            return {
                years: d._data.years,
                months: d._data.months,
                days: d._data.days,
                hours: d._data.hours,
                minutes: d._data.minutes,
                seconds: d._data.seconds
            };
        },
        /**
         * Método que permite convertir elementos de medida y peso
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {float}  number Numero a convertir
         * @param  {string} from   Unidad de medida o peso desde la cual se desea realizar la conversión
         * @param  {string} to     Unidad de medida o peso a la cual se desea realizar la conversión
         *
         * @return {float}         Retorna el valor numérico despues de la conversión
         */
        measure_converter: function(number, from, to) {
            var result = false;
            let measurements = [
                'mm', 'cm', 'mt', 'km', 'in', 'ft', 'px', 'em', 'rem', 'lt', 'kg', 'tn'
            ];
            let factors = {
                mm: {cm: 0.1, mt: 0.001, ft: 0.00328084, in: 0.0393701, px: 3.779527559055},
                cm: {mm: 10, mt: 0.01, ft: 0.0328084, in: 0.393701, px: 37.79527559055},
                mt: {mm: 1000, cm: 100, km: 0.001, ft: 3.28084, in: 39.3701, px: 3779.527559055},
                km: {mt: 1000, cm: 100000, ft: 3280.84, in: 39370.1},
                in: {mt: 0.0254, cm: 2.54, mm: 25.4, ft: 0.0833333, px: 96},
                ft: {km: 0.0003048, mt: 0.3048, cm: 30.48, mm: 304.8, in: 12},
                px: {mm: 0.264583333, cm: 0.02645833333333, mt: 0.0002645833333333, em: 0.7528125},
                em: {px: 1.421348031496}
            };

            if (measurements.includes(from) && measurements.includes(to) && from !== to) {
                number = parseFloat(number * factors[from][to]);
                result = true;
            }
            return {result: result, number: number};
        },
        /**
         * Inicializa todos los campos de formularios a un valor vacío
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        clearForm() {
            let vm = this;
            if (typeof(vm.record) !== "undefined") {
                for (var index in vm.record) {
                    vm.record[index] = '';
                }
            }
        },
        /**
         * Inicializa los registros base del formulario
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param {string} url      Ruta que obtiene los datos a ser mostrado en listados
         * @param {string} modal_id Identificador del modal a mostrar con la información solicitada
         */
        initRecords(url, modal_id) {
            this.errors = [];
            this.reset();
            const vm = this;

            axios.get(url).then(response => {
                if (typeof(response.data.records) !== "undefined") {
                    vm.records = response.data.records;
                }
                if ($("#" + modal_id).length) {
                    $("#" + modal_id).modal('show');
                }
            }).catch(error => {
                if (typeof(error.response) !== "undefined") {
                    if (error.response.status == 403) {
                        vm.showMessage(
                            'custom', 'Acceso Denegado', 'danger', 'screen-error', error.response.data.message
                        );
                    }
                    else {
                        vm.logs('resources/js/all.js', 343, error, 'initRecords');
                    }
                }
            });
        },
        /**
         * Método que obtiene los registros a mostrar
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} url Ruta que obtiene todos los registros solicitados
         */
        readRecords(url) {
            const vm = this;
            vm.loading = true;
            axios.get('/' + url).then(response => {
                if (typeof(response.data.records) !== "undefined") {
                    vm.records = response.data.records;
                }
                vm.loading = false;
            }).catch(error => {
                vm.logs('mixins.js', 285, error, 'readRecords');
            });
        },
        /**
         * Método que permite mostrar una ventana emergente con la información registrada
         * y la nueva a registrar
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param {string} modal_id Identificador de la ventana modal
         * @param {string} url      Ruta para acceder a los datos solicitados
         * @param {object} event    Objeto que gestiona los eventos
         */
        addRecord(modal_id, url, event) {
            event.preventDefault();
            this.initRecords(url, modal_id);
        },
        /**
         * Método que permite crear o actualizar un registro
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} url    Ruta de la acción a ejecutar para la creación o actualización de datos
         * @param  {string} list   Condición para establecer si se cargan datos en un listado de tabla.
         *                         El valor por defecto es verdadero.
         * @param  {string} reset  Condición que evalúa si se inicializan datos del formulario.
         *                         El valor por defecto es verdadero.
         */
        createRecord(url, list = true, reset = true) {
            const vm = this;
            if (this.record.id) {
                this.updateRecord(url);
            }
            else {
                vm.loading = true;
                var fields = {};
                for (var index in this.record) {
                    fields[index] = this.record[index];
                }
                axios.post('/' + url, fields).then(response => {
                    if (typeof(response.data.redirect) !== "undefined") {
                        location.href = response.data.redirect;
                    }
                    else {
                        vm.errors = [];
                        if (reset) {
                            vm.reset();
                        }
                        if (list) {
                            vm.readRecords(url);
                        }
                        vm.loading = false;
                        vm.showMessage('store');
                    }

                }).catch(error => {
                    vm.errors = [];

                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.errors.push(error.response.data.errors[index][0]);
                            }
                        }
                    }

                    vm.loading = false;
                });
            }

        },
        /**
         * Redirecciona al formulario de actualización de datos
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador del registro a actualizar
         */
        editForm(id) {
            location.href = (this.route_edit.indexOf("{id}") >= 0)
                            ? this.route_edit.replace("{id}", id)
                            : this.route_edit + '/' + id;
        },
        /**
         * Método que carga el formulario con los datos a modificar
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} index Identificador del registro a ser modificado
         * @param {object} event   Objeto que gestiona los eventos
         */
        initUpdate(index, event) {
            let vm = this;
            vm.errors = [];
            vm.record = vm.records[index - 1];

            /**
             * Recorre todos los campos para determinar si existe un elemento booleano para, posteriormente,
             * seleccionarlo en el formulario en el caso de que se encuentre activado en BD
             */
            $.each(vm.record, function(el, value) {
                if ($("input[name=" + el + "]").hasClass('bootstrap-switch')) {
                    /** verifica los elementos bootstrap-switch para seleccionar el que corresponda según los registros del sistema */
                    $("input[name=" + el + "]").each(function() {
                        if ($(this).val() === value) {
                            $(this).bootstrapSwitch('state', value, true)
                        }

                    });
                }
                if (value === true || value === false) {
                    $("input[name=" + el + "].bootstrap-switch").bootstrapSwitch('state', value, true);
                }
                /*if (el.substring(el.length - 3, el.length) === "_id") {
                    $("#" + el + ".select2").val(value);
                }*/
            });

            event.preventDefault();
        },
        /**
         * Método que permite actualizar información
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} url Ruta de la acci´on que modificará los datos
         */
        updateRecord(url) {
            const vm = this;
            vm.loading = true;
            var fields = {};
            for (var index in this.record) {
                fields[index] = this.record[index];
            }
            axios.patch('/' + url + '/' + this.record.id, fields).then(response => {
                if (typeof(response.data.redirect) !== "undefined") {
                    location.href = response.data.redirect;
                }
                else {
                    vm.readRecords(url);
                    vm.reset();
                    vm.loading = false;
                    vm.showMessage('update');
                }

            }).catch(error => {
                vm.errors = [];

                if (typeof(error.response) !="undefined") {
                    for (var index in error.response.data.errors) {
                        if (error.response.data.errors[index]) {
                            vm.errors.push(error.response.data.errors[index][0]);
                        }
                    }
                }
                vm.loading = false;
            });
        },
        /**
         * Método que muestra datos de un registro seleccionado
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador del registro a mostrar
         */
        showRecord(id) {
            if (typeof(this.route_show) !== "undefined" && this.route_show) {
                if (this.route_show.indexOf("{id}") >= 0) {
                    location.href = this.route_show.replace("{id}", id);
                }
                else {
                    location.href = this.route_show + '/' + id;
                }
            }
        },
        /**
         * Método para la eliminación de registros
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} index Elemento seleccionado para su eliminación
         * @param  {string}  url   Ruta que ejecuta la acción para eliminar un registro
         */
        deleteRecord(index, url) {
            var url = (url)?url:this.route_delete;
            var records = this.records;
            var confirmated = false;
            var index = index - 1;
            const vm = this;

            bootbox.confirm({
                title: "Eliminar registro?",
                message: "Esta seguro de eliminar este registro?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancelar'
                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirmar'
                    }
                },
                callback: function (result) {
                    if (result) {
                        confirmated = true;
                        axios.delete(url + '/' + records[index].id).then(response => {
                            if (typeof(response.data.error) !== "undefined") {
                                /** Muestra un mensaje de error si sucede algún evento en la eliminación */
                                vm.showMessage('custom', 'Alerta!', 'warning', 'screen-error', response.data.message);
                                return false;
                            }
                            records.splice(index, 1);
                            vm.showMessage('destroy');
                        }).catch(error => {
                            vm.logs('mixins.js', 498, error, 'deleteRecord');
                        });
                    }
                }
            });

            if (confirmated) {
                this.records = records;
                this.showMessage('destroy');
            }
        },
        /**
         * Método que muestra un mensaje al usuario sobre el resultado de una acción
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} type        Tipo de mensaje a mostrar
         * @param  {string} msg_title   Título del mensaje (opcional)
         * @param  {string} msg_class   Clase CSS a utilizar en el mensaje (opcional)
         * @param  {string} msg_icon    Ícono a mostrar en el mensaje (opcional)
         * @param  {string} custom_text Texto personalizado para el mensaje (opcional)
         */
        showMessage(type, msg_title, msg_class, msg_icon, custom_text) {
            msg_title = (typeof(msg_title) == "undefined" || !msg_title)?'Éxito':msg_title;
            msg_class = (typeof(msg_class) == "undefined" || !msg_class)?'growl-success':'growl-'+msg_class;
            msg_icon = (typeof(msg_icon) == "undefined" || !msg_icon)?'screen-ok':msg_icon;
            custom_text = (typeof(custom_text)!=="undefined")?custom_text:'';

            var msg_text;
            if (type=='store') {
                msg_text = 'Registro almacenado con éxito';
            }
            else if (type=='update') {
                msg_text = 'Registro actualizado con éxito';
            }
            else if (type=='destroy') {
                msg_text = 'Registro eliminado con éxito';
            }
            else if (type=='custom') {
                msg_text = custom_text;
            }

            /** @type {object} Muestra el correspondiente mensaje al usuario */
            $.gritter.add({
                title: msg_title,
                text: msg_text,
                class_name: msg_class,
                image: "/images/" + msg_icon + ".png",
                sticky: false,
                time: 3500
            });
        },
        /**
         * Método que obtiene los países registrados
         *
         * @author  Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        getCountries() {
            const vm = this;
            axios.get('/get-countries').then(response => {
                vm.countries = response.data;
            });
        },
        /**
         * Obtiene los Estados del Pais seleccionado
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        getEstates() {
            const vm = this;
            vm.estates = [];
            if (this.record.country_id) {
                axios.get('/get-estates/' + this.record.country_id).then(response => {
                    vm.estates = response.data;
                });
            }
        },
        /**
         * Obtiene los Municipios del Estado seleccionado
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        getMunicipalities() {
            const vm = this;
            vm.municipalities = [];
            if (this.record.estate_id) {
                axios.get('/get-municipalities/' + this.record.estate_id).then(response => {
                    vm.municipalities = response.data;
                });
            }
        },
        /**
         * Obtiene los Municipios del Estado seleccionado
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        getCities() {
            const vm = this;
            vm.cities = [];
            if (this.record.estate_id) {
                axios.get('/get-cities/' + this.record.estate_id).then(response => {
                    vm.cities = response.data;
                });
            }
        },
        /**
         * Obtiene las parroquias del municipio seleccionado
         *
         * @author William Páez <wpaez@cenditel.gob.ve>
         */
        getParishes() {
            const vm = this;
            vm.parishes = [];
            if (this.record.municipality_id) {
                axios.get('/get-parishes/' + this.record.municipality_id).then(response => {
                    vm.parishes = response.data;
                });
            }
        },
        /**
         * Obtiene un arreglo con las instituciones registradas
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador de la institución a buscar, este parámetro es opcional
         */
        getInstitutions(id) {
            const vm = this;
            vm.institutions = [];
            var institution_id = (typeof(id)!=="undefined")?'/'+id:'';
            axios.get('/get-institutions' + institution_id).then(response => {
                vm.institutions = response.data;
            });
        },
        /**
         * Obtiene un arreglo con las monedas registradas
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador de la moneda a buscar, este parámetro es opcional
         */
        getCurrencies(id) {
            const vm = this;
            vm.currencies = [];
            var currency_id = (typeof(id)!=="undefined")?'/'+id:'';
            axios.get('/get-currencies' + currency_id).then(response => {
                vm.currencies = response.data;
            });
        },
        /**
         * Obtiene los departamentos o unidades de la institución
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador del departamento a filtrar (opcional)
         */
        getDepartments(id) {
            let vm = this;
            vm.departments = [];
            if (typeof(vm.record.institution_id) !== "undefined" && vm.record.institution_id !== '') {
                axios.get('/get-departments/' + vm.record.institution_id).then(response => {
                    /** Obtiene los departamentos */
                    vm.departments = (typeof(id) === "undefined" || !id)
                                     ? response.data
                                     : response.data.filter((department) => {
                                        return department.id === "" || department.id === id;
                                     });
                });
            }
        },
        /**
         * Obtiene un arreglo con los estados civiles
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer} id Identificador del estado civil a filtrarm este campo es opcional
         */
        getMaritalStatus(id) {
            const vm = this;
            vm.marital_status = [];
            var marital_status_id = (typeof(id)!=="undefined")?'/'+id:'';
            axios.get('/get-marital-status' + marital_status_id).then(response => {
                vm.marital_status = response.data;
            });
        },
        /**
         * Obtiene un arreglo con las profesiones
         *
         * @author William Páez <wpaez@cenditel.gob.ve>
         *
         * @param  {integer} id Identificador de la profesión a filtrar, este campo es opcional
         */
        getProfessions(id) {
            const vm = this;
            vm.professions = [];
            var profession_id = (typeof(id)!=="undefined")?'/'+id:'';
            axios.get('/get-professions' + profession_id).then(response => {
                vm.professions = response.data;
            });
        },
        /**
         * Agrega una nueva columna para el registro de número telefónicos
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         */
        addPhone: function() {
            this.record.phones.push({
                type: '',
                area_code: '',
                number: '',
                extension: ''
            });
        },
        /**
         * Elimina la fila del elemento indicado
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {integer}      index Indice del elemento a eliminar
         * @param  {object|array} el    Elemento del cual se va a eliminar un elemento
         */
        removeRow: function(index, el) {
            el.splice(index, 1);
        },
        /**
         * Gestiona el evento del elemento switch en radio y checkbox
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string} elName       Nombre del elemento switch
         * @param  {string} model        Nombre del modelo al cual asignar el valor del switch
         * @param  {string} other_model  Nombre de otro modelo al cual asignar el valor del switch
         */
        switchHandler: function(elName, model, other_model) {
            /** Si no se ha indicado el modelo se asigna como valor por defecto el del nombre del elemento */
            var model = (typeof(model) !== "undefined") ? model: elName;
            /** Si se ha especificado otro modelo al cual asignar el valor */
            var other_model = (typeof(other_model) !== "undefined") ? other_model: null;
            let vm = this;
            $('input[name=' + elName + '].bootstrap-switch').on('switchChange.bootstrapSwitch', function() {
                var value = ($(this).val().toLowerCase() === "true")
                            ? true : (($(this).val().toLowerCase() === "false") ? false : $(this).val());
                /** Asigna el valor del elemento radio o checkbox seleccionado */
                if (other_model) {
                    /** en caso de asignar el valor a otro objeto de modelo */
                    other_model = ($(this).is(':checked')) ? value : '';
                }
                else {
                    /** objeto de registros por defecto */
                    vm.record[model] = ($(this).is(':checked')) ? value : '';
                }
            });
        },
        /**
         * Agrega mensajes tooltip a elementos bootstrap switch
         *
         * @author Ing. Roldan Vargas <rvargas@cenditel.gob.ve> | <roldandvg@gmail.com>
         *
         * @param  {string}  elName    Nombre del elemento
         * @param  {string}  text      Texto a mostrar en el tooltip
         * @param  {integer} delayHide Tiempo en milisegundos para ocultar la ventana tooltip
         */
        switchTooltip: function(elName, text, delayHide) {
            var delayHide = (typeof(delayHide) !== "undefined") ? delayHide : 200;
            $('input[name=' + elName + ']').closest('.bootstrap-switch-wrapper').attr({
                'title': text,
                'data-toggle': 'tooltip'
            }).tooltip({
                trigger:"hover",
                delay: {hide: delayHide}
            });
        },
        /*loadRelationalSelect(parent_id, target_url) {
            var parent_id = (typeof(parent_id) !== "undefined")?parent_id:false;
            var target_url = (typeof(target_url) !== "undefined")?target_url:false;

            if (parent_id) {
                axios.get('/' + target_url + '/' + parent_id).then(response => {
                    this.estates = response.data;
                });
            }
        }*/
    },
    created() {
        this.clearForm();
        this.loading = false;
    },
    mounted() {
    }
});
