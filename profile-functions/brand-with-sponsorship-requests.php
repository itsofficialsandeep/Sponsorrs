<?php
session_start();

include_once("../misc/db.php");
include_once("../misc/config.php");
include_once("../misc/functions.php");

include_once("../pay/razorpay-php/Razorpay.php");

use Razorpay\Api\Errors\SignatureVerificationError;
use Razorpay\Api\Api;

// actionType 1 => creating Order
// actionType 2 => stroing order in server
// actionType 3 => creating payment
// actionType 4 => storing payment in server

$paymentSuccess = false;


if (isset($_POST['search_result_type'])) {
	$searchResultType = $_POST['search_result_type'];

	// search result type '1' means 
	// http://localhost/t/Sponsorrs/c/channel-profile.php?page=all_sponsorships
	// latest sponsorships
	if ($searchResultType == 1) {
		$currentUser = $_SESSION['currentUser'];
		$total = 20;
		$from = $_POST['from'];
		$from = (int) $from;

		if ($_POST['filter'] == 1) {
			$sql = "SELECT apply_sponsorships.id_apply, sponsorships.offer_price, apply_sponsorships.id_sponsorship, owned_by,id, snippettitle,snippetthumbnailsdefaulturl, snippetdescription,  
							statisticssubscriberCount, channel_type, owned_by 
					FROM apply_sponsorships 
					LEFT JOIN channel_detail 
					ON channel_detail.owned_by=apply_sponsorships.id_user 
                    LEFT JOIN sponsorships 
                    ON apply_sponsorships.id_sponsorship = sponsorships.sponsorship_id
					WHERE apply_sponsorships.id_company='$currentUser'
					AND status=2
					ORDER BY statisticssubscriberCount
					DESC LIMIT $from,$total";

			// $sql = "SELECT apply_sponsorships.id_apply,owned_by,id, snippettitle,snippetthumbnailsdefaulturl, snippetdescription, 
			// 				statisticssubscriberCount, channel_type 
			// 		FROM apply_sponsorships 
			// 		LEFT JOIN channel_detail 
			// 		ON channel_detail.owned_by=apply_sponsorships.id_user 
			// 		WHERE id_company='$currentUser'
			// 		AND status=2
			// 		ORDER BY statisticssubscriberCount 
			// 		DESC LIMIT $from,$total";
		}

		if ($result = $conn->query($sql)) {
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$id_sponsorship = $row['id_sponsorship'];
					$owned_by = $row['owned_by'];
					$offer_price = $row['offer_price'];
					$snippettitle = $row['snippettitle'];
					$snippetdescription = $row['snippetdescription'];
					$id = $row['id'];
					$channel_type = $row['channel_type'];
					$statisticssubscriberCount = $row['statisticssubscriberCount'];
					$snippetthumbnailsdefaulturl = $row['snippetthumbnailsdefaulturl'];
					$apply_id = $row['id_apply'];
					$action = "";

					// if ($status == 0) {
					// 	$statusBadge = "Rejected";
					// 	$badgeColor = "bg-danger text-danger";
					// }
					// if ($status == 1) {
					// 	$statusBadge = "Accepted";
					// 	$badgeColor = "bg-success text-success";
					// }
					// if ($status == 2) {
					// 	$statusBadge = "Sent";
					// 	$badgeColor = "bg-warning text-warning";
					// 	$action = '<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value,' . $id_apply . ')" value="#' . $id_apply . '" ><i class="fas fa-fw fa-times"></i></button>';
					// }

					echo '<tr data-pages="' . $from . '" id="' . $owned_by . '">
							<!-- Course item -->
							<td>
								<div class="d-flex align-items-center">
									<!-- Image -->
									<div class="w-60px">
										<img src="' . $snippetthumbnailsdefaulturl . '" class="rounded" alt="">
									</div>
									<div class="mb-0 ms-2">
										<!-- Title -->
										<h6><a href="#">' . substr(
							$snippettitle
							,
							0,
							15
						) . '</a></h6>
									</div>
								</div>
							</td>
							<td>
								' . substr($snippetdescription, 0, 50) . '
							</td>
							<!-- Enrolled item -->
							<td class="text-center text-sm-start">' . $channel_type . '</td>

							<td>
								' . $statisticssubscriberCount . '
							</td>
							<td>
								<button class="acceptRequest btn btn-sm btn-success-soft btn-round mb-0 " onclick="addRequestt(this.value,this)" data-sponsorshipapplyid="' . $apply_id . '" data-desc="' . $snippetdescription . '" data-logo="' . $snippetthumbnailsdefaulturl . '" data-to="' . $owned_by . '" data-from="' . $currentUser . '" data-sponsorshipId="' . $id_sponsorship . '" data-name="' . $snippettitle . '" data-amount="' . $offer_price . '" data-sponsorship="' . $apply_id . '"  value="#' . $owned_by . '"  title="Accept"><i class="bi bi-plus-circle-fill fs-6"></i></button>
								<button class="btn btn-sm btn-danger-soft btn-round mb-0 deleteSponsorshipButton" onclick="deleteRequest(this.value,this)" data-sponsorship="' . $apply_id . '"  value="#' . $apply_id . '"  title="Reject"><i class="bi bi-trash3-fill fs-6"></i></button>							</td>

						</tr>';
				}
			} else {
				echo "0";
			}
		} else {
			$_SESSION['script_error_code'] = "1001";
			//header("Location:../error-404.html");
		}
	}
}

