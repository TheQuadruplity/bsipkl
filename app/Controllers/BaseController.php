<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
    protected $helpers = [];


    /**
     * Protected Variables (custom)
     */

    protected $sidebar = [
        ['Jurnal'],
        ['PosNeraca', 'Pos Neraca', 'fas fa-balance-scale'],
        ['PosBeban', 'Pos Beban', 'fas fa-weight-hanging'],
        [],
        ['Pengambilan', 'Pengambilan', 'fas fa-arrow-right'],
        ['Penyelesaian', 'Penyelesaian', 'fas fa-arrow-left'],
        [],
        ['Database'],
        ['JenisPersekot', 'Jenis Persekot', 'fas fa-landmark'],
        ['Beban', 'Daftar Beban', 'fas fa-th-list'],
        ['Rekening', 'Daftar Rekening', 'fas fa-credit-card'],

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

}
