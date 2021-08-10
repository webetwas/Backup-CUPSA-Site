<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('xdebug.var_display_max_depth', -1);
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
class Blog extends CI_Controller {

    private $ControllerObject;
    
    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->helper('text');
        $this->load->model('Pagini_model', '_Pagini');
        $this->load->model("Item_model", "_Item");
        $this->load->model("Object_model", "_Object");
        $this->load->model("Airdrop_model", "_Airdrop");
        // $this->load->model("paginare");

        // $this->ControllerObject = $this->_Object->getObjectStructure("blog");
    }

    public function index()
    {
        // redirect(base_url());
        $viewdata = array(
            "page" => null,
            "pathimgpage" => PATH_IMG_PAGINA,
            "pathimgblog" => PATH_IMG_BLOG,
            "posts" => null,
            "links" => null,
            "pathimgbanners" => PATH_IMG_BANNERS
        );

        // $config["base_url"] = base_url() . "blog/";
        // $config["total_rows"] = $this->_Object->record_count();
        // $config["per_page"] = 6;
        // $config["uri_segment"] = 2;
        // $config['use_page_numbers'] = TRUE;
        // $config['enable_query_strings'] = TRUE;
        // $config['page_query_string'] = TRUE;
        // $choice = $config["total_rows"] / $config["per_page"];
        // $config["num_links"] = round($choice);

        // <li><a href="news-details.php"><i class="zmdi zmdi-chevron-left"></i></a></li>
        // <li class="current"><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
        //config for bootstrap pagination class integration
        // $config['full_tag_open'] = '<ul class="pagination">';
        // $config['full_tag_close'] = '</ul>';
        // $config['first_link'] = false;
        // $config['last_link'] = false;

        // $config['prev_link'] = '<li><i class="zmdi zmdi-chevron-left"></i></a></li>';

        // $config['next_link'] = '<li><i class="zmdi zmdi-chevron-right"></i></a></li>';

        // $config['cur_tag_open'] = '<li class="current"><a href="#">';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['num_tag_open'] = '<li>';
        // $config['num_tag_close'] = '</li>';
        
        
        // $this->pagination->initialize($config);

        // $pagina = ($this->uri->segment($config["uri_segment"] )) ? $this->uri->segment($config["uri_segment"] ) : 0;

        $page = $this->_Pagini->GetPage("stiri"); //getpage
        if($page) $viewdata["page"] = $page;

        // $posts = $this->_Object->getContentItemsFull("blog", "bdc28db3011a43b6baa47ebd4ee01642", $config["per_page"]);
        // if($posts) $viewdata["posts"] = $posts;

        // $posts = $this->_Object->getAllArticlesBlogs($pagina, $config["per_page"]);
        // if($posts) $viewdata["posts"] = $posts;

        // $viewdata["links"] = $this->pagination->create_links();
// print_r($page); die;
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => 'pagini/' . $page->s->filehtml, "viewdata" => $viewdata],
            ), 'javascript' => null
        ];

        $this->frontend->slider = false;
        $this->frontend->render($view,
            array(
                "title_browser_ro" => (!is_null($page->p->title_browser_ro) ? $page->p->title_browser_ro : $page->p->title_browser_ro),
                "meta_description" => (!is_null($page->p->meta_description) ? $page->p->meta_description : $page->p->meta_description),
                "keywords"         => (!is_null($page->p->keywords) ? $page->p->keywords : $page->p->keywords)
            )
        );
    }

    /**
     * [articol]
     * @return [type] [description]
     */
    public function articol($http_id)
    {
        $viewdata = array(
            "page" => null,
            "pathimgpage" => PATH_IMG_PAGINA,
            "pathimgblog" => PATH_IMG_BLOG,
            "post" => null,
            "posts" => null
        );
        
        $post = $this->_Airdrop->getArticol('stiri', 'articole', $http_id);
        if(!empty($post))
        {
            $viewdata["post"] = $post;
        }

        $page = $this->_Pagini->GetPage("blog");//getpage
        // print_r($post); die;
        if($page) $viewdata["page"] = $page;
        
        // $post = $this->_Object->GetItemWhttp_id($this->ControllerObject, $http_id);
        // if($post) $viewdata["post"] = $post;

        // $posts = $this->_Object->getContentItemsFull("blog", "bdc28db3011a43b6baa47ebd4ee01642");
        // if($posts) $viewdata["posts"] = $posts;
        
        $view = (object) [ 'html' => array(
                0 => (object) ["viewhtml" => "pagini/blog_single", "viewdata" => $viewdata],
            ), 'javascript' => null
        ];
        
        $this->frontend->slider = false;
        $this->frontend->render($view,
            array(
                "title_browser_ro" => (!empty($post->atom_name_ro) ? $post->atom_name_ro : $page->p->title_browser_ro),
                "meta_description" => (!empty($post->i_titlu_ro) ? $post->i_titlu_ro : $page->p->meta_description),
                "keywords" => (!empty($post->http_keywords) ? $post->http_keywords : $page->p->keywords)
            )
        );
    }
}

