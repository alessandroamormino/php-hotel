<?php

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
// Check if checkbox Parking is selected
$isParkingChecked = isset($_GET['parking']) ? true : false;

// Check if checkbox all Hotels is selected
$isAllHotelsChecked = isset($_GET['all']) ? true : false;

// Check vote input field
$vote = isset($_GET['vote']) ? $_GET['vote'] : '';

// Array of Hotels with parking services
$parkingAvailableHotels = array_filter(
  $hotels,
  function ($hotel) {
    if ($hotel['parking']) {
      return $hotel;
    }
  }
);

// Array of Hotels without parking services
$parkingNotAvailableHotels = array_filter(
  $hotels,
  function ($hotel) {
    if (!$hotel['parking']) {
      return $hotel;
    }
  }
);


?>
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Hotels</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <h1 class="m-4">Hotels</h1>
  <!-- Form -->
  <form action="index.php" method='GET' class="m-4">
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="parking" name="parking" <?php echo $isParkingChecked ? 'checked' : '' ?>>
      <label class="form-check-label" for="parking">Parking</label>
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" class="form-check-input" id="all" name="all" <?php echo $isAllHotelsChecked ? 'checked' : '' ?>>
      <label class="form-check-label" for="all">Show All Hotels</label>
    </div>
    <div class="mb-3 w-25">
      <label for="vote" class="form-label">Vote</label>
      <input type="number" class="form-control" id="vote" name="vote">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  <!-- Bootstrap Table -->
  <table class="table table-hover mx-auto">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Parking</th>
        <th scope="col">Vote</th>
        <th scope="col">Distance to center</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($isAllHotelsChecked) {
        if ($vote != '') {
          $hotels = array_filter(
            $hotels,
            function ($hotel) {
              $vote = isset($_GET['vote']) ? $_GET['vote'] : '';
              if ($hotel['vote'] >= $vote) {
                return $hotel;
              }
            }
          );
        }
        foreach ($hotels as $hotel) {
          ?>
          <tr>
            <?php
            foreach ($hotel as $key => $element) {
              if ($key == 'name') {
                ?>
                <th scope="row">
                  <?php echo $element; ?>
                </th>
                <?php
              } elseif ($key == 'parking') {
                ?>
                <td>
                  <?php
                  if ($element) {
                    echo "Yes";
                  } else {
                    echo "No";
                  }
                  ?>
                </td>
                <?php
              } elseif ($key == 'distance_to_center') {
                ?>
                <td>
                  <?php echo $element . " km" ?>
                </td>
                <?php
              } else {
                ?>
                <td>
                  <?php echo $element; ?>
                </td>
                <?php
              }
              ?>
              <?php
            }
            ?>
          </tr>
          <?php
        }
      } else {
        if (!$isParkingChecked) {
          if ($vote != '') {
            $parkingNotAvailableHotels = array_filter(
              $parkingNotAvailableHotels,
              function ($hotel) {
                $vote = isset($_GET['vote']) ? $_GET['vote'] : '';
                if ($hotel['vote'] >= $vote) {
                  return $hotel;
                }
              }
            );
          }
          ?>
          <?php
          foreach ($parkingNotAvailableHotels as $hotel) {
            ?>
            <tr>
              <?php
              foreach ($hotel as $key => $element) {
                if ($key == 'name') {
                  ?>
                  <th scope="row">
                    <?php echo $element; ?>
                  </th>
                  <?php
                } elseif ($key == 'parking') {
                  ?>
                  <td>
                    <?php
                    if ($element) {
                      echo "Yes";
                    } else {
                      echo "No";
                    }
                    ?>
                  </td>
                  <?php
                } elseif ($key == 'distance_to_center') {
                  ?>
                  <td>
                    <?php echo $element . " km" ?>
                  </td>
                  <?php
                } else {
                  ?>
                  <td>
                    <?php echo $element; ?>
                  </td>
                  <?php
                }
                ?>
                <?php
              }
              ?>
            </tr>
            <?php
          }
          ?>
          <?php
        } else {
          ?>
          <?php
          if ($vote != '') {
            $parkingAvailableHotels = array_filter(
              $parkingAvailableHotels,
              function ($hotel) {
                $vote = isset($_GET['vote']) ? $_GET['vote'] : '';
                if ($hotel['vote'] >= $vote) {
                  return $hotel;
                }
              }
            );
          }
          foreach ($parkingAvailableHotels as $hotel) {
            ?>
            <tr>
              <?php
              foreach ($hotel as $key => $element) {
                if ($key == 'name') {
                  ?>
                  <th scope="row">
                    <?php echo $element; ?>
                  </th>
                  <?php
                } elseif ($key == 'parking') {
                  ?>
                  <td>
                    <?php
                    if ($element) {
                      echo "Yes";
                    } else {
                      echo "No";
                    }
                    ?>
                  </td>
                  <?php
                } elseif ($key == 'distance_to_center') {
                  ?>
                  <td>
                    <?php echo $element . " km" ?>
                  </td>
                  <?php
                } else {
                  ?>
                  <td>
                    <?php echo $element; ?>
                  </td>
                  <?php
                }
                ?>
                <?php
              }
              ?>
            </tr>
            <?php
          }
          ?>
          <?php
        }
      }
      ?>
    </tbody>
  </table>


  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>