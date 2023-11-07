<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
      CREATE VIEW payments_views AS
      select max(`properties`.`lot_number`) AS `lot_number`,
      `periods`.`year` AS `year`,
      max(`person_types`.`id`) AS `person_type_id`,
      max(`person_types`.`name`) AS `person_type_name`,
      max(`persons`.`name`) AS `person_name`,
      max(`person_property`.`date_from`) AS `date_from`,
      max(`person_property`.`date_to`) AS `date_to`,
      sum(if(`periods`.`month_id` = 1,ifnull(`payments`.`value`,0),0)) AS `ENE`,
      sum(if(`periods`.`month_id` = 2,ifnull(`payments`.`value`,0),0)) AS `FEB`,
      sum(if(`periods`.`month_id` = 3,ifnull(`payments`.`value`,0),0)) AS `MAR`,
      sum(if(`periods`.`month_id` = 4,ifnull(`payments`.`value`,0),0)) AS `ABR`,
      sum(if(`periods`.`month_id` = 5,ifnull(`payments`.`value`,0),0)) AS `MAY`,
      sum(if(`periods`.`month_id` = 6,ifnull(`payments`.`value`,0),0)) AS `JUN`,
      sum(if(`periods`.`month_id` = 7,ifnull(`payments`.`value`,0),0)) AS `JUL`,
      sum(if(`periods`.`month_id` = 8,ifnull(`payments`.`value`,0),0)) AS `AGO`,
      sum(if(`periods`.`month_id` = 9,ifnull(`payments`.`value`,0),0)) AS `SEP`,
      sum(if(`periods`.`month_id` = 10,ifnull(`payments`.`value`,0),0)) AS `OCT`,
      sum(if(`periods`.`month_id` = 11,ifnull(`payments`.`value`,0),0)) AS `NOV`,
      sum(if(`periods`.`month_id` = 12,ifnull(`payments`.`value`,0),0)) AS `DIC`,
      sum(ifnull(`payments`.`value`,0)) AS `TOTAL`
      from (((((((`periods` join `person_property`)
      join `properties` on(`properties`.`id` = `person_property`.`property_id`))
      join `persons` on(`persons`.`id` = `person_property`.`person_id`))
      join `person_types` on(`person_types`.`id` = `persons`.`person_type_id`))
      join `property_types` on(`property_types`.`id` = `properties`.`property_type_id`))
      join `aliquot_values` on(`aliquot_values`.`id` = `properties`.`property_type_id`)) left
      join `payments` on(`payments`.`period_id` = `periods`.`id` and `payments`.`property_id` = `properties`.`id`))
      where cast(concat(`periods`.`year`,'-',`periods`.`month_id`,'-','01') as date) >= `person_property`.`date_from`
      and cast(concat(`periods`.`year`,'-',`periods`.`month_id`,'-','01') as date) <= ifnull(`person_property`.`date_to`,curdate())
      group by `properties`.`id`,`periods`.`year`
      HAVING sum(ifnull(`payments`.`value`,0)) > 0
      ");

  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS payments_views');
    }
}
