<?php $this->load->view('include/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <?php if($this->session->userdata('id_anggota_sess')!=0) { ?>
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              <?=$this->db->count_all_results('user')?>
            </h3>
            <p>User</p>
          </div>
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <a href="<?=base_url().'User'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              <?=$this->db->count_all_results("mitra")?>
            </h3>
            <p>Mitra</p>
          </div>
          <div class="icon">
            <i class="fa fa-male"></i>
          </div>
          <a href="<?=base_url().'Mitra'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              <?=$this->db->count_all_results("product")?>
            </h3>
            <p>Product</p>
          </div>
          <div class="icon">
            <i class="fa fa-product-hunt"></i>
          </div>
          <a href="<?=base_url().'Product'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
              <?=$this->db->count_all_results("info")?>
            </h3>
            <p>Info</p>
          </div>
          <div class="icon">
            <i class="fa fa-info"></i>
          </div>
          <a href="<?=base_url().'Info'?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>


    </div>
    <div class="row">
      <div class="col-md-6 col-xs-12">
        <div class="panel panel-default table-responsive">
          <div class="panel-heading">
            <ul class="nav nav-pills ranges">
              <li class="active"><a href="#" data-range='1'>1 Days</a></li>
              <li class="#"><a href="#" data-range='7'>7 Days</a></li>
              <li><a href="#" data-range='30'>30 Days</a></li>
              <li><a href="#" data-range='60'>60 Days</a></li>
              <li><a href="#" data-range='90'>90 Days</a></li>
            </ul>
          </div>
          <div class="panel-body">
            <div id="stats-container"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Area
          </div>
          <div class="panel-body">
            <div class="chart tab-pane " id="line" style="position: relative; height: 300px;"></div>
          </div>

        </div>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">



    </div>


  </section>
  <?php } ?>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('include/footer'); ?>

<script>
  $(function () {
    // Create a function that will handle AJAX requests
    function requestData(days, chart) {
      $.ajax({
        type: "GET",
        url: "<?=base_url().'Dashboard/getDataVisitor'?>", // This is the URL to the API
        data: { days: days }
      })
        .done(function (data) {
          // When the response to the AJAX request comes back render the chart with new data
          chart.setData(JSON.parse(data));
        })
        .fail(function () {
          // If there is no communication between the server, show an error
          alert("error occured");
        });
    }

    var chart = Morris.Bar({
      // ID of the element in which to draw the chart.
      element: 'stats-container',
      // Set initial data (ideally you would provide an array of default data)
      data: [0, 0],
      xkey: 'date',
      ykeys: ['value'],
      labels: ['Users']
    });
    // Request initial data for the past 7 days:
    requestData(7, chart);
    $('ul.ranges a').click(function (e) {
      e.preventDefault();
      // Get the number of days from the data attribute
      var el = $(this);
      days = el.attr('data-range');
      // Request the data and render the chart using our handy function
      requestData(days, chart);
      // Make things pretty to show which button/tab the user clicked
      el.parent().addClass('active');
      el.parent().siblings().removeClass('active');
    })
  });
</script>

<script>
  $.getJSON("<?php echo base_url('Dashboard/data'); ?>", function (json) {

    var line = new Morris.Area({
      // ID of the element in which to draw the chart.
      element: 'line',
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: json,
      // The name of the data record attribute that contains x-values.
      xkey: 'label',

      // A list of names of data record attributes that contain y-values.
      ykeys: ['value'],

      // Labels for the ykeys -- will be displayed when you hover over the
      // chart.
      labels: ['User'],
      dateFormat: function (x) {
        var d = new Date(x).toString().split(" ");
        return d[2] + "/" + d[1] + "/" + d[3];
      }


    });

  });
</script>