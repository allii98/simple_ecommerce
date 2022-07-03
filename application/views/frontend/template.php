<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css"
        integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/styles.css" />
    <title>Safari Store</title>
</head>

<body>
    <!-- Navigation -->

    <div class="top-nav">
        <div class="container d-flex">
            <p>Simple Project Test Taman Safari Indonesia </p>
        </div>
    </div>
    <div class="navigation">
        <div class="nav-center container d-flex">
            <a href="<?= base_url('Home') ?>" class="logo">
                <h1>Safari store</h1>
            </a>

            <ul class="nav-list d-flex">
                <li class="nav-item">
                    <a href="<?= base_url('Home') ?>" class="nav-link">Home</a>
                </li>
                <li class="icons d-flex">
                    <a href="<?= base_url('Login') ?>" class="icon">
                        <i class="bx bx-user"></i>
                    </a>
                    <?php if ($this->session->userdata('userlogin')) { ?>
                    <a href="<?= base_url('Login/logout') ?>" class="icon">
                        <i class="bx bx-log-out"></i>
                    </a>
                    <?php } ?>
                    <a href="<?= base_url('Home/cart') ?>" class="icon">
                        <i class="bx bx-cart"></i>
                        <span class="d-flex" id="cart1"></span>
                    </a>
                </li>
            </ul>

            <div class="icons d-flex">
                <a href="<?= base_url('Login') ?>" class="icon">
                    <i class="bx bx-user"></i>
                </a>
                <?php if ($this->session->userdata('userlogin')) { ?>
                <a href="<?= base_url('Login/logout') ?>" class="icon">
                    <i class="bx bx-log-out"></i>
                </a>
                <?php } ?>
                <a href="<?= base_url('Home/cart') ?>" class="icon">
                    <i class="bx bx-cart"></i>
                    <span class="d-flex" id="cart2"></span>
                </a>
            </div>

            <div class="hamburger">
                <i class="bx bx-menu-alt-left"></i>
            </div>
        </div>
    </div>
    <hr>
    <script src="<?php echo base_url() ?>assets/back/vendors/jquery/dist/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
        integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </script>
    <?php if (!empty($js) || $js != '') : echo $this->load->view('js/' . $js . '.php');
    endif; ?>

    <?php echo $contents ?>
    <!-- Footer -->
    <footer class="footer">
        <div class="row">
            <div class="col d-flex">
                <h4>INFORMATION</h4>
                <a href="">About us</a>
                <a href="">Contact Us</a>
                <a href="">Term & Conditions</a>
                <a href="">Shipping Guide</a>
            </div>
            <div class="col d-flex">
                <h4>USEFUL LINK</h4>
                <a href="">Online Store</a>
                <a href="">Customer Services</a>
                <a href="">Promotion</a>
                <a href="">Top Brands</a>
            </div>
            <div class="col d-flex">
                <span><i class="bx bxl-facebook-square"></i></span>
                <span><i class="bx bxl-instagram-alt"></i></span>
                <span><i class="bx bxl-github"></i></span>
                <span><i class="bx bxl-twitter"></i></span>
                <span><i class="bx bxl-pinterest"></i></span>
            </div>
        </div>
    </footer>
    <!-- Custom Script -->
    <script src="<?php echo base_url() ?>assets/front/js/index.js"></script>
    <script>
    $(document).ready(function() {
        get_total_cart();
    });


    function get_total_cart() {
        var id = '<?php echo $this->session->userdata('id_user') ?>';
        $.ajax({
            url: '<?php echo base_url('Home/get_total_cart') ?>',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                $('#cart1').html(data);
                $('#cart2').html(data);
            }
        });
    }
    </script>
</body>

</html>