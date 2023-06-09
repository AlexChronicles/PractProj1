<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait BanOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupBanRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/ban', [
            'as'        => $routeName.'.ban',
            'uses'      => $controller.'@ban',
            'operation' => 'ban',
        ]);
        Route::put($segment.'/{id}/ban', [
            'as'        => $routeName.'.ban',
            'uses'      => $controller.'@ban',
            'operation' => 'ban',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupBanDefaults()
    {
        CRUD::allowAccess('ban');

        CRUD::operation('ban', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation(['list','show'], function () {
            // CRUD::addButton('top', 'ban', 'view', 'crud::buttons.ban');
             CRUD::addButton('line', 'ban', 'ban', 'beginning');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function ban()
    {
        CRUD::hasAccessOrFail('ban');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Ban '.$this->crud->entity_name;

        //CRUD::addField(['name' => 'banned', 'type' => 'boolean']));
        /*$this->crud->addColumn([
            'name'            => 'ban_status',
            'type'            => 'boolean',
            'allows_null'     => true,
            'allows_multiple' => true,
            'default'         => 'true',->beforeField('id')*/

        /*$this->crud->addField([
            'name' => 'ban_status',
            'label' => 'Заблокирован',
            'type' => 'checkbox',
        ]);*/

        // load the view
        return view('crud::operations.ban', $this->data);
    }
}