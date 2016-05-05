<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type"content="text/html; charset=UTF-8">
    <title>Load Data While Page Scroll with jQuery and PHP</title>
</head>
<body>
<div class="student_list">
    <?php echo $next=base_url('test/welcome/ajaxScrollData') ?>
    <h1><a href="#">Load Data While Page Scroll with jQuery and PHP</a></h1>
    <!-- loop row data -->
        <div class="item" id="item-1">
            <h2>sdg</h2>
            <p>sfs</p>
        </div>
        <div class="nav">
            <a href='?p=<?php echo $next?>'>Next</a>
        </div>

</div>
<div style="height: 500px; border: 1px solid #0000cc">

</div>
</body>
</html>

<script type="text/javascript"src="<?php echo base_url('assets/js/jquery-ias.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Infinite Ajax Scroll configuration
        $.ias({
            container :'.student_list', // main container where data goes to append
            item:'.item', // single items
            pagination:'.nav', // page navigation
            next:'.nav a' // next page selector
        })
            .extension(new IASSpinnerExtension())
            .extension(new IASTriggerExtension({offset: 20}));
    });
</script>