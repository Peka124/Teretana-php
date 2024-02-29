<?php

require_once "config.php";

if(isset($_GET["what"]))
{
    if($_GET["what"]=="members")
    {
        $upit="SELECT * FROM members";
        $csv_columns=[
            "member_id",
            "first_name",	
            "last_name",
            "email",
            "phone_number",
            "photo_path",
            "training_plan_id",
            "trainer_id",
            "access_card_pdf_path",
            "created_at"
        ];
    }
    else if($_GET["what"]=="trainers") {
        $upit="SELECT * FROM trainers";
        $csv_columns=[
            "trainer_id",
            "first_name",
            "last_name",
            "email",
            "phone_number",
            "created_at"
        ];
    }
    else{
        echo "Greska";
        die();
    }

    $run=$konekcija->query($upit);
    $results=$run->fetch_all(MYSQLI_ASSOC);

    $output=fopen("php://output", "w");
    header("Content-Type: text/csv");
    header('Content-Disposition: attachment; filename=' . $_GET["what"] . ".csv");

    fputcsv($output, $csv_columns);

    foreach($results as $result)
    {
        fputcsv($output, $result);
    }

    fclose($output);
}
?>