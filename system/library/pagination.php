<?php
class Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 8;
	public $url = '';
	public $text_first = '|&lt;';
	public $text_last = '&gt;|';
	public $text_next = '&lt';
	public $text_prev = '&gt;';

	public function render() {
		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		$output = '<ul class="pagination">';

		if ($page > 1) {
			$output .= '<li><a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">' . $this->text_first . '</a></li>';
			
			if ($page - 1 === 1) {
				$output .= '<li><a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">' . $this->text_prev . '</a></li>';
			} else {
				$output .= '<li><a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a></li>';
			}
		}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);

				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}

				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= '<li class="active"><span>' . $i . '</span></li>';
				} else {
					if ($i === 1) {
					$output .= '<li><a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">' . $i . '</a></li>';
					} else {
						$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
					}
				}
			}
		}

		if ($page < $num_pages) {
			$output .= '<li><a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a></li>';
			$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a></li>';
		}

		$output .= '</ul>';

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
    public function render2() {

        $this->text_next = '<svg class="arrow-right1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>';
        $this->text_prev = '<svg class="arrow-left1">
                        <use xlink:href="catalog/view/theme/pulsar/img/icons/sprite.svg#arrow"></use>
                    </svg>';
       $total = $this->total;

        if ($this->page < 1) {
            $page = 1;
        } else {
            $page = $this->page;
        }

        if (!(int)$this->limit) {
            $limit = 10;
        } else {
            $limit = $this->limit;
        }

        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

        $this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

        $output = '<div class="product-list__navigator navigator">';

        if ($page > 1) {
           // $output .= '<a href="' . str_replace(array('&amp;page={page}', '&page={page}'), '', $this->url) . '">' . $this->text_first . '</a>';

            if ($page - 1 === 1) {
                $output .= '<a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a>';
            } else {
                $output .= '<a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a>';
            }
        }

        $output .= '<div class="navigator__result">Найдено '.$total.' </div>';

        if ($page < $num_pages) {
            $output .= '<a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a>';

        }

        $output .= '</div>';

        if ($num_pages > 1) {
            return $output;
        } else {
            return '';
        }


    }

    public function render3() {
        $total = $this->total;
        $text = $this->text;



        if ($this->page < 1) {
            $page = 1;
        } else {
            $page = $this->page;
        }

        if (!(int)$this->limit) {
            $limit = 10;
        } else {
            $limit = $this->limit;
        }

        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);

        $this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

        $output = '<div class="promos__show-all">';

        if ($page < $num_pages) {
            $output .= '<a class="promos__show-all__link" href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text . '</a>';

        }

        $output .= '</div>';

        if ($num_pages > 1) {
            return $output;
        } else {
            return '';
        }


    }

}