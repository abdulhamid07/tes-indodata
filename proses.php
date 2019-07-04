<?php
if(isset($_POST['submit'])){
		require_once 'api_interface.php';
		require_once 'db_operation.php';

		$params['trx_date'] = date("YmdHis");
		$params['trx_id'] = 10;
		$params['trx_type'] = '2100'; // 2100 = Inquiry, 2200 = Payment
		$params['cust_msisdn'] = '';
		$params['cust_account_no'] = $_POST['idpelanggan'];;
		$params['product_id'] = '100';
		$params['product_nomination'] = '';
		$params['periode_payment'] = '';
		$params['unsold'] = '';
		$input = json_encode($params, true);
		//$params = $_POST['idpelanggan'];
		
		$interface = new ApiInterface();
		$output = $interface->hitApi($params);

		//print_r($output);

		$parse = json_decode($output, true);
		$data = $parse['data']['trx'];
		$rc = $data['rc'];


		if ($rc == '0000') {
			echo "<fieldset style='width:250px'>";
			echo "ID Pelanggan : " . $data['subscriber_id'] . "<br />";
			echo "Nama Pelanggan : " . $data['subscriber_name']."<br/>";
			echo "Daya / Golongan : " . $data['power']."/".$data['subscriber_segmentation']."<br/>";

			echo "<p><a style='float:right' href='index.php'><button type='submit'>Kembali</button></a></p>";
			echo "</fieldset>";

		} else {
			echo "<fieldset style='width:250px'>";
			echo "Transaction ID : " . $data['trx_id'] . "<br />";
			echo "Response Code (RC) : " . $rc . "<br />";
			echo "Description : " . $data['desc'];

			echo "<p><a style='float:right' href='index.php'><button type='submit'>Kembali</button></a></p>";
			echo "</fieldset>";
		}

	}
?>