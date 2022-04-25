<?php include "sidebar.php";?>

<div class="container">
    <h1>Dashboard</h1>
    <div class="card text-center border-dark mb-3">
        <div class="card-header">
            Check IN/OUT
        </div>
        <div class="card-body">
            <form action="checkin" method="POST">
                <?php 
                if($variables['status'] != "that's all for today"){
                    if(isset($_REQUEST['invalid'])) { ?>
                <div class="alert alert-danger" role="alert">
                    Invalid Check IN/OUT Code. Please try again.
                </div>
                <?php   
                    } ?>
                <input type="text" class="form-control" name="code" placeholder="Enter Check IN/OUT Code">
                <br/>
                <?php 
                } ?>
                <input type="submit" class="btn btn-primary form-control" value="<?php echo strtoupper($variables['status'])?>" <?php if($variables['status'] == "that's all for today") echo "disabled"; ?>>
            </form>
        </div>
    </div>
    <div>
        <h3>Attendance Logs</h3>
        <div class="row">
            <?php $date = $_REQUEST['date']??date('Y-m-d');?>
            <div class="col-3">
                <input type="date" name="date" value="<?php echo $date ?>" class="form-control" onchange="setDate(event)">
            </div>
            <div class="col-auto">
                <a href="dashboard?date=<?php echo date('Y-m-d',strtotime("-1 days", strtotime($date)))?>" class="btn btn-secondary"> < </a>
                <a href="dashboard?date=<?php echo date('Y-m-d',strtotime("+1 days", strtotime($date)))?>" class="btn btn-secondary"> > </a>
            </div>
            <div class="col-auto">
                <a href="dashboard?date=<?php echo date('Y-m-d')?>" class="btn btn-secondary">Today</a>
            </div>
        </div>
        <br/>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Check In</th>
                    <th scope="col">Check Out</th>
                    <th scope="col">Break Check Out</th>
                    <th scope="col">Break Check In</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $length = count($variables['result']);
                $have_result = false;

                for ($i = 0; $i < $length; $i++ )
                {
                    $have_result = true;
                    $name = $variables['result'][$i]['name'];
                    if($variables['result'][$i]['admin'])
                    {
                        $name = $variables['result'][$i]['name'] . " <span class='badge bg-warning'>Admin</span>";
                    }
                    $checkinTime = isset($variables['result'][$i]['checkin_time']) ? date("h:ia",strtotime($variables['result'][$i]['checkin_time'])) : '-';
                    $checkoutTime = isset($variables['result'][$i]['checkout_time']) ? date("h:ia",strtotime($variables['result'][$i]['checkout_time'])) : '-';
                    $breakCheckoutTime = isset($variables['result'][$i]['break_checkout_time']) ? date("h:ia",strtotime($variables['result'][$i]['break_checkout_time'])) : '-';
                    $breakCheckinTime = isset($variables['result'][$i]['break_checkin_time']) ? date("h:ia",strtotime($variables['result'][$i]['break_checkin_time'])) : '-';
                    
                    $late = isset($variables['result'][$i]['late_to_work']) ? $variables['result'][$i]['late_to_work'] : null;
                    $overBreak = isset($variables['result'][$i]['over_break']) ? $variables['result'][$i]['over_break'] : null;
                    $leaveEarly = isset($variables['result'][$i]['leave_early']) ? $variables['result'][$i]['leave_early'] : null;
                ?>
                    <tr>
                        <td><?php echo $name; ?></td> 
                        <td><?php echo $checkinTime; if($late) echo " <span class='badge bg-danger'>".$late." mins late</span>"?></td> 
                        <td><?php echo $checkoutTime; if($leaveEarly) echo " <span class='badge bg-danger'>".$leaveEarly." mins early</span>"?></td> 
                        <td><?php echo $breakCheckoutTime; ?></td> 
                        <td><?php echo $breakCheckinTime; if($overBreak) echo " <span class='badge bg-danger'>".$overBreak." mins late</span>"?></td> 
                    </tr>
                <?php	
                }
                if(!$have_result)
                {
                    echo "<tr><td colspan='5'>No one working today</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function setDate(e){
        var date = e.target.value;
        window.location = 'dashboard?date='+date;
    }
</script>