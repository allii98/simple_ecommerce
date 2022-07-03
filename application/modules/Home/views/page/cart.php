 <!-- Cart Items -->
 <div class="container cart">
     <table>
         <tr>
             <th>Product</th>
             <th>Quantity</th>
             <th>Subtotal</th>
         </tr>
         <?php
            $jum_totbay = 0;
            foreach ($isi as $d) {
                $jumlah_qty = $d['harga'] * $d['qty'];
            ?>
         <tr>
             <td>
                 <div class="cart-info">
                     <img src="<?= $d['gambar'] ?>" alt="" />
                     <div>
                         <p><?= $d['nama_product'] ?></p>
                         <input type="hidden" name="hrg" id="hrg_<?= $d['id_product'] ?>" value="<?= $d['harga'] ?>">
                         <span>Price: $<?= $d['harga'] ?></span> <br />

                     </div>
                 </div>
             </td>
             <td><input type="hidden" id="qty_<?= $d['id_product'] ?>" value="<?= $d['qty'] ?>" />
                 <span><?= $d['qty'] ?></span>
             </td>
             <td><span id="subtotal_<?= $d['id_product'] ?>"><?= $jumlah_qty ?></span></td>
         </tr>
         <?php
                $jum_totbay += $jumlah_qty;
            }
            ?>

     </table>
     <div class="total-price">
         <table>
             <tr>
                 <td>Total</td>
                 <td>$<?= $jum_totbay ?></td>
             </tr>
         </table>
         <a href="#" class="checkout btn">Proceed To Checkout</a>
     </div>
 </div>