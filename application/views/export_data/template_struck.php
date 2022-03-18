<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Receipt</title>
    <style type="text/css">

       * {
        font-size: 12px;
        font-family: 'Times New Roman';
    }

    td,
    th,
    tr,
    table {
        border-top: 1px solid black;
        border-collapse: collapse;
    }

    td.description,
    th.description {
        width: 85px;
        max-width: 85px;
    }

    td.quantity,
    th.quantity {
        width: 40px;
        max-width: 40px;
        word-break: break-all;
    }

    td.price,
    th.price {
        width: 70px;
        max-width: 70px;
        word-break: break-all;
    }

    .centered {
        text-align: center;
        align-content: center;
    }

    .ticket {
        width: 165px;
        max-width: 165px;
    }

    img {
        max-width: inherit;
        width: inherit;
    }

    @media print {
        .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }   
</style>
</head>
<body>
    <div class="ticket">
        <img src="<?php echo base_url('asset/img/uploads/banner/').$logo->image; ?>" alt="Logo">
        <p class="centered"><?php echo $profile->companyName;?>
            <br><?php echo $profile->address1;?>
        </p>
            <table>
                <thead>
                    <tr>
                        <th class="quantity">Q.</th>
                        <th class="description">Description</th>
                        <th class="price">Rp.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detailorder as $value) {?>
                    <tr>
                        <td class="quantity"><?php echo $value->productQty;?></td>
                        <td class="description"><?php echo $value->productName;?></td>
                        <td class="price"><?php echo number_format($value->productPrice);?></td>
                    </tr>

                    <?php } ?>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">Subtotal</td>
                        <td class="price"><?php echo number_format($orderresult->cartTotal);?></td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">Shiping</td>
                        <td class="price"><?php echo number_format($orderresult->totalShiping);?></td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description">Discount</td>
                        <td class="price"><?php echo number_format($orderresult->discountPrice);?></td>
                    </tr> <tr>
                        <td class="quantity"></td>
                        <td class="description">Ppn <?php echo $profile->taxProduct;?> %</td>
                        <td class="price"><?php echo number_format($orderresult->tax);?></td>
                    </tr>
                    <tr>
                        <td class="quantity"></td>
                        <td class="description"><b>TOTAL</b></td>
                        <td class="price"><b><?php echo number_format($orderresult->orderSumary);?></b></td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">Thanks for your purchase!
            </p>
            </div>
            <button id="btnPrint" class="hidden-print" onclick="window.print();">Print</button>
        </body>
        </html>