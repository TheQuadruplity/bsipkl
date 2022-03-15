<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use NumberFormatter;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['authredirect'];


    /**
     * Protected Variables (custom)
     */
    protected $currencyfmt;

    protected $sidebar = [
        ['jurnal', 'Jurnal', 'fas fa-book'],
        ['posneraca', 'Pos Neraca', 'fas fa-balance-scale'],
        ['posbeban', 'Pos Beban', 'fas fa-weight-hanging'],
        [],
        ['pengambilan', 'Pengambilan', 'fas fa-arrow-right'],
        ['penyelesaian', 'Penyelesaian', 'fas fa-arrow-left'],
        [],
        ['database'],
        ['jenispersekot', 'Jenis Persekot', 'fas fa-landmark'],
        ['beban', 'Daftar Beban', 'fas fa-th-list'],
        ['rekening', 'Daftar Rekening', 'fas fa-credit-card'],
        [],
        ['admin', 'Admin', "fas fa-user"],
        ];

    /**
     * Constructor.
     */

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->currencyfmt = numfmt_create('ID_id', NumberFormatter::CURRENCY);

        if(authRedirect()) session()->setTempdata('auth', session()->getTempdata('auth'));
        else{
            if(uri_string() != '/') session()->setFlashdata('msg', 'Sesi anda telah habis, silakan login');
        }
    }

    /**
     * Protected Methods (custom)
     */
    protected function page($page, $data = [])
    {
        echo view('templates/header', ['data' => $this->sidebar, 'page' => get_called_class()]);
        echo view('pages/'.$page, $data);
        echo view('templates/footer');
    }

    protected function atrdr(){
        if(!authRedirect()) echo redirect()->to(base_url('login'));
        else session()->setTempdata('auth', session()->getTempdata('auth'));
    }

}
