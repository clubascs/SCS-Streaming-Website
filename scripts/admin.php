<!DOCTYPE html>
<html>
<head>
    <title>Text File Editor - Admin Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        h3 {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        pre {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>SCS Stream - Admin Interface</h2>

    <?php
    // Define the filenames for the text files
    $filenames = array(
        "stream1.txt",
        "stream2.txt",
        "stream3.txt"
    );

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Iterate over each submitted form
        for ($i = 0; $i < count($filenames); $i++) {
            // Get the text input from the form
            $text = $_POST["text"][$i];

            // Open the corresponding text file in write mode (overwriting existing content)
            $file = fopen($filenames[$i], "w") or die("Unable to open file!");

            // Write the text input to the file
            fwrite($file, $text . PHP_EOL);

            // Close the file
            fclose($file);
        }

        // Display a success message
        echo "<p class='success'>All notes saved successfully!</p>";
    }

    // Display the current contents of each text file
    for ($i = 0; $i < count($filenames); $i++) {
        echo "<h3>Current Display for Stream " . ($i + 1) . ":</h3>";
        if (file_exists($filenames[$i])) {
            // Read the contents of the file
            $contents = file_get_contents($filenames[$i]);
            // Display the contents
            echo "<pre>" . $contents . "</pre>";
        } else {
            echo "<p>Nothing stored for Stream " . ($i + 1) . ".</p>";
        }
    }
    ?>

    <h3>Add Notes:</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php
        // Generate the text input fields for each field
        for ($i = 0; $i < count($filenames); $i++) {
            echo "<textarea name=\"text[$i]\" rows=\"4\" cols=\"50\" placeholder=\"Enter display for Stream " . ($i + 1) . "\"></textarea><br>";
        }
        ?>
        <input type="submit" value="Save All">
    </form>

</div>

</body>
</html>
