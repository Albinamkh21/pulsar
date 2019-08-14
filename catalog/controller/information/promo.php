<?php
class ControllerInformationPromo extends Controller
{
    public function index()
    {
        $this->load->language('information/promo');
        $this->load->language('common/common');
        $this->load->model('catalog/promo');

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        $data['breadcrumbs'][] = array(
            'text' => "Акции",
            'href' => $this->url->link('information/promo')
        );
        if (isset($this->request->get['promo_id'])) {
            $promo_id = (int)$this->request->get['promo_id'];
        } else {
            $promo_id = 0;
        }
        if($promo_id>0)
        {

            $this->ShowPromo($promo_id, $data['breadcrumbs']);
        }
        else {

            $url='';
            $limit = 4;
            if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
            } else {
                $page = 1;
            }
            $promo_total = $this->model_catalog_promo->getTotalPromos();
            $pagination = new Pagination();
            $pagination->total = $promo_total;
            $pagination->page = $page;
            $pagination->limit = $limit;
            $pagination->url = $this->url->link('information/promo', $url . '&page={page}');
            $pagination->text = "Еще акции";

            $data['pagination'] = $pagination->render3();

            $data['results'] = sprintf($this->language->get('text_pagination'), ($promo_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($promo_total - $limit)) ? $promo_total : ((($page - 1) * $limit) + $limit), $promo_total, ceil($promo_total / $limit));

            // http://googlewebmastercentral.blogspot.com/2011/09/pagination-with-relnext-and-relprev.html
            if ($page == 1) {
                $this->document->addLink($this->url->link('information/promo', '', true), 'canonical');
            } elseif ($page == 2) {
                $this->document->addLink($this->url->link('information/promo', '', true), 'prev');
            } else {
                $this->document->addLink($this->url->link('information/promo', $url . '&page='. ($page - 1), true), 'prev');
            }

            $filter_data = array(
                'start'               => 0,
                'limit'               => $page * $limit
            );
            $promos = $this->model_catalog_promo->getPromos(null, $filter_data);
            $data['promos'] = array();
            $this->load->model('tool/image');
            foreach ( $promos as $result) {

                    $data['promos'][] = array(
                        'title' => html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
                        'image' =>  $this->model_tool_image->resize($result['image'],255, 135),
                        'date_added' => html_entity_decode($result['date_added'], ENT_QUOTES, 'UTF-8'),
                        'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                        'href'  => $this->url->link('information/promo', 'promo_id=' . $result['promo_id'])
                    );

            }
            $this->document->setTitle($this->language->get('text_promos_title'));
            $this->document->setDescription($this->language->get('text_promos_title'));
            $this->document->setKeywords($this->language->get('text_promos_title'));
            $data['heading_title'] = $this->language->get('text_promos_title');

            $data['column_right'] = $this->load->controller('common/column_right');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');



            //добавление баннеров
            $this->response->setOutput($this->load->view('information/promos', $data));
        }
    }

    private function ShowPromo($promo_id,$breadcrumbs)
    {
        $promo_info = $this->model_catalog_promo->getPromo($promo_id,15);

        $breadcrumbs[] = array(
            'text' => $promo_info['title'],
            'href' => $this->url->link('information/promo', 'promo_id=' . $promo_id)
        );

        if ($promo_info['meta_title']) {
            $this->document->setTitle($promo_info['meta_title']);
        } else {
            $this->document->setTitle($promo_info['title']);
        }
        $this->document->setDescription($promo_info['meta_description']);
        $this->document->setKeywords($promo_info['meta_keyword']);
        if ($promo_info['meta_h1']) {
            $data['heading_title'] = $promo_info['meta_h1'];
        } else {
            $data['heading_title'] = $promo_info['title'];
        }
        $this->load->model('tool/image');
        $data['description'] = html_entity_decode($promo_info['description'], ENT_QUOTES, 'UTF-8');
        $data['title'] = $promo_info['title'];
        $data['image'] = $this->model_tool_image->resize($promo_info['image'],544, 356);
        $data['date_added'] = $promo_info['date_added'];

        //easy pagination
        $minmax = $this->model_catalog_promo->getPromoMinMaxId();
        $prev= $promo_id-1; $next = $promo_id+1;
        if($minmax['minId']<=$prev)
            $data['prev']  = $this->url->link('information/promo', 'promo_id=' . $prev);
        else
            $data['prev'] = '';
        if($minmax['maxId']>=$next)
            $data['next']  = $this->url->link('information/promo', 'promo_id=' . $next);
        else
            $data['next'] = '';

        /*$data['button_continue'] = $this->language->get('button_continue');
        $data['continue'] = $this->url->link('common/home');
        */
        $data['breadcrumbs'] =  $breadcrumbs;
        $data['column_right'] = $this->load->controller('common/column_right');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
        $data['count_form'] = $this->load->controller('common/count_form');
        $this->response->setOutput($this->load->view('information/promo', $data));
    }


}
