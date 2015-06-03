<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Trip_sorting {

    var $asRoutes = array();
    var $ssSource = '';
    var $ssDestination = '';

    // Initialize the Trip Sorting Obj
    public function init() {
        return new self();
    }

    public function setTripRoutes($ssSource = array()) {
        $this->asRoutes[] = $ssSource;
        /* $this->asDestinations[] = $ssDestination;
          $this->asTransportation[] = $ssTransportation;
          $this->asTicket[] = $ssTicket;
          $this->asOtherInformation[] = $ssOtherInfo; */
        return;
    }

    // Get All Routes Being Passed
    public function getTripRouts() {
        return $this->asRoutes;
    }

    // Set Start Point
    public function setTripStart($ssSource = '') {
        $this->ssSource = $ssSource;
    }

    // Set End Destination
    public function setTripEnd($ssDestination = '') {
        $this->ssDestination = $ssDestination;
    }

    // Get Start Point Of Trip
    private function getTripStart() {
        return $this->ssSource;
    }

    // Get End Destination
    public function getTripEnd() {
        return $this->ssDestination;
    }

    // Object ourput as String
    public function __toString() {
        $asRoutingSort = $this->setupTripPath();

        $i = 0;
        $snRountingSort = count($asRoutingSort);
        $asStringToAppend = array();
        while ($i < $snRountingSort) {
            switch (strtolower($asRoutingSort[$i][0])) {
                case 'train':
                    $asStringToAppend[] = $this->trainToString($asRoutingSort[$i]);
                    break;
                case 'airport bus':
                    $asStringToAppend[] = $this->airportBusToString($asRoutingSort[$i]);
                    break;
                case 'flight':
                    $asStringToAppend[] = $this->airportToString($asRoutingSort[$i]);
                    break;
            }
            $i++;
        }

        return $this->array2ul($asStringToAppend);
    }

    protected function setupTripPath() {
        $asAvailRoutes = $this->getTripRouts();
        $ssStartPoint = $this->getTripStart();
        $ssEndPoint = $this->getTripEnd();

        $asPerfectRoute = array();
        $snAvailableCounts = count($asAvailRoutes);
        if ($snAvailableCounts > 0) {

            $ssPreviousDestination = "";

            if (trim($ssStartPoint) === trim($ssEndPoint)) {
                foreach ($asAvailRoutes as $key => $asRoutes) {
                    if (count($asPerfectRoute) == 0) {
                        if (strtolower($ssStartPoint) === strtolower($asRoutes[1])) {
                            $asPerfectRoute[] = $asRoutes;
                        }
                    }
                }
            } else {
                while (isset($asAvailRoutes) && count($asAvailRoutes) > 0) {
                    foreach ($asAvailRoutes as $key => $asRoutes) {
                        if (count($asPerfectRoute) == 0) {
                            if (strtolower($ssStartPoint) === strtolower($asRoutes[1])) {
                                $asPerfectRoute[] = $asRoutes;
                                $ssPreviousDestination = $asRoutes[2];
                                unset($asAvailRoutes[$key]);
                            }
                        } else if (strtolower($asRoutes[1]) === strtolower($ssPreviousDestination)) {
                            $asPerfectRoute[] = $asRoutes;
                            $ssPreviousDestination = $asRoutes[2];
                            unset($asAvailRoutes[$key]);
                        }
                        
                    }
                }
            }
        }
        // Forming Array to be sent
        $inputStarted = 0;
        foreach ($asPerfectRoute as $asFinalRoute) {

            if ((strtolower($ssStartPoint) == trim(strtolower($asFinalRoute[1]))) && (strtolower($ssEndPoint) == trim(strtolower($asFinalRoute[2])))) {
                $inputStarted = 1;
                $asFinalRouteToBeSend = array();
                $asFinalRouteToBeSend[] = $asFinalRoute;
                break;
            } else {
                if (strtolower($ssStartPoint) == trim(strtolower($asFinalRoute[1]))) {
                    $inputStarted = 1;
                    $asFinalRouteToBeSend = array();
                    $asFinalRouteToBeSend[] = $asFinalRoute;
                } else if (strtolower($ssEndPoint) == trim(strtolower($asFinalRoute[2]))) {
                    $asFinalRouteToBeSend[] = $asFinalRoute;
                    break;
                } else if ($inputStarted == 1) {
                    $asFinalRouteToBeSend[] = $asFinalRoute;
                }
            }
        }
        return $asFinalRouteToBeSend;
    }

    private function trainToString($asDetail = array()) {
        return sprintf('Take train %s from %s to %s. Sit in seat %s.', $asDetail[4], $asDetail[1], $asDetail[2], $asDetail[3]);
    }

    private function airportBusToString($asDetail = array()) {
        return sprintf('Take the airport bus from %s to %s. %s.', $asDetail[1], $asDetail[2], (trim($asDetail[3]) != "") ? " Seat No: " . $asDetail[3] : "No seat assignment");
    }

    private function airportToString($asDetail = array()) {

        $ssString = sprintf("From %s, take flight %s to %s. Gate %s, seat %s.", $asDetail[1], $asDetail[4], $asDetail[2], $asDetail[3], $asDetail[5]);

        if (isset($asDetail[6])) {
            if (is_numeric($asDetail[6])) {
                $ssString .= sprintf(" Baggage drop at ticket counter %s.", $asDetail[6]);
            } else {
                $ssString .= " Baggage will we automatically transferred from your last leg.";
            }
        }
        /* Baggage drop at ticket counter 344.

          From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B.
          Baggage will we automatically transferred from your last leg.
          return sprintf('Take train %s from %s to %s. Sit in seat 45B.', $asTrainDetail[4], $asTrainDetail[1], $asTrainDetail[2], $asTrainDetail[3]); */
        return $ssString;
    }

    function array2ul($array, $ssCustomUlClass = "", $ssCustomLiClass = "") {
        $out = "<ul $ssCustomUlClass>";
        foreach ($array as $key => $elem) {
            if (!is_array($elem)) {
                $out = $out . "<li $ssCustomLiClass>$elem</li>";
            } else
                $out = $out . "<li $ssCustomLiClass>" . array2ul($elem) . "</li>";
        }
        $out = $out . "</ul>";
        return $out;
    }

}
