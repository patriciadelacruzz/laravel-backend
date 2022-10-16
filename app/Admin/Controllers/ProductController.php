<?php

namespace App\Admin\Controllers;

use App\Models\ProductCategory;
use App\Models\Products;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Products';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Products());
        $grid->column('product_name', __('Product Name'));
        $grid->column('product.title', 'Category');
        $grid->column('thumbnail', __('Image'))->image('', '60', '60');
        $grid->column('price', __('Price'));
        $grid->column('description', __('Description'));
        $grid->column('released', 'Released')->bool();
        $grid->filter(function($filter){
            $filter->disableIdFilter();
            $filter->like('title');
            $filter->like('product.title', __('Category'));
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Products::findOrFail($id));
        $show->field('product_id', __('Product Id'));
        $show->field('product_name', __('Product Name'));
        $show->field('thumbnail', __('Image'));
        $show->field('price', __('Price'));
        $show->field('description', __('Description'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Products());
        $form->select('type_id', __('Category'))->options((new ProductCategory())::selectOptions());
        $form->text('product_name', __('Product Name'))->required();
        $form->image('thumbnail', __('Image'))->required();
        $form->decimal('price', __('Price'))->required();
        $form->text('description', __('Description'));
        $states = [
            'on'=>['value'=>1, 'text'=>'publish'],
            'off'=>['value'=>0, 'text'=>'draft']
        ];
        $form->switch('released')->states($states);

        return $form;
    }
}

