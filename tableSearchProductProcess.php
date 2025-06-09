<?php

include "connection.php";

$pid = $_POST["pid"];


$stock_rs = Database::search("SELECT * FROM `product` INNER JOIN
`color` ON product.color_clr_id=color.clr_id WHERE `id`='" . $pid . "' ");
$stock_num = $stock_rs->num_rows;


for ($s = 0; $s < $stock_num; $s++) {
    $stock_data = $stock_rs->fetch_assoc();
?>

    <tr>
        <td><?php echo $stock_data["id"] ?></td>
        <td><?php echo $stock_data["title"] ?></td>
        <td><?php echo $stock_data["qty"] ?></td>
        <td><?php echo $stock_data["price"] ?></td>
        <td><?php echo $stock_data["clr_name"] ?></td>
        <td><?php
            if ($stock_data["status_status_id"] == 1) {
                echo ("Available");
            } else {
                echo ("Not Available");
            }
            ?>
        </td>


    </tr>
<?php

}


?>