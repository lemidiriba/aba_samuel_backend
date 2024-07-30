<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GalleryPostRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GalleryPostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GalleryPostCrudController extends CrudController
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
        CRUD::setModel(\App\Models\GalleryPost::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gallery-post');
        CRUD::setEntityNameStrings('gallery post', 'gallery posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image',
            'height' => '100px', // Set the height for the image
            'width' => '100px', // Set the width for the image
            'prefix' => 'storage/', // Path prefix if you're using a different storage disk
        ]);
        $this->crud->addColumn([
            'name' => 'createdBy.name', // Assuming a one-to-one relationship
            'label' => 'Created By',
            'type' => 'text', // Adjust the type as needed
        ]);
        $this->crud->addColumn([
            'name'  => 'image_posted',
            'type'  => 'radio',
            'label'    => 'Image Status',

            'options'     => [
                0 => "Posted",
                1 => "Hidden",
            ],

        ]);
        CRUD::removeButtonFromStack('show', 'line');


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
        CRUD::setValidation(GalleryPostRequest::class);

        $this->crud->addField([
            'name' => 'image',
            'type' => 'image',
            'label' => 'Image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            'disk' => 'public'
        ]);
        $this->crud->addField([
            'name'  => 'image_posted',
            'type'  => 'radio',
            'label'    => 'Image Status',
            'options'     => [
                0 => "Posted",
                1 => "Hidden",
            ],

        ]);
        $this->crud->addField(['name' => 'created_by_id', 'default' => backpack_user()->id, 'type' => 'hidden']);


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
        $this->setupCreateOperation();
    }
}
