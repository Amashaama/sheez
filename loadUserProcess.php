<?php

include "connection.php";

$rs = Database::search("SELECT * FROM `user`  INNER JOIN `gender` ON gender.id=user.gender_id WHERE `user_type_id`='2' ");



$num = $rs->num_rows;

for ($i = 0; $i < $num; $i++) {

    $d = $rs->fetch_assoc();

    $p_rs = Database::search("SELECT `path` FROM `profile_img` WHERE `user_email`='" . $d["email"] . "'  ");
    $p_num = $p_rs->num_rows;
    $p_data = $p_rs->fetch_assoc();

?>



    <tr>
        <td>
            <?php

            if ($p_num == 1) {
            ?>
                <img src="<?php echo $p_data["path"]; ?>" width="50" height="60">
            <?php
            }else{
                ?>

              <img src="resources/blank_user.png" width="50" height="60"> 
               
                <?php
            }

            ?>




        </td>
        <td><?php echo $d["fname"]  ?></td>
        <td><?php echo $d["email"]  ?></td>
        <td><?php echo $d["gender_name"]  ?></td>
        <td class="text-danger"><?php

                                if ($d["status"] == 1) {
                                    echo ("Active");
                                } else {
                                    echo ("Deactive");
                                }


                                ?></td>

    </tr>


<?php

}


?>