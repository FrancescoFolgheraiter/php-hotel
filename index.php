<?php
    //controllo tramite operatore ternario il valore di parking
    $filterPark =  isset($_GET['parking']) ? $_GET['parking'] : '';
    //controllo tramite operatore ternario il valore di vote nel caso lo imposto a 0
    $filterVote =  isset($_GET['vote']) ? intval($_GET['vote']) : 0;
    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];
    $keysObjHotel = array_keys($hotels[0]);
    //creo un array di supporto che poi visualizzerò in pagina
    $updateHotels = [];
    //inizializzo una flag a vuoto
    $flagParking = "";

    foreach ($hotels as $hotel) {
        //nel caso riscontro che filterpark è true imposto la flag a true
        if($filterPark =="true"){
            $flagParking = true;
        }
        elseif ($filterPark =="false"){
            $flagParking = false;
        }
        //pusho nell'array nuovo
        if (($hotel["parking"] == $flagParking || empty($filterPark)) && $filterVote <= $hotel["vote"]) {
            $updateHotels[] = $hotel;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Php Hotel</title>
        <!--boostrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <!--css-->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class=" bg-body-tertiary ">
        <header>
            <h1 class="text-center m-5">
                Php Hotel
            </h1>
        </header>
        <main>
            <div class="container mb-3">
                <form action="" method="GET">
                    <div class="mb-3">
                        <label for="parking">Disponibilità parcheggio</label>
                        <select name="parking" id="parking">
                            <option value="" selected>Qualsiasi</option>
                            <option value="true">Disponibile</option>
                            <option value="false">Non disponibile</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vote">Cerca per voto</label>
                        <input type="number" name="vote" id="vote" max = "5" min = "0" placeholder="0">
                    </div>
                    <button type="submit" id="cerca">
                        Cerca
                    </button>
                </form>
            </div>
            <div class="container d-flex justify-content-center ">
                <table class="w-100">
                    <!--crezione header table-->
                    <thead>
                        <?php
                        foreach ($keysObjHotel as $singleKey) {
                        ?>
                        <th class="border-2">
                            <?php
                            echo $singleKey;
                            ?>
                        </th>
                        <?php
                        }
                        ?>
                    </thead>
                    <!--fine header table-->
                    <!--body table-->
                    <tbody>
                        <?php
                            foreach ($updateHotels as $hotel) {
                        ?>
                        <tr>
                            <?php
                                foreach ($hotel as $key=>$elem) {
                            ?>
                            <td class="border-bottom">
                                <?php
                                    if ($key == "parking" && $elem==true) {
                                        echo "yes";
                                    }
                                    elseif($key == "parking" && $elem==false){
                                        echo "no";
                                    }
                                    else{
                                        echo $elem;
                                    }
                                ?>
                            </td>
                            <?php
                                }
                             ?>  
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                    <!--fine table-->
                </table>
            </div>
        </main>
    </body>
</html>