if (isset($_POST['actionType']) && $_POST['actionType'] === "deleteApplication" && isset($_POST['applyId'])) {
	include_once("../misc/db.php");
	include_once("../misc/functions.php");

	$application_id = $_POST['applyId'];
	$application_id = trim($application_id, "#");

	deleteRequest($conn, $application_id);
}

// deletes the request of sponsorships
function deleteRequest($conn, $application_id)
{
	$sql = "UPDATE apply_sponsorships SET status=0 WHERE id_apply ='$application_id'";

	if ($conn->query($sql)) {
		$message = new message(200, "success", "Sucessfully deleted" . $sql);
		$message->printMessage();
	} else {
		$message = new message(400, "failed", "Sponsorship not deleted");
		$message->printMessage();
	}
}

if (isset($_POST['actionType']) && $_POST['actionType'] === "addApplication" && isset($_POST['applyId'])) {
	include_once("../misc/db.php");
	include_once("../misc/functions.php");

	$application_id = $_POST['applyId'];
	$application_id = trim($application_id, "#");

	addRequest($conn, $application_id);
}

// deletes the request of sponsorships
function addRequest($conn, $application_id)
{
	$sql = "UPDATE apply_sponsorships SET status=1 WHERE id_apply ='$application_id'";
	$conn->query($sql);
	if (mysqli_affected_rows($conn) == 1) {
		return true;
	} else {
		return false;
	}
}

if (isset($_POST['actionType']) && $_POST['actionType'] == 'createOrder') {

	$ac_to = $_POST['to'];
	$ac_from = $_POST['from'];
	$sponsorship_id = $_POST['sponsorshipId'];

	$amount = (int) $_POST['amount'];
	//    $currency = $_POST['currency'];
	//    $description = $_POST['description'];

	$razorpay = new Api($razorPayKey, $razorPaySecret);

	$order = $razorpay->order->create(array('receipt' => 'sample_receipt', 'amount' => $amount, 'currency' => 'INR', 'notes' => array('ac_from' => $ac_from, 'ac_to' => $ac_to, 'sponsorship_id' => ".$sponsorship_id.")));

	if (isset($order->id)) {
		echo '{"code":200,"status":"success","order_id":"' . $order->id . '"}';
	} else {
		echo '{"code":400,"status":"failed"}';
	}
}

