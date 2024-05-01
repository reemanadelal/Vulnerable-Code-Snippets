<?php
// Include the common header file securely
include_once("../common/header.php");
?>

<!-- from https://pentesterlab.com/exercises/php_include_and_post_exploitation/course -->
<?php hint("will include the arg specified in the GET parameter \"page\""); ?>

<form action="/LFI-1/index.php" method="GET">
    <input type="text" name="page">
    <input type="submit" value="Include Page">
</form>

<?php
// Define a whitelist of allowed pages
$allowed_pages = array("page1.php", "page2.php", "page3.php");

// Check if the "page" parameter is set
if (isset($_GET["page"])) {
    // Sanitize the input to prevent directory traversal
    $page = basename($_GET["page"]);

    // Check if the requested page is in the whitelist and exists
    if (in_array($page, $allowed_pages) && file_exists("../allowed_pages/" . $page)) {
        // Include the file
        include("../allowed_pages/" . $page);
    } else {
        // Handle invalid or unauthorized requests
        echo "Invalid page request.";
    }
}
?>
