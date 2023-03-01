function viewOrder()
{
	statusList = window.document.frmOrderList.cboOrderStatus;
	status     = statusList.options[statusList.selectedIndex].value;	
	
	if (status != '') {
		window.location.href = 'index.php?manager=shop&status=' + status;
	} else {
		window.location.href = 'index.php?manager=shop';
	}
}

function modifyOrderStatus(orderId)
{
	statusList = window.document.frmOrder.cboOrderStatus;
	status     = statusList.options[statusList.selectedIndex].value;
	window.location.href = 'index.php?manager=shop&action=detail&oid=' + orderId + '&status=' + status;
// /index.php?manager=shop&action=detail&oid=1
//	window.location.href = 'processOrder.php?action=modify&oid=' + orderId + '&status=' + status;
}

function deleteOrder(orderId)
{

}