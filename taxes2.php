<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Podatki, rzecz pewna jak śmierć</title>
</head>
<body>


<pre>
<strong>Zadanie:</strong>
Policz cenę brutto od podanej w formularzu. Stawka VAT: 23%.
</pre>
<form action="">
    <input type="number" placeholder="kwota netto" name="netto" required step="0.01" min="0.01" max="1000000">
    <button type="submit">DALEJ</button>
</form>
<p>
    <?php
    // tu twój kod
    $vat = 23;
    if (isset($_GET['netto'])) {
        $netto = (float)$_GET['netto'];
        $brutto = $netto * (1 + $vat/100);
        echo 'wartość netto: '. $netto;
        echo '<br>';
        echo 'wartość brutto: '. $brutto;
        echo '<br>';
        echo 'wartość brutto [via round()]: '. round($brutto, 2);
        echo '<br>';
        echo 'wartość brutto [via number_format()]: '. number_format($brutto, 2);
    }
    ?>
</p>

<hr>

<pre>
<strong>Zadanie:</strong>
Policz cenę netto od podanej brutto w formularzu. Stawka VAT: 23%.
</pre>
<form action="">
    <input type="number" placeholder="kwota brutto" name="brutto" required step="0.01" min="0.01" max="1000000">
    <button type="submit">DALEJ</button>
</form>
<p>
    <?php
        if (isset($_GET['brutto'])) {
            // tu kod :)
            $brutto = (float)$_GET['brutto'];
            $netto = $brutto / (1 + $vat/100);
            echo '<br>';
            echo 'wartość netto: '. round($netto, 2);
        }
    ?>
</p>

<hr>

<pre>
<strong>Zadanie:</strong>
Pobierz aktualną tabelę kursów walut z NBP.
Przelicz podaną wartość PLN po uwzględnieniu kursu walut: USD, EUR, GBP.
</pre>
<form action="">
    <input type="number" step="0.01" min="0" max="1000000" placeholder="kwota w PLN" name="pln_value" required>
    <input type="submit" name="getCurrency" value="Pobierz i przelicz" >
</form>
<p>
    <?php
    if (isset($_GET['getCurrency']) && $_GET['getCurrency']=='Pobierz i przelicz') {
        $table = 'a';
        $url = 'http://api.nbp.pl/api/exchangerates/tables/'.$table;
        $data = file_get_contents($url);
        echo 'Źródło pobierania danych: '. $url;
        echo '<br>';
        echo '<br>';
        echo 'Format JSON: <br>';
        echo $data;
        echo '<br>';
        echo 'Format JSON przekształcony na tablicę: <br>';
        $jsonTable = json_decode($data, 1);
//        echo '<h5>pełna tablica JSON:</h5>';
//        echo '<pre>';
//        print_r($jsonTable);
//        echo '</pre>';
        // szukam interesujących mnie walut: USD, EUR i GBP
        // 1. muszę znać strukturę JSON z danymi:
        // 2. tu mam dane kursu
        //            [no] => 068/A/NBP/2019
        //            [effectiveDate] => 2019-04-05
        //
//        echo '<h5>tablica okrojonego JSON\'a do parametru rates:</h5>';
//        echo '<pre>';
//        print_r($jsonTable[0]['rates']);
//        echo '</pre>';
        // lista interesujących mnie walut:
        $wanted = [
            'USD', 'EUR', 'GBP', 'DKK'
        ];
        $result = [];
        foreach ($jsonTable[0]['rates'] as $rate) {
            if (in_array($rate['code'], $wanted )) {
                $result[] = $rate;
            }
        }
        // teraz mogę liczyć coś uwzględniając waluty które mnie interesują
        // $result
        echo '<h5>tablica znalezionych pasujących walut:</h5>';
        echo '<pre>';
        print_r($result);
        echo '</pre>';
        $pln_value = (float)$_GET['pln_value'];
        echo '<h5>'.$pln_value.' PLN to:</h5>';
        echo '<ul>';
        foreach ($result as $rate) {
            echo '<li>'.$rate['currency'].' ['.$rate['code'].']: '.number_format($pln_value / $rate['mid'], 2).'</li>';
        }
        echo '</ul>';
    }
    ?>
</p>
</body>
</html>