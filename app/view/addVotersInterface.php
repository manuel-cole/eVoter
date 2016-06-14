<?php
include "../templates/header.php";
require_once("../model/member.php");
require_once("../model/DB.php");
?>
<link href="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script>
    $(document).ready(function() {
        $('#memberTable').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false });
    });
</script>

<script language="JavaScript">
    function toggle(source) {
        checkboxes = document.getElementsByName('check_list[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
</head>

<body>
<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container">
            <h1>Select Voters :</h1><br><br>
            <form class="form-horizontal" role="form" method="post" action="../controller/addVoters.php?electID=<?php echo $_GET["electID"];?>">
                <input type="checkbox" onClick="toggle(this)" /> Select All<br/><br/>
            <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="10%">
                <thead>
                <tr>
                    <th></th>
                    <th>MemberID</th>
                    <th>Member Name</th>
                    <th>Club Post</th>
                    <th>Date Of Join</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th>MemberID</th>
                    <th>Member Name</th>
                    <th>Club Post</th>
                    <th>Date Of Join</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php
                        $member = new Member();
                        $membersForElection = $member->loadMembersForElection((new DB)->connectToDatabase());
                    while($data1 = $membersForElection -> fetch_row()){
                    ?>
                    <tr  id = <?php echo $data1[0]?>>
                        <td class="tableData" name=<?php echo $data1[0]?>><input name="check_list[]" id=<?php echo $data1[0] ?> class="CheckBoxSchedule" type="checkbox" value="<?php echo $data1[0] ?>"></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[0] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[1] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[2] ?></td>
                        <input type="hidden" name="member[0][clubPost]" value="<?php echo $data1[2] ?>"/>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[4] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[5] ?></td>
                        <td class="tableData" name=<?php echo $data1[0] ?>><?php echo $data1[6] ?></td>
                    <?php } ?>
                </tbody>
            </table><br><br>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input name="submit" type="submit" id="addVotersBtn" value="Confirm"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>