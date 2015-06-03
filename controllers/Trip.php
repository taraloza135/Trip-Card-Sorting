<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trip extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {

        // Initialized trip_sorting Library
        $this->load->library('trip_sorting');

        // This is how we can initiate trip_sorting
        $objTripSort = $this->trip_sorting->init();

        // Setting the Routes
        $objTripSort->setTripRoutes(array("Train", "Madrid", "Barcelona", "45B", "78A", "", ""));
        $objTripSort->setTripRoutes(array("Airport Bus", "Barcelona", "Gerona Airport", "", "", "", ""));
        $objTripSort->setTripRoutes(array("Flight", "Gerona Airport", "Stockholm", "3A", "SK455", "45B", "344"));
        $objTripSort->setTripRoutes(array("Flight", "Stockholm", "Salamanca", "7B", "SK22", "22", "transfer"));
        $objTripSort->setTripRoutes(array("Flight", "Salamanca", "New York JFK", "7B", "SK22", "22", "transfer"));
		$objTripSort->setTripRoutes(array("Flight", "New York JFK", "Madrid", "7B", "SK22", "22", "transfer"));


        // Decided Start and End Routes
        $objTripSort->setTripStart('Stockholm');
        $objTripSort->setTripEnd('Stockholm');

        // Displaying It in Ul Li Manner
        echo $objTripSort;
        exit();
    }

    protected function setDestination() {
        
    }

}
