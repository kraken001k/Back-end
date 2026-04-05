<?php
$result = [];

if (isset($_GET['search'])) {
    $query = $_GET['search'];

    $apiKey = "3331406f60857935eae24b5eba33fe75f20ef214"; // API-ключ приховано

    $url = "https://google.serper.dev/search";

    $data = json_encode([
        "q" => $query
    ]);

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-API-KEY: $apiKey",
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Search</title>
</head>
<body>

<form method="GET">
    <label>
        <input type="text" name="search" placeholder="Введіть запит">
    </label>
    <button type="submit">Пошук</button>
</form>

<?php
if (!empty($result['organic'])) {
    foreach ($result['organic'] as $item) {
        echo "<h3>" . $item['title'] . "</h3>";
        echo "<a href='" . $item['link'] . "'>" . $item['link'] . "</a>";
        echo "<p>" . $item['snippet'] . "</p><hr>";
    }
}
?>

</body>
</html>