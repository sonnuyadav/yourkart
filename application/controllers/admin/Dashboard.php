<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        /* Load :: Common */
        $this->load->helper('number');
       
        $this->load->model('admin/orders_model');
        $this->load->model('admin/product_model');
    }
	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Title Page */
            $this->page_title->push(lang('menu_dashboard'));
            $this->data['pagetitle'] = $this->page_title->show();
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
            $this->data['todayorder'] = $this->orders_model->getTodayOrderCount();
            $this->data['todaysale'] = $this->orders_model->getTodaySale();

            $this->data['totalorder'] = $this->orders_model->getTotalOrderCount();
            $this->data['recentorder'] = $this->orders_model->getRecentOrders();
            $this->data['activeproducts'] = $this->product_model->getActiveProductCount();
            $this->data['populerproducts'] = $this->product_model->getPopulerProducts();
            $this->data['outofstock'] = $this->product_model->getOutOfStockProduct();
            $this->template->admin_render('admin/dashboard/index', $this->data);
        }
	}
}
