







<?php

                    $koneksi = mysqli_connect("localhost", "root", "", "taxidb");

                    $bilang = mysqli_query($koneksi, "SELECT sum(refill_amount) as totalrefill FROM gas_inventory group by tank_no");

                    //$gastotal = mysqli_query($koneksi, "SELECT sum(gas_amount) as gastotalsum FROM gas group by tank_no");

                    $tankno = mysqli_query($koneksi, "SELECT tank_no FROM gas_inventory group by tank_no");


                    $bilangtaxi = mysqli_query($koneksi, "
                    SELECT `taxi_class`.`tc_text` as taxi_class, count(*) as not_available_count 
                    FROM `in_out`,`taxi`,`taxi_class` 
                    WHERE `in_out`.`t_id` = `taxi`.`t_id` and `taxi`.`tc_id` = `taxi_class`.`tc_id`
                    and `in_out`.`out_time` = '0000-00-00 00:00:00'
                    group by `taxi`.`tc_id`");

                    
                    
                    $klases = mysqli_query($koneksi, "SELECT tc_text FROM taxi_class");

function CHARTAX()
    {

         
        echo "
            <script src='js/Chart.bundle.js'></script>

            <style type='text/css'>
                .container {
                    width: 40%;
                    margin: 15px auto;
                }
            </style>

            <div class='container'>
            <div class='row'>
            <canvas id='myChart' width='5' height='40'></canvas>
            </div>
            </div>
            ";


    }
