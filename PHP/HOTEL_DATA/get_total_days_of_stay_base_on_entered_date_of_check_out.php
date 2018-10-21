<?php

    include_once "../FUNCTIONS_HOME/hotel_data_functions.php";
    $execute_get = new Hotel_data_functions();

    $customer_id = $_POST['id'];
    if($customer_id == "") {
        $date_of_check_out = $_POST["date_of_check_out"];
        $date_of_check_out = $date_of_check_out." 12:00:00";
        $execute_get->get_total_days_of_stay_base_on_entered_date_of_check_out($date_of_check_out, $customer_id);
    } else {
        $date_of_check_out = $_POST["read_only_date_of_check_out"];
        $execute_get->get_total_days_of_stay_base_on_entered_date_of_check_out($date_of_check_out, $customer_id);
    }