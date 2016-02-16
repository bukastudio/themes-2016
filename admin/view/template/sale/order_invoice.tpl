<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>" xml:lang="<?php echo $language; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/label.css" />
</head>
<body>
	<?php foreach ($orders as $order) { ?>
		<div style="page-break-after: always;">


			<table class="store" style="border:none;">
				<tbody>
					<tr>
						<td width="50%">
							<table>
								<tbody>
									<tr>
										<td colspan="2">
											<h1 style="font-size:3em;line-height:1em;text-transform: uppercase;">
												<span style="font-weight:300"><?php echo $text_invoice; ?></span><br />
												<?php if ($order['invoice_no']) { ?>
													<small style=" font-size: .45em;background-color: black;color: white;padding: 5px;">#<?php echo $order['invoice_no']; ?></small>
												<?php } ?>
											</h1>
										</td>
									</tr>
									<tr>
										<td><strong><?php echo $text_date_added; ?></strong></td>
										<td><?php echo $order['date_added']; ?></td>
									</tr>
									<tr>
										<td><strong><?php echo $text_order_id; ?></strong></td>
										<td><?php echo $order['order_id']; ?></td>
									</tr>
									<tr>
										<td><strong><?php echo $text_payment_method; ?></strong></td>
										<td class="no-image"><?php echo $order['payment_method']; ?></td>
									</tr>
									<?php if ($order['shipping_method']) { ?>
										<tr>
											<td><strong><?php echo $text_shipping_method; ?></strong></td>
											<td><?php echo $order['shipping_method']; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
						<td width="50%" align="right" >
							<img style="max-width:300px; height:auto" src="<?php echo $order['logo']; ?>" title="Logo" alt="Logo" />
						</td>
					</tr>
				</tbody>
			</table>

			<table class="address">
				<thead>
					<tr>
						<td width="33%"><b>From</b></td>
						<td width="33%"><b>To</b></td>
						<td width="33%"><b>Ship To</span></b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<strong><?php echo $order['store_name']; ?></strong><br />
							<?php echo $order['store_address']; ?><br />
							Phone: <?php echo $order['store_telephone']; ?><br />
							<?php if ($order['store_fax']) { ?>
								<?php echo $text_fax; ?> <?php echo $order['store_fax']; ?><br />
							<?php } ?>
							<?php echo $order['store_email']; ?><br />
							<?php echo $order['store_url']; ?>
						</td>
						<td class="upper">
							<?php echo $order['payment_address']; ?><br/>
							<?php echo $order['email']; ?><br/>
							Phone: <?php echo $order['telephone']; ?>
							<?php if ($order['payment_company_id']) { ?>
								<br/>
								<br/>
								<?php echo $text_company_id; ?> <?php echo $order['payment_company_id']; ?>
							<?php } ?>
							<?php if ($order['payment_tax_id']) { ?>
								<br/>
								<?php echo $text_tax_id; ?> <?php echo $order['payment_tax_id']; ?>
							<?php } ?>
						</td>
						<td class="upper"><?php echo $order['shipping_address']; ?></td>
					</tr>
				</tbody>
			</table>

			<table class="product">
				<thead>
					<tr>
						<td><?php echo $column_product; ?></td>
						<td><?php echo $column_model; ?></td>
						<td align="right"><?php echo $column_quantity; ?></td>
						<td align="right"><?php echo $column_price; ?></td>
						<td align="right"><?php echo $column_total; ?></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($order['product'] as $product) { ?>
						<tr>
							<td><?php echo $product['name']; ?>
								<?php foreach ($product['option'] as $option) { ?><br />
									&nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
								<?php } ?>
							</td>
							<td><?php echo $product['model']; ?></td>
							<td align="right"><?php echo $product['quantity']; ?></td>
							<td align="right"><?php echo $product['price']; ?></td>
							<td align="right"><?php echo $product['total']; ?></td>
						</tr>
					<?php } ?>
					<?php foreach ($order['voucher'] as $voucher) { ?>
						<tr>
							<td><?php echo $voucher['description']; ?></td>
							<td></td>
							<td align="right">1</td>
							<td align="right"><?php echo $voucher['amount']; ?></td>
							<td align="right"><?php echo $voucher['amount']; ?></td>
						</tr>
					<?php } ?>
					<?php foreach ($order['total'] as $total) { ?>
						<tr>
							<td class="total" align="right" colspan="4"><strong><?php echo $total['title']; ?>:</strong></td>
							<td class="total" align="right"><strong><?php echo $total['text']; ?></strong></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<?php if ($order['comment']) { ?>
				<table class="comment">
					<thead>
						<tr>
							<td><strong><?php echo $column_comment; ?></strong></td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $order['comment']; ?></td>
						</tr>
					</tbody>
				</table>
			<?php } ?>

			<table class="footer">
				<tr>
					<td>

								<p>"Thank you for shopping with us... Hope to see you soon..."</p>

					</td>
				</tr>
			</table>

		</div>
	<?php } ?>
</body>
</html>