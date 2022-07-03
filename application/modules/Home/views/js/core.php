<script type="text/javascript">
$(document).ready(function() {
    console.log("oke siap");

});


function cekLogin(id) {
    var login = '<?= $this->session->userdata('userlogin') ?>';
    if (!login) {
        alert("Silahkan login terlebih dahulu");
        window.location.href = "<?= base_url('Login') ?>";
    } else {
        add_cart(id);
    }
}

function add_cart(id) {
    $.ajax({
        url: "<?php echo base_url('Home/add_cart') ?>",
        type: "POST",
        data: {
            id: id
        },
        dataType: "JSON",
        success: function(data) {
            get_total_cart();
            $.toast({
                heading: 'Success',
                text: 'Berhasil ditambahkan ke keranjang',
                icon: 'success',
                position: 'top-right',
                loader: false,
                hideAfter: 3000,
                stack: false
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });
}

function jumlah_qty(id) {
    var qty = $('#qty_' + id).val();
    var hrg = $('#hrg_' + id).val();

    var ttl = parseFloat(hrg) * parseFloat(qty);
    if (isNaN(ttl)) {
        var total = hrg;
    } else {
        var total = ttl;
    }
    $('#subtotal_' + id).html(total);
    // console.log(total);
}
</script>