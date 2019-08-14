<?php
class ControllerInformationNewsList extends Controller
{
    public function index()
    {

        $this->load->language('information/information');
        $this->load->language('common/common');
        $this->load->model('catalog/information');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $limit = 4;
        $total_cnt = $this->model_catalog_information->getTotalInformations(15);

        $filter_data = array(
            'start'=>0,
            'limit' => 16
        );

        $news = $this->model_catalog_information->getInformationsByLimit(15,$filter_data);
        $data['news'] = array();
        foreach ($news as $result) {

            $data['news'][] = array(
                'title' => html_entity_decode($result['title'], ENT_QUOTES, 'UTF-8'),
                'source' => html_entity_decode($result['source'], ENT_QUOTES, 'UTF-8'),
                'date_added' => html_entity_decode($result['date_added'], ENT_QUOTES, 'UTF-8'),
                'description' => html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'),
                'href' => $this->url->link('information/news', 'information_id=' . $result['information_id'])
            );


        }




        /*
        $this->document->setTitle($this->language->get('text_news_title'));
        $this->document->setDescription($this->language->get('text_news_title'));
        $this->document->setKeywords($this->language->get('text_news_title'));
        $data['heading_title'] = $this->language->get('text_news_title');

        $data['column_right'] = $this->load->controller('common/column_right');
        $data['footer'] = $this->load->controller('common/footer');
        $data['header'] = $this->load->controller('common/header');
*/

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


        return $this->load->view('information/news_list', $data);
    }
}