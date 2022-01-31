<?php
    function printConsole($data) 
    {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug: " . $output . "' );</script>";
    }
?>