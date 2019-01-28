<div class="parent-default-index">
    
    <div class="container main">
        <h2>Subjects</h2>
        <?php 
       
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Subjects</th>
                    <th scope="col">Grades</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>               
                    <?php
                          foreach($subjects as $subject){
                            echo '<tr>
                                <td>'. $subject->title . '</td>';

                                foreach($StudentSubject as $grade){
                                   echo '<td>' . $grade->grade . '</td>';
                                }
                                
                            '</tr>';
                        }
                      
                          
                    ?>  
                 
                         
                    



            </tbody><!-- End of table body-->
        </table><!-- End of table -->
    </div><!-- End of container main --> 
</div><!-- End of parent-default-index -->