if (isset($_POST['actionType']) && $_POST['actionType'] == 'preparePayement') {
	if (!empty($_POST['razorpay_payment_id'])) {

		$razorpay = new Api($razorPayKey, $razorPaySecret);

		try {
			$razorpay_order_id = $_POST['razorpay_order_id'];
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
			$razorpay_signature = $_POST['razorpay_signature'];
			// $attributes = array(
			// 	'razorpay_order_id' => $_POST['razorpay_order_id'],
			// 	'razorpay_payment_id' => $_POST['razorpay_payment_id'],
			// 	'razorpay_signature' => $_POST['razorpay_signature']
			// );

			$generated_signature = hash_hmac("sha256", $razorpay_order_id . "|" . $razorpay_payment_id, $razorPaySecret);

			if ($generated_signature == $razorpay_signature) {
				$paymentSuccess = true;
			} else {
				$paymentSuccess = false;
			}

			// $signature = $razorpay->utility->verifyPaymentSignature($attributes);

			// print_r($signature);

		} catch (SignatureVerificationError $e) {
			$paymentSuccess = false;
			$error = 'Razorpay Error : ' . $e->getMessage();
		}
	}

	// payment has been successfully done
	// store the payment information in the DB

	if ($paymentSuccess === true) {
		$razorpay_order_id = $_POST['razorpay_order_id'];
		$razorpay_payment_id = $_POST['razorpay_payment_id'];
		$razorpay_signature = $_POST['razorpay_signature'];
		$ac_to = $_POST['to'];
		$ac_from = $_POST['from'];
		$sponsorship_id = $_POST['sponsorshipId'];
		$email = $_SESSION['currentEmail'];
		$razorpay_ac_id = "-";
		$sponsorshipapplyid = $_POST['sponsorshipapplyid'];

		// store only successful and minimal payment information
		$successful_payments = $conn->prepare("INSERT INTO `successful_payments`(`ac_from`, `ac_to`, `razorpay_payment_id`, `razorpay_order_id`, 
                                                        `razorpay_signature`, `sponsorship_id`, `razorpay_ac_id`)
                VALUES(?,?,?,?,?,?,?)");

		$successful_payments->bind_param(
			"sssssss",
			$ac_from,
			$ac_to,
			$razorpay_payment_id,
			$razorpay_order_id,
			$razorpay_signature,
			$sponsorship_id,

			// this ac id is unrecognized for what it belongs to
			$razorpay_ac_id // $razorpay_ac_id
		);

		// get order details from order id
		$orderDetail = $razorpay->order->fetch($razorpay_order_id);

		$orderDetailID = $orderDetail->id;
		$orderDetailentity = $orderDetail->entity;
		$orderDetailamount = $orderDetail->amount;
		$orderDetailamountPaid = $orderDetail->amount_paid; // Undefined array key \"amountPaid\" in <b>C:\\xampp\\sponsorrs\\pay\\razorpay-php\\src\\Resource.php</b> on line <b>45</b><br /> 
		// so not using variable
		$orderDetailamountDue = $orderDetail->amount_due;
		$orderDetailcurrency = $orderDetail->currency;
		$orderDetailreceipt = $orderDetail->receipt;
		$orderDetailofferId = $orderDetail->offer_id;
		$orderDetailstatus = $orderDetail->status;
		$orderDetailattempts = $orderDetail->attempts;
		$orderDetailnotes = '-';
		$orderDetailJSON = json_encode(print_r($orderDetail, true));
		$orderDetailcreatedAt = $orderDetail->created_at;

		// collect & store the order information
		$order_before_payments = $conn->prepare("INSERT INTO `order_before_payments` (`email_id`, `order_from_primary_ac_id`, 
		        `order_to_primary_ac_id`, `order_id`, `sponsorship_id`,`sponsorship_apply_id`, `entity`, `amount`, `amount_paid`, 
		        `amount_due`, `currency`, `receipt`, `offer_id`, `status`, `attempts`, `notes`,`order_json`, `created_at`) 
		        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

		$order_before_payments->bind_param(
			"sssssssiiissssissi",
			$email,
			$ac_from,
			$ac_to,
			$orderDetailID,
			$sponsorship_id,
			$sponsorshipapplyid,
			$orderDetailentity,
			$orderDetailamount,
			$orderDetailamountPaid,
			$orderDetailamountDue,
			$orderDetailcurrency,
			$orderDetailreceipt,
			$orderDetailofferId,
			$orderDetailstatus,
			$orderDetailattempts,
			$orderDetailnotes,
			$orderDetailJSON,
			$orderDetailcreatedAt
		);

		// collect and store payment information leted to above fetched order-id
		$razorpay = new Api($razorPayKey, $razorPaySecret);

		$pmntResponse = $razorpay->order->fetch($razorpay_order_id)->payments();
		$paymentCount = $pmntResponse->count;

		for ($i = 0; $i < $paymentCount; $i++) {

			$pmntResponseId = $pmntResponse->items[$i]->id;
			$pmntResponseEntity = $pmntResponse->items[$i]->entity;
			$pmntResponseAmount = $pmntResponse->items[$i]->amount;
			$pmntResponseCurrency = $pmntResponse->items[$i]->currency;
			$pmntResponseStatus = $pmntResponse->items[$i]->status;
			$pmntResponseOrderid = $pmntResponse->items[$i]->order_id;
			$pmntResponseInvoiceId = $pmntResponse->items[$i]->invoice_id;
			$pmntResponseInternational = $pmntResponse->items[$i]->international;
			$pmntResponseMethod = $pmntResponse->items[$i]->method;
			$pmntResponseAmountRefunded = $pmntResponse->items[$i]->amount_refunded;
			$pmntResponseRefundStatus = $pmntResponse->items[$i]->refund_status;
			$pmntResponseCaptured = $pmntResponse->items[$i]->captured;
			$pmntResponseDescription = $pmntResponse->items[$i]->description;
			$pmntResponseCardId = $pmntResponse->items[$i]->card_id;
			$pmntResponseBank = $pmntResponse->items[$i]->bank;
			$pmntResponseWallet = $pmntResponse->items[$i]->wallet;
			$pmntResponseVPA = $pmntResponse->items[$i]->vpa;
			$pmntResponseEmail = $pmntResponse->items[$i]->email;
			$pmntResponseContact = $pmntResponse->items[$i]->contact;
			$pmntResponseFee = $pmntResponse->items[$i]->fee;
			$pmntResponseTax = $pmntResponse->items[$i]->tax;
			$pmntResponseErrorCode = $pmntResponse->items[$i]->error_code;
			$pmntResponseErrorDesc = $pmntResponse->items[$i]->error_description;
			$pmntResponseBankTxnId = '-'; // $pmntResponse->items[$i]->bank_transaction_id;
			$pmntResponseCreatedAt = $pmntResponse->items[$i]->created_at;
			$pmntResponseJSON = json_encode(print_r($pmntResponse->items[$i], true));

			$sqlPaymentDetail = $conn->prepare("INSERT INTO `payment_details`(`payment_from_ac_id`, `payment_to_ac_id`, `sponsorship_id`, 
		        `id`, `entity`, `amount`, `currency`, `status`, `order_id`, `invoice_id`, `international`, `method`, `amount_refunded`, 
		        `refund_status`, `captured`, `description`, `card_id`, `bank`, `wallet`, `vpa`, `email`, `contact`, `fee`, `tax`, 
		        `error_code`, `error_description`, `bank_transaction_id`, `created_at`,`payment_json`) 
		        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

			$sqlPaymentDetail->bind_param(
				"sssssissssssisissssssiiisssis",
				$ac_from,
				$ac_to,
				$sponsorship_id,
				$pmntResponseId,
				$pmntResponseEntity,
				$pmntResponseAmount,
				$pmntResponseCurrency,
				$pmntResponseStatus,
				$pmntResponseOrderId,
				$pmntResponseInvoiceId,
				$pmntResponseInternational,
				$pmntResponseMethod,
				$pmntResponseAmountRefunded,
				$pmntResponseRefundStatus,
				$pmntResponseCaptured,
				$pmntResponseDescription,
				$pmntResponseCardId,
				$pmntResponseBank,
				$pmntResponseWallet,
				$pmntResponseVPA,
				$pmntResponseEmail,
				$pmntResponseContact,
				$pmntResponseFee,
				$pmntResponseTax,
				$pmntResponseErrorCode,
				$pmntResponseErrorDesc,
				$pmntResponseBankTxnId,
				$pmntResponseCreatedAt,
				$pmntResponseJSON
			);
		}

		// execute all sql statements
		$successful_payments->execute();
		$order_before_payments->execute();
		$sqlPaymentDetail->execute();

		// check if recored inserted into tables
		if ($sqlPaymentDetail->affected_rows > 0 && $successful_payments->affected_rows > 0 && $order_before_payments->affected_rows > 0) {

			// add the Creator to client list as payment has been added
			if (addRequest($conn, $sponsorshipapplyid)) {
				$message = new message(200, "success", "Successfully added details!");
				$message->printMessage();
			} else {
				$message = new message(400, "failed", "Something went wrong. Please try again");
				$message->printMessage();
			}

		} else {
			$message = new message(400, "failed", "Something went wrong. Please try again");
			$message->printMessage();
		}

		// show the success message
		// $message = new message(200, "success", "Payment Successfull");
		// $message->printMessage();
	} else {
		echo '{"code":400,"status":"failed","message":"For some reason, payment has failed"}';
	}

	//   {"razorpay_payment_id":"pay_LKBPc5rVuF5nc0","razorpay_order_id":"order_LKBPLto9lvmlu6","razorpay_signature":"5904e994de6f6010ee9a66b65008cb89904e92d66bf1ab1574d1e66ba8f64010"}

}

?>