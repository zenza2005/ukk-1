<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penghitung Diskon</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Penghitung Diskon</h1>
        <form method="post" id="diskonForm">
            <label for="harga">Harga Awal (Rp):</label>
            <input type="text" name="harga" id="harga" required>

            <label for="diskon">Diskon (%):</label>
            <input type="text" step="any" name="diskon" id="diskon" required>

            <div class="button-group">
                <button type="submit" class="btn hitung">Hitung</button>
                <button type="button" class="btn hapus" onclick="hapusInput()">Hapus</button>
                <button type="button" class="btn reset" onclick="resetForm()">Reset</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"]== "POST") {
            $harga_input = str_replace('.','',$_POST["harga"]);
            $harga = (int)$harga_input;

            $diskon_input = str_replace(',','.', $_POST["diskon"]);
            $diskon = floatval($diskon_input);

            $jumlah_diskon = ($harga * $diskon) / 100;
            $harga_setelah_diskon = $harga - $jumlah_diskon;

            echo "<div class='hasil'>";
            echo "<p>Harga Awal: Rp " . number_format($harga, 0, ',', '.')."</p>";
            echo "<p>Diskon: " . rtrim(rtrim($diskon, '0'),'.') ."%</p>";
            echo "<p>Potongan Harga: Rp " . number_format($jumlah_diskon, 0, ',','.') ."</p>";
            echo "<p><strong>Harga Setelah Diskon: Rp " . number_format($harga_setelah_diskon, 0, ',','.') . "</strong></p>";
        }
        ?>
    </div>

    <script>
        const hargaInput = document.getElementById("harga");

        hargaInput.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, "");
            let formatted = new Intl.NumberFormat("id-ID").format(value);
            this.value = formatted;
        });

        function hapusInput() {
            document.getElementById("harga").value = "";
            document.getElementById("diskon").value = "";
        }

        function resetForm() {
            window.location.href = window.location.pathname;
        }
        </script>
    </body>
</html>