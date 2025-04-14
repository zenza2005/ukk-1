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
            <input type="text" name="harga" id="harga" required placeholder="Contoh: 100000">

            <label for="diskon">Diskon (%):</label>
            <input type="text" step="any" name="diskon" id="diskon" required placeholder="Contoh: 10">

            <div class="button-group">
                <button type="submit" class="btn hitung">Hitung</button>
                <button type="button" class="btn hapus" onclick="hapusInput()">Hapus</button>
                <button type="button" class="btn reset" onclick="resetForm()">Reset</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $harga_input = str_replace('.', '', $_POST["harga"]);
            $harga = (int)$harga_input;

            $diskon_input = str_replace(',', '.', $_POST["diskon"]);
            $diskon = floatval($diskon_input);

            echo "<div class='hasil'>";
            
            if ($harga <= 0) {
                echo "<p style='color:red;'>Harga tidak boleh nol atau kosong</p>";
            } elseif ($diskon < 1 || $diskon > 100) {
                echo "<p style='color:red;'>Diskon harus antara 1% sampai 100%</p>";
            } else {
                $jumlah_diskon = ($harga * $diskon) / 100;
                $harga_setelah_diskon = $harga - $jumlah_diskon;

                echo "<p>Harga Awal: Rp " . number_format($harga, 0, ',', '.') . "</p>";
                echo "<p>Diskon: " . rtrim(rtrim($diskon, '0'), '.') . "%</p>";
                echo "<p>Potongan Harga: Rp " . number_format($jumlah_diskon, 0, ',', '.') . "</p>";
                echo "<p><strong>Harga Setelah Diskon: Rp " . number_format($harga_setelah_diskon, 0, ',', '.') . "</strong></p>";
            }

            echo "</div>";
        }
        ?>
    </div>

    <script>
        const hargaInput = document.getElementById("harga");
        const form = document.getElementById("diskonForm");

        hargaInput.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, "");
            let formatted = new Intl.NumberFormat("id-ID").format(value);
            this.value = formatted;
        });

        form.addEventListener("submit", function (e) {
            const hargaValue = parseInt(hargaInput.value.replace(/\D/g, ""));
            const diskonInput = document.getElementById("diskon");
            let diskonValue = parseFloat(diskonInput.value.replace(',', '.'));

            if (isNaN(hargaValue) || hargaValue === 0) {
                alert("Harga tidak boleh kosong atau nol");
                e.preventDefault();
                return;
            }

            if (isNaN(diskonValue) || diskonValue < 1 || diskonValue > 100) {
                alert("Diskon harus di antara 1% sampai 100%");
                e.preventDefault();
            }
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
