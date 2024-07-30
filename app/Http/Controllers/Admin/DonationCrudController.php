<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DonationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DonationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DonationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;



    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Donation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/donation');
        CRUD::setEntityNameStrings('donation', 'donations');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('full_name');
        CRUD::column('christian_name');
        CRUD::column('amount');
        $this->crud->addColumn([
            'name'  => 'completed',
            'type'  => 'radio',
            'label'    => 'Completed Status',
            'options'     => [
                0 => "No",
                1 => "Yes",
            ],
        ]);

        $this->crud->addColumn([
            'name' => 'approvedBy.name', // Assuming a one-to-one relationship
            'label' => 'Approved By',
            'type' => 'text', // Adjust the type as needed
        ]);

        $this->crud->removeButtonFromStack('show','line');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DonationRequest::class);

        CRUD::field('full_name');
        CRUD::field('christian_name');
        $this->crud->addField(['name'=>'amount', 'type'=> 'number', 'label' => 'Amount (Birr)']);
        $this->crud->addField([
            'name'  => 'completed',
            'type'  => 'radio',
            'label'    => 'Completed Status',

            'options'     => [
                0 => "No",
                1 => "Yes",
            ],

        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(DonationRequest::class);

        CRUD::field('full_name');
        CRUD::field('christian_name');
        $this->crud->addField(['name' => 'amount', 'type' => 'number', 'label' => 'Amount (Birr)']);
        $this->crud->addField([
            'name'  => 'completed',
            'type'  => 'radio',
            'label'    => 'Completed Status',

            'options'     => [
                0 => "No",
                1 => "Yes",
            ],

        ]);
        $this->crud->addField(['name' => 'approved_by_id', 'default' => backpack_user()->id, 'type' => 'hidden']);

    }
}
