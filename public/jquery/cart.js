$(document).ready(function () {
    // when + button click
    $(".btn-plus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = parseInt($parentNode.find("#price").text().replace("ks", ""));
        $qty = parseInt($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " ks");

        // $(this).click(summaryCalculation());
        summaryCalculation();
    });

    // when - button click
    $(".btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        $price = parseInt($parentNode.find("#price").text().replace("ks", ""));
        $qty = parseInt($parentNode.find("#qty").val());

        $total = $price * $qty;
        $parentNode.find("#total").html($total + " ks");

        summaryCalculation();
    });

    // calculate final price for order
    function summaryCalculation() {
        $totalPrice = 0;
        $("#dataTable tbody tr").each(function (index, row) {
            $totalPrice += parseInt(
                $(row).find("#total").text().replace("ks", "")
            );
        });

        $("#subTotal").html(`${$totalPrice} kyats`);
        $("#finalPrice").html(`${$totalPrice + 3000} kyats`);
    }
});
