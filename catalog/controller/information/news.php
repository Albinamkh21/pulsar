<?php
class ControllerInformationNews extends Controller
{
    public function index()
    {

        $this->load->language('information/information');
        $this->load->language('common/common');
        $this->load->model('catalog/information');

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Новости",
            'href' => $this->url->link('information/news')
        );
        if (isset($this->request->get['information_id'])) {
            $information_id = (int)$this->request->get['information_id'];
        } else {
            $information_id = 0;
        }
        if (isset($this->request->get['year'])) {
            $filter_year=$this->request->get['year'];
        }
        else {
            $filter_year=NULL;
        }
        if($information_id>0)
        {

            $this->ShowSingleNew($information_id, $data['breadcrumbs']);
        }
        else {


            $url='';
            $limit = 4;
            if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
            } else {
                $page = 1;
            }
            $promo_total = $this->model_catalog_information->getTotalInformations(15);
            $pagination = new Pagination();
            $pagination->total = $promo_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->url = $this->url->link('information/news', $url . '&page={page}');
            $pagination->text = "Еще новости";

            $data['pagination'] = $pagination->render3();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($promo_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($promo_total - $limit)) ? $promo_total : ((($page - 1) * $limit) + $limit), $promo_total, ceil($promo_total / $limit));

            // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
            if ($page == 1) {
                $this->document->addLink($this->url->link('information/news', '', true), 'canonical');
            } elseif ($page == 2) {
                $this->document->addLink($this->url->link('information/news', '', true), 'prev');
            } else {
                $this->document->addLink($this->url->link('information/news', $url . '&page='. ($page - 1), true), 'prev');
            }

            $filter = array(
                'sort'=>'id.date_added',
                'filter_year' => $filter_year,
                'start'               => 0,
                'limit'               => $page * $limit
            );

            $news = $this->model_catalog_information->getInformations(15,$filter);
            $data['news'] = array();
            foreach ( $news as $result) {

                    $data['news'][] = array(
                        'title' => html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
                        'source' => html_entity_decode($result['source'], ENT_QUOTES, 'UTF-8'),
                        'date_added' => html_entity_decode($result['date_added'], ENT_QUOTES, 'UTF-8'),
                        'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                        'href'  => $this->url->link('information/news', 'information_id=' . $result['information_id'])
                    );

            }
            $this->document->setTitle($this->language->get('text_news_title'));
            $this->document->setDescription($this->language->get('text_news_title'));
            $this->document->setKeywords($this->language->get('text_news_title'));
            $data['heading_title'] = $this->language->get('text_news_title');

            $data['column_right'] = $this->load->controller('common/column_right');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');

            //добавление баннеров
            $this->load->model('design/banner');
            $this->load->model('tool/image');

            $data['banners'] = array();


            $results = $this->model_design_banner->getBanners( array('banner_id'=>9));
            $setting = array(
                'width' => 255,
                'height' => 400
            );

            foreach ($results as $result) {
                if (is_file(DIR_IMAGE . $result['image'])) {
                    $data['banners'][] = array(
                        'title' => $result['title'],
                        'link'  => $result['link'],
                        'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                    );
                }
            }


            //filter by year
            $results = $this->model_catalog_information->getInformationYears();
            foreach ($results as $result) {
                $data['filter_year'][] =
                    array(
                        'year' => $result['year'],
                        'link' => $this->url->link('information/news', 'year=' . $result['year']),

                    );
            }

            $data['news_link'] = $this->url->link('information/news');

            $this->response->setOutput($this->load->view('information/news', $data));
        }
    }
    private function ShowNews()
    {

    }
    private function ShowSingleNew($information_id,$breadcrumbs)
    {
        $new_info = $this->model_catalog_information->getInformation($information_id,15);

        $breadcrumbs[] = array(
            'text' => $new_info['title'],
            'href' => $this->url->link('information/news', 'information_id=' . $information_id)
        );

        if ($new_info['meta_title']) {
            $this->document->setTitle($new_info['meta_title']);
        } else {
            $this->document->setTitle($new_info['title']);
        }
        $this->document->setDescription($new_info['meta_description']);
        $this->document->setKeywords($new_info['meta_keyword']);
        if ($new_info['meta_h1']) {
            $data['heading_title'] = $new_info['meta_h1'];
        } else {
            $data['heading_title'] = $new_info['title'];
        }
        $data['description'] = html_entity_decode($new_info['description'], ENT_QUOTES, 'UTF-8');
        $data['source'] = $new_info['source'];
        $data['date_added'] = $new_info['date_added'];

        //easy pagination
        $minmax = $this->model_catalog_information->getInformationMinMaxId();
        $prev= $information_id-1; $next = $information_id+1;
        if($minmax['minId']<=$prev)
            $data['prev']  = $this->url->link('information/news', 'information_id=' . $prev);
        else
            $data['prev'] = '';
        if($minmax['maxId']>=$next)
            $data['next']  = $this->url->link('information/news', 'information_id=' . $next);
        else
            $data['next'] = '';



        /*$data['button_continue'] = $this->language->get('button_continue');
        $data['continue'] = $this->url->link('common/home');
        */
        //добавление баннеров
        $this->load->model('design/banner');
        $this->load->model('tool/image');

        $data['banners'] = array();


        $results = $this->model_design_banner->getBanners( array('banner_id'=>9));
        $setting = array(
            'width' => 255,
            'height' => 400
        );

        foreach ($results as $result) {
            if (is_file(DIR_IMAGE . $result['image'])) {
                $data['banners'][] = array(
                    'title' => $result['title'],
                    'link'  => $result['link'],
                    'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
                );
            }
        }
        $data['breadcrumbs'] =  $breadcrumbs;
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        //filter by year
        $results = $this->model_catalog_information->getInformationYears();
        foreach ($results as $result) {
            $data['filter_year'][] =
                array(
                    'year' => $result['year'],
                    'link' => $this->url->link('information/news', 'year=' . $result['year']),

                );
        }
        $this->response->setOutput($this->load->view('information/new', $data));
    }

    public function listForMain()
    {
        $this->load->language('information/information');
        $this->load->language('common/common');
        $this->load->model('catalog/information');





            $news = $this->model_catalog_information->getInformations(15);
            $data['news'] = array();
            foreach ( $news as $result) {

                $data['news'][] = array(
                    'title' => html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
                    'source' => html_entity_decode($result['source'], ENT_QUOTES, 'UTF-8'),
                    'date_added' => html_entity_decode($result['date_added'], ENT_QUOTES, 'UTF-8'),
                    'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                    'href' => $this->url->link('information/news', 'information_id=' . $result['information_id'])
                );

            }
            $this->document->setTitle($this->language->get('text_news_title'));
            $this->document->setDescription($this->language->get('text_news_title'));
            $this->document->setKeywords($this->language->get('text_news_title'));
            $data['heading_title'] = $this->language->get('text_news_title');

            $data['column_right'] = $this->load->controller('common/column_right');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');



            //filter by year
            $results = $this->model_catalog_information->getInformationYears();
            foreach ($results as $result) {
                $data['filter_year'][] =
                    array(
                        'year' => $result['year'],
                        'link' => $this->url->link('information/news', 'year=' . $result['year']),

                    );
            }

            $data['news_link'] = $this->url->link('information/news');

            $this->response->setOutput($this->load->view('common/news_list', $data));

    }


}
