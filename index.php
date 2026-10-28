<?php

require_once "data.php";
require_once "functions.php";

$totalBobotSks = 0;
$totalSks = 0;

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nilai Mata Kuliah</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Daftar Nilai Mata Kuliah</h1>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Huruf</th>
                    <th>Bobot</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $no = 1;

                foreach ($mataKuliah as $mk):

                    $hasil = hitungBobot($mk["nilai"]);

                    $huruf = $hasil["huruf"];
                    $bobot = $hasil["bobot"];

                    $status = ($bobot >= 2.0)
                        ? "LULUS"
                        : "MENGULANG";

                    $totalBobotSks += $bobot * $mk["sks"];
                    $totalSks += $mk["sks"];

                    $classRow = ($status === "MENGULANG")
                        ? "mengulang"
                        : "";

                ?>

                <tr class="<?= $classRow ?>">
                    <td><?= $no++ ?></td>
                    <td><?= $mk["nama"] ?></td>
                    <td><?= $mk["sks"] ?></td>
                    <td><?= $mk["nilai"] ?></td>
                    <td><?= $huruf ?></td>
                    <td><?= number_format($bobot, 1) ?></td>
                    <td><?= $status ?></td>
                </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

        <?php

        $ips = $totalBobotSks / $totalSks;

        $maksimalSks = ($ips >= 3.00)
            ? 24
            : 20;

        ?>

        <div class="ringkasan">

            <h2>Ringkasan IPS</h2>

            <p>
                <strong>Total SKS:</strong>
                <?= $totalSks ?> SKS
            </p>

            <p>
                <strong>IPS:</strong>
                <?= number_format($ips, 2) ?>
            </p>

            <p>
                <strong>Maksimal SKS Semester Depan:</strong>
                <?= $maksimalSks ?> SKS
            </p>

        </div>

    </div>

</body>

</html>