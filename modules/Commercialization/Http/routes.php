<?php

/**
 * Grupo de rutas para el módulo de Comercialización
 */
Route::group(
	[
		'middleware' => ['web', 'auth', 'verified'], 
		'prefix' => 'commercialization', 
		'namespace' => 'Modules\Commercialization\Http\Controllers'
	], 
	function () {
        /**
         * -----------------------------------------------------------------------
         * Ruta para el panel de control del módulo de Comercialización
         * -----------------------------------------------------------------------
         *
         * Muestra información del módulo de Comercialización
         */
    	Route::get(
    		'/', 
    		'CommercializationController@index'
    	)->name('commercialization.index');

		/**
         * -----------------------------------------------------------------------
         * Rutas para la configuración general del módulo de Comercialización
         * -----------------------------------------------------------------------
         *
         * Gestiona los datos de configuración del módulo de Comercialización
         */
        Route::group(
            ['middleware' => 'permission:budget.setting.create'],
            function () {
                Route::get('settings', 'CommercializationSettingController@index')->name('commercialization.settings.index');
                Route::post('settings', 'CommercializationSettingController@store')->name('commercialization.settings.store');
            }
        );
});


