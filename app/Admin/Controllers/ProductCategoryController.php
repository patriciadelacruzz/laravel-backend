<?php

namespace App\Admin\Controllers;

use App\Models\ProductCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;

class ProductCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ProductCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    /*protected function grid()
    {
        $grid = new Grid(new ProductCategory());
        $grid->column('title', __('Title'));
        $grid->column('id', __('ID'));


        return $grid;
    }*/

    public function index(Content $content)
    {
        $tree = new Tree(new ProductCategory);
        return $content->header('Product Category')->body($tree);
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProductCategory::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductCategory());
        $form->select('parent_id')->options((new ProductCategory())::selectOptions());
        $form->text('title')->required( );
        $form->number('order')->default(0);

        return $form;
    }
}
