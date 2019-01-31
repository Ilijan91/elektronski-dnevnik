
<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="teacher-default-index">
    
    <div class="container main">
        <h2>Students <span class="department_name"><?=$department_name?><span></h2>
        <?php 
       
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">JMBG</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Parent</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        foreach($students as $student){
                                echo '
                                <tr>
                                    <td>'.$student['first_name'].'</td>
                                    <td>'.$student['last_name'].'</td>
                                    <td>'.$student['JMBG'].'</td>
                                    <td>'.$student['address'].'</td>
                                    <td>'.$student['phone'].'</td>
                                    <td>'.$student['parent'].'</td>
                                </tr>
                                ';
                        }
                    ?>          
            </tbody><!-- End of table body-->
        </table><!-- End of table -->
    </div><!-- End of container main --> 
</div><!-- End of teacher-default-index -->
