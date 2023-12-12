<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Dorker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body onload="loadScanOptions()">
    <div class="container">
        <h1>Web Dorker</h1>
        <form id="scannerForm">
            <div class="social-icons">
                <a href="https://www.linkedin.com/in/nmochea" target="_blank" title="LinkedIn"><i
                        class="fab fa-linkedin" alt="LinkedIn"></i></a>
                <a href="https://nmochea.medium.com/" target="_blank" title="Medium"><i
                        class="fab fa-medium" alt="Medium"></i></a>
                <a href="https://forms.gle/pmz5mANJiuSQiEdz9" target="_blank" title="Google"><i
                        class="fab fa-google" alt="Google"></i></a>
            </div>

            <label for="urlInput">Enter Domain:</label>
            <input type="text" id="urlInput" placeholder="e.g., example.com" required>
            <label for="dorkType">Select Dork Type:</label>
            <select id="dorkType" onchange="loadScanOptions()">
                <option value="Google">Google</option>
                <option value="Shodan">Shodan</option>
            </select>
            <label for="scanType">Select Scan Type:</label>
            <select id="scanType" name="scanType"></select>
            <button type="button" onclick="performScan()">Submit</button>
        </form>
    </div>
    <script type="text/javascript">
        function loadScanOptions() {
            var dorkTypeValue = document.getElementById('dorkType').value;
            var scanTypeSelect = document.getElementById('scanType');

            // Clear existing options
            scanTypeSelect.innerHTML = '';

            // Read the appropriate file based on the selected dorkType
            var options = [];
            if (dorkTypeValue === 'Google') {
                <?php
                $options = file('google.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($options as $option) {
                    $escapedOption = htmlspecialchars($option, ENT_QUOTES, 'UTF-8');
                    echo "options.push('$escapedOption');";
                }
                ?>
            } else if (dorkTypeValue === 'Shodan') {
                <?php
                $options = file('shodan.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($options as $option) {
                    $escapedOption = htmlspecialchars($option, ENT_QUOTES, 'UTF-8');
                    echo "options.push('$escapedOption');";
                }
                ?>
            }

            // Generate options dynamically
            options.forEach(function (option) {
                scanTypeSelect.innerHTML += '<option value="' + option + '">' + option + '</option>';
            });
        }

        function performScan() {
        var urlInputValue = document.getElementById('urlInput').value;
        var scanTypeValue = document.getElementById('scanType').value;
        var dorkTypeValue = document.getElementById('dorkType').value;

        if (dorkTypeValue === 'Google') {
            var searchQuery = `https://www.google.com/search?q=${encodeURIComponent(scanTypeValue.replace('${target}', urlInputValue))}`;
        } else if (dorkTypeValue === 'Shodan') {
            var searchQuery = `https://www.shodan.io/search?query=${encodeURIComponent(scanTypeValue.replace('${target}', urlInputValue))}`;
        }

        window.open(searchQuery, '_blank');
    }
    </script>
</body>

</html>
