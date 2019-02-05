
<div class="parent-default-index">
    
    <div class="container main">
        
        <?php 
            foreach($student as $fullname) {
                echo '<h2>'.$fullname->first_name.' '.$fullname->last_name.'</h2>';
            }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Subjects</th>
                    <th scope="col">Grades</th>
                   
                </tr>
            </thead>
            <tbody>               
                    <?php
                          foreach($grades as $subject=>$grade){
                            echo '<tr>
                                <td>'. $subject . '</td>
                                <td>' . $grade. '</td>  
                            </tr>';
                        }             
                    ?>  
            </tbody><!-- End of table body-->
        </table><!-- End of table -->
    </div><!-- End of container main --> 
</div><!-- End of parent-default-index -->
