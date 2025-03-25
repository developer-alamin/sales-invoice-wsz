@extends("layouts.app")
 @section('content')
 <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> {{  __('messages.order_create') }}
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>{{__('messages.overview')}} <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form id="invoiceForm">
                    <div class="row mb-3" >
                        <div class="col-4">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" name="customer_name">
                        </div>
                        <div class="col-4">
                            <label>Email</label>
                            <input type="email" class="form-control" name="customer_email">
                        </div>
                        <div class="col-4">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="customer_phone">
                        </div>
                    </div>
    
                    <!-- Product Table -->
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Rate</th>
                                <th>Amount</th>
                                <th><button type="button" class="btn btn-success addRow">+</button></th>
                            </tr>
                        </thead>
                        <tbody id="productTable">
                            <tr>
                                <td><input type="text" class="form-control product_name" name="product_name[]"></td>
                                <td><input type="number" class="form-control price" name="price[]" step="0.01"></td>
                                <td><input type="number" class="form-control rate" name="rate[]" step="0.01"></td>
                                <td><input type="number" class="form-control amount" name="amount[]" step="0.01" readonly></td>
                                <td><button type="button" class="btn btn-danger removeRow">-</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row gy-2">
                        <div class="col-3">
                            <label>Subtotal</label>
                            <input type="text" class="form-control" id="subtotal" readonly>
                        </div>
                        <div class="col-3">
                            <label>Discount (%) / Fixed</label>
                            <input type="text" class="form-control" id="discount">
                        </div>
                        <div class="col-3">
                            <label>Type</label>
                            <select class="form-select" id="discountType">
                                <option value="fixed">Fixed</option>
                                <option value="percent">%</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Tax (+/-)</label>
                            <input type="text" class="form-control" id="tax">
                        </div>
                        <div class="col-3">
                            <label>Type</label>
                            <select class="form-select" id="taxType">
                                <option value="plus">+</option>
                                <option value="minus">-</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Total</label>
                            <input type="text" class="form-control" id="total" readonly>
                        </div>
        
                        <!-- Payment Details -->
                        <div class="col-3">
                            <label>Advanced Payment</label>
                            <input type="text" class="form-control" id="advanced">
                        </div>
                        <div class="col-3">
                            <label>Pay</label>
                            <input type="text" class="form-control" id="pay">
                        </div>
                        <div class="col-3">
                            <label>Due</label>
                            <input type="text" class="form-control" id="due" readonly>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Generate Invoice</button>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
  </div>
 @endsection

 @push('scripts')
 <script>
    $(document).ready(function () {
    // Row Add
    $(".addRow").click(function () {
        let newRow = `<tr>
            <td><input type="text" class="form-control product_name" name="product_name[]"></td>
            <td><input type="number" class="form-control price" name="price[]" step="0.01"></td>
            <td><input type="number" class="form-control rate" name="rate[]" step="0.01"></td>
            <td><input type="number" class="form-control amount" name="amount[]" step="0.01" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">-</button></td>
        </tr>`;
        $("#productTable").append(newRow);
    });

    // Row Remove
    $(document).on("click", ".removeRow", function () {
        $(this).closest("tr").remove();
        calculateTotal();
    });

    // Calculate Amount
    $(document).on("input", ".price, .rate", function () {
        let row = $(this).closest("tr");
        let price = parseFloat(row.find(".price").val()) || 0;
        let rate = parseFloat(row.find(".rate").val()) || 1;
        let amount = price * rate;
        row.find(".amount").val(amount.toFixed(2));
        calculateTotal();
    });

    // Calculate Total
    function calculateTotal() {
        let subtotal = 0;
        $(".amount").each(function () {
            subtotal += parseFloat($(this).val()) || 0;
        });
        $("#subtotal").val(subtotal.toFixed(2));

        let discount = parseFloat($("#discount").val()) || 0;
        let discountType = $("#discountType").val();
        let discountAmount = discountType === "percent" ? (subtotal * discount) / 100 : discount;

        let tax = parseFloat($("#tax").val()) || 0;
        let taxType = $("#taxType").val();
        let taxAmount = taxType === "plus" ? tax : -tax;

        let total = subtotal - discountAmount + taxAmount;
        $("#total").val(total.toFixed(2));

        calculateDue();
    }

    function calculateDue() {
        let total = parseFloat($("#total").val()) || 0;
        let advanced = parseFloat($("#advanced").val()) || 0;
        let pay = parseFloat($("#pay").val()) || 0;
        let due = total - (advanced + pay);
        $("#due").val(due.toFixed(2));
    }

    // Input Triggers
    $("#discount, #discountType, #tax, #taxType").on("input change", function () {
        calculateTotal();
    });

    $("#pay, #advanced").on("input", function () {
        calculateDue();
    });
});


</script>
 @endpush