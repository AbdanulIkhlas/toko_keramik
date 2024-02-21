<footer class="site-footer">
    <div class="text-center">
        <!-- Penjualan Kayu dan Keramik -->
        Sistem Informasi Penjualan Kayu dan Keramik |
        <!-- Oleh UD ABC Salatiga Berbasis Website -->
        By <a href="#" style="color:yellow;font-weight:700;" target="_blank">UD ABC Salatiga Berbasis Website</a>
        <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
        </a>
    </div>
</footer>

<!-- JavaScript -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="assets/js/jquery.sparkline.js"></script>
<script src="assets/datatables/jquery.dataTables.min.js"></script>
<script src="assets/datatables/dataTables.bootstrap.min.js"></script>
<script src="assets/js/common-scripts.js"></script>
<script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="assets/js/gritter-conf.js"></script>
<script src="assets/js/sparkline-chart.js"></script>
<script src="assets/js/zabuto_calendar.js"></script>

<script type="text/javascript">
    // DataTable initialization
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable();
    });

    // Notification untuk stok barang
    <?php
    $sql = "select * from barang where stok <= 3";
    $row = $config->prepare($sql);
    $row->execute();
    $q = $row->fetch();
    if ($q['stok'] <= 3) {
    ?>
        $(document).ready(function () {
            var unique_id = $.gritter.add({
                title: 'Peringatan !',
                text: 'Stok barang tersisa kurang dari 3, silakan pesan lagi!',
                image: 'assets/img/seru.png',
                sticky: true,
                time: '',
                class_name: 'my-sticky-class'
            });
            return false;
        });
    <?php } ?>
</script>

<script type="application/javascript">
    // Calendar initialization
    $(document).ready(function () {
        $("#date-popover").popover({
            html: true,
            trigger: "manual"
        });
        $("#date-popover").hide();
        $("#date-popover").click(function (e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function () {
                return myDateFunction(this.id, false);
            },
            action_nav: function () {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "",
                modal: true
            },
            legend: []
        });
    });

    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }

    // Alert tampil setelah document ready
    $(document).ready(function () {
        setTimeout(function () {
            $(".alert-danger").fadeIn('slow');
        }, 500);
    });
    // Alert hilang setelah beberapa detik
    setTimeout(function () {
        $(".alert-danger").fadeOut('slow');
    }, 5000);

    $(document).ready(function () {
        setTimeout(function () {
            $(".alert-success").fadeIn('slow');
        }, 500);
    });
    setTimeout(function () {
        $(".alert-success").fadeOut('slow');
    }, 5000);

    $(document).ready(function () {
        setTimeout(function () {
            $(".alert-warning").fadeIn('slow');
        }, 500);
    });
    setTimeout(function () {
        $(".alert-success").fadeOut('slow');
    }, 5000);
</script>

<script>
    // Modal JavaScript
    $(".modal-create").hide();
    $(".bg-shadow").hide();

    function clickModals() {
        $(".bg-shadow").fadeIn();
        $(".modal-create").fadeIn();
    }

    function cancelModals() {
        $('.modal-view').fadeIn();
        $(".modal-create").hide();
        $(".bg-shadow").hide();
    }
</script>
