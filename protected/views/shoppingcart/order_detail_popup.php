<div class="container_popup">
    <table class="table">
        <tr>
            <th>STT</th>
            <th>Name</th>
            <th>Image</th>
            <th style="text-align: right;">Price</th>
            <th style="text-align: right;">Quantity</th>
            <th style="text-align: right;">Total</th>
        </tr>
        <?php foreach($products as $index => $product): ?>
            <tr>
                <td><?php echo ($index + 1) ?></td>
                <td><?php echo $product->title ?></td>
                <td><img height="60" src="<?php echo $product->thumbnail ?>"/></td>
                <td style="text-align: right;"><?php echo Helper::formatCurrency($product->price).' '. $product->currency ?></td>
                <td style="text-align: right;"><?php echo $product->quantity ?></td>
                <td style="text-align: right;"><?php echo Helper::formatCurrency($product->total).' '. $product->currency ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>